<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Admin\PageCategory as pageReq;
use App\Models\PageCatgory as page;
use App\Models\PageCatgoryLang as pageLang;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Response;
use View;

class PageCategoryController extends MainController
{
    private $viewPath = 'admin.pageCategory.';
    private $policy = 'page-categories.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.pages'));
    }

    public function index(Request $req)
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $parents = page::langPluck()->prepend(trans('admin.selectSom'), '');
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['page' => null, 'parents' => $parents], 'create');
    }

    public function edit($id)
    {
        $page = page::findOrFail($id);
        $parents = page::langPluck([$id])->prepend(trans('admin.selectSom'), '');
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['page' => $page, 'parents' => $parents], 'edit');
    }

    public function show($id)
    {
        $page = page::findOrFail($id);
        return $this->getView($this->viewPath . 'show', $this->policy . 'view', ['page' => $page], 'view');
    }

    public function store(pageReq $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            return view(important_pages('403'));
        }

        $page = page::create([
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug,
        ]);
        foreach (getAllLangFromDB() as $key => $lang) {
            pageLang::create([
                'status' => $request->status,
                'title' => $request->title[$lang->code],
                'page_catgory_id' => $page->id,
                'lang' => $lang->code,
                'description' => $request->description[$lang->code],
                'keywords' => $request->keywords[$lang->code],
            ]);
        }
        return redirect(route('page-categories.index'))->withFlashMessage(trans('admin.created', ['name' => trans('admin.page')]));
    }

    public function update($id, pageReq $request)
    {
        if (!Auth::user()->can($this->policy . 'update')) {
            return view(important_pages('403'));
        }

        $page = page::findOrFail($id);
        $page->update([
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'slug' => $request->slug,
        ]);
        foreach (getAllLangFromDB() as $key => $lang) {
            pageLang::where('page_catgory_id', $id)->where('lang', $lang->code)->update([
                'title' => $request->title[$lang->code],
                'status' => (bool) $request->status,
                'description' => $request->description[$lang->code],
                'keywords' => $request->keywords[$lang->code],
            ]);
        }
        return redirect(route('page-categories.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('admin.page')]));
    }

    public function destroy($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'delete')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.403'));
            }
            return view(important_pages('403'));
        }

        page::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => trans('admin.page')]);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('page-categories.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(page $data)
    {
        $pages = $data->all();
        return Datatables::of($pages)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('title', function ($model) {

                return $model->name;
            })

            ->editColumn('status', function ($model) {

                return getStatus($model->show);
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('page-categories.show', $model->id), route('page-categories.edit', $model->id), route('page-categories.destroy', $model->id));
            })
            ->make(true);
    }

    public function multiDelete(Request $request, page $data)
    {
        if (!Auth::user()->can($this->policy . 'delete')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.403'));
            }
            return view(important_pages('403'));
        }

        if ($request->ajax()) {
            $ids = $request->id;
            foreach ($ids as $id) {
                $find = $data->find($id);
                if ($find == null) {
                    continue;
                }
                $find->delete();
            }
            return Response::json('done');
        }
        return abort(404);
    }
}
