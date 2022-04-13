<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Supplier;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class SupplierController extends MainController
{
    private $viewPath = 'admin.supplier.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.supplier'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        return $this->getView($this->viewPath . 'create', $this->policy . 'create');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['supplier' => $supplier], 'edit');
    }

    public function store(Request $request)
    {
        Supplier::create([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'job' => $request->job,
            'type' => $request->type,

        ]);
        return redirect(route('supplier.index'))->withFlashMessage(trans('admin.created', ['name' => trans('مورد')]));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update([
            'name' => $request->name,
            'name_en' => $request->name_en,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'job' => $request->job,
            'type' => $request->type,
        ]);
        return redirect(route('supplier.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('مورد')]));
    }

    public function AjaxLoad(Supplier $data)
    {
        $suppliers = $data->currentYear()->get();
        return Datatables::of($suppliers)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('type', function ($model) {
                if ($model->type == 0) {
                    return "محلي";
                } else {
                    return "دولي";
                }
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('supplier.edit', $model->id), route('supplier.destroy', $model->id));
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

        Supplier::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'مورد']);
        if ($request->ajax()) {
            return Response::json($delMessage);

            return redirect(route('supplier.index'))->withFlashMessage($delMessage);
        }
        return false;
    }
}
