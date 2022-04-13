<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Stock;
use App\Models\Warehouse;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class WarehouseController extends MainController
{
    private $viewPath = 'admin.warehouse.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.warehouse'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $stocks = Stock::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', [
            'brand' => null,
            'stocks' => $stocks,
        ], 'create');
    }

    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $stocks = Stock::all();
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', [
            'warehouse' => $warehouse,
            'stocks' => $stocks,
        ], 'edit');
    }

    public function store(Request $request)
    {
        $warehouse = Warehouse::create([
            'name' => $request->name,
            'stock_id' => 0,
        ]);
        return redirect(route('warehouse.index'))->withFlashMessage(trans('admin.created', ['name' => 'مستودع']));
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::find($id)->update([
            'name' => $request->name,
        ]);
        return redirect(route('warehouse.index'))->withFlashMessage(trans('admin.edit', ['name' => 'مستودع']));
    }

    public function AjaxLoad(Warehouse $data)
    {
        $warehouses = $data->currentYear()->get();
        return Datatables::of($warehouses)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('warehouse.edit', $model->id), route('warehouse.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function destroy($id, Request $request)
    {
        Warehouse::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'مستودع']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('warehouse.index'))->withFlashMessage($delMessage);
    }
}
