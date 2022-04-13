<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Menu as menuReq;
use App\Models\Menu as menu;
use App\Models\MenuLang as menuLang;
use Auth;
use Illuminate\Http\Request;
use Response;
use View;

class MenuController extends MainController
{
    private $viewPath = 'admin.menu.';
    private $policy = 'menus.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.menus'));
    }

    public function index(Request $req)
    {
        $menus = menu::whereNull('parent_id')->orderBy('ordering', 'asc')->get();
        return $this->getView($this->viewPath . 'index', $this->policy . 'view', ['menus' => $menus]);
    }

    public function create(menu $menu)
    {
        $parents = $menu->langPluck()->prepend(trans('admin.selectSom'), '');
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['menu' => null, 'parents' => $parents], 'create');
    }

    public function edit($id)
    {
        $menu = menu::findOrFail($id);
        $parents = menu::langPluck([$menu->id])->prepend(trans('admin.selectSom'), '');
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['menu' => $menu, 'parents' => $parents], 'edit');
    }

    public function show($id)
    {
        $menu = menu::findOrFail($id);
        return $this->getView($this->viewPath . 'show', $this->policy . 'view', ['menu' => $menu], 'view');
    }

    public function store(menuReq $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            return view(important_menus('403'));
        }

        $order = Menu::count() + 1;
        $menu = menu::create([
            'status' => $request->status,
            'link_method' => $request->link_method,
            'link' => $request->link,
            'target' => $request->target,
            'ordering' => $order,
            'parent_id' => $request->parent_id,
        ]);
        foreach (getAllLangFromDB() as $key => $lang) {
            menuLang::create([
                'status' => $request->status,
                'title' => $request->title[$lang->code],
                'menu_id' => $menu->id,
                'lang' => $lang->code,
            ]);
        }
        return redirect(route('menu.index'))->withFlashMessage(trans('admin.created', ['name' => trans('admin.menu')]));
    }

    public function update($id, menuReq $request)
    {
        if (!Auth::user()->can($this->policy . 'update')) {
            return view(important_menus('403'));
        }
        $menu = menu::findOrFail($id);
        $menu->update([
            'status' => $request->status,
            'link_method' => $request->link_method,
            'link' => $request->link,
            'target' => $request->target,
            'parent_id' => $request->parent_id,
        ]);
        foreach (getAllLangFromDB() as $key => $lang) {
            menuLang::where('menu_id', $id)->where('lang', $lang->code)->update([
                'title' => $request->title[$lang->code],
                'status' => (bool) $request->status,
            ]);
        }
        return redirect(route('menu.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('admin.menu')]));
    }

    public function destroy($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'delete')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.403'));
            }
            return view(important_pages('403'));
        }

        $menu = menu::findOrFail($id);
        $menu->parents()->delete();
        $menu->delete();
        $delMessage = trans('admin.deleted', ['name' => trans('admin.menu')]);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('menu.index'))->withFlashMessage($delMessage);
    }

    public function getParents($id)
    {
        $menu = menu::findOrFail($id);
        $menus = menu::where('parent_id', $id)->orderBy('ordering', 'asc')->get();
        return $this->getView($this->viewPath . 'parent', $this->policy . 'view', ['menus' => $menus, 'menu' => $menu]);
    }

    public function StepUp($id)
    {
        $menu = menu::findOrFail($id);
        if ($menu->ordering > 1) {
            $target = $menu->ordering - 1;
            if ($menu->parent_id == null) {
                $replace = menu::where('ordering', $target)->first();
            } else {
                $replace = menu::where('ordering', $target)->where('parent_id', $menu->parent_id)->first();
            }

            if ($replace != null) {
                $dist = $replace->ordering;
                $replace->update(['ordering' => $menu->ordering]);
                $menu->update(['ordering' => $dist]);
            }
        }
        return redirect()->back()->withFlashMessage(trans('admin.success'));
    }

    public function StepDown($id)
    {
        $menu = menu::findOrFail($id);
        $total = menu::count();
        if (($menu->ordering + 1) <= $total) {
            $target = $menu->ordering + 1;
            if ($menu->parent_id == null) {
                $replace = menu::where('ordering', $target)->first();
            } else {
                $replace = menu::where('ordering', $target)->where('parent_id', $menu->parent_id)->first();
            }
            $dist = $menu->ordering;
            if ($replace != null) {
                $replace->update(['ordering' => $dist]);
                $menu->update(['ordering' => $target]);
            }
        }
        return redirect()->back()->withFlashMessage(trans('admin.success'));
    }

    /*
     * Ajax
     */

    public function AjaxLoadContent(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->type;
            if ($type == 'product') {
                $results = getProducts();
            } else {
                $results = getPages();
            }
            $result = view($this->viewPath . 'list', compact('results'))->render();
            return Response::json($result);
        }
        return abort(404);
    }

    public function multiDelete(Request $request, menu $data)
    {
        if (!Auth::user()->can($this->policy . 'delete')) {
            if ($request->ajax()) {
                return Response::json(important_menus('ajax.403'));
            }
            return view(important_menus('403'));
        }

        if ($request->ajax()) {
            $ids = $request->id;
            foreach ($ids as $id) {
                $find = $data->find($id);
                if ($find == null) {
                    continue;
                }
                if ($find->parents() != null) {
                    $find->parents()->delete();
                }

                $find->delete();
            }
            return Response::json('done');
        }
        return view('errors.404');
    }
}
