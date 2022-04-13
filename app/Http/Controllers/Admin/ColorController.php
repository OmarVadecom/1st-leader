<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Color;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class ColorController  extends MainController
{
    private $viewPath = 'admin.color.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.country'));
    }



    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['color' => null], 'create');
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['color' => $color], 'edit');
    }

    public function store(Request $request)
    {
        Color::create([
            'name' => $request->name,
        ]);
        return redirect(route('color.index'))->withFlashMessage(trans('admin.created', ['name' => trans('لون')]));
    }


    public function update(Request $request, $id)
    {

        $color = Color::find($id);
        $color->update([
            'name' => $request->name,
        ]);
        return redirect(route('color.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('لون')]));
    }



    public function AjaxLoad(Color $data)
    {
        $colors = $data->currentYear()->get();
        return Datatables::of($colors)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('color.edit', $model->id), route('color.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function destroy($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.404'));
            }
            return view(important_pages('404'));
        }

        Color::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'لون']);
        if ($request->ajax()) {
            return Response::json($delMessage);

            return redirect(route('customercategory.index'))->withFlashMessage($delMessage);
        }
        return false;
    }
}
