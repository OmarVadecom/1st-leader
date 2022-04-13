<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\CustomerCategory;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class CustomerCatController  extends MainController
{
    private $viewPath = 'admin.customercat.';
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
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['category' => null], 'create');
    }

    public function edit($id)
    {
        $category = CustomerCategory::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['category' => $category], 'edit');
    }

    public function store(Request $request)
    {
        CustomerCategory::create([
            'name' => $request->name,
            'code' => $request->code,

        ]);
        return redirect(route('customercategory.index'))->withFlashMessage(trans('admin.created', ['name' => trans('قسم')]));
    }


    public function update(Request $request, $id)
    {

        $category = CustomerCategory::find($id);
        $category->update([
            'name' => $request->name,
            'code' => $request->code,

        ]);
        return redirect(route('customercategory.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('قسم')]));
    }



    public function AjaxLoad(CustomerCategory $data)
    {
        $categories = $data->all();
        return Datatables::of($categories)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })

            ->editColumn('customers', function ($model) {

                return "<a href='" . route('customers.index') . "?category_id=" . $model->id . "' target='_blank'>" . count($model->customers) . " عميل </a>";
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('customercategory.edit', $model->id), route('customercategory.destroy', $model->id));
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

        CustomerCategory::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'قسم']);
        if ($request->ajax()) {
            return Response::json($delMessage);

            return redirect(route('customercategory.index'))->withFlashMessage($delMessage);
        }
        return false;
    }
}
