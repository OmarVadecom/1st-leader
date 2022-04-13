<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Imports\SuppliesImport;
use App\Models\Products;
use App\Models\Stock;
use App\Models\Supply;
use App\Models\Warehouse;
use App\Models\WarehouseEntry;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class SuppliesController extends MainController
{
    private $viewPath = 'admin.supplies.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.supplies'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {

        $stocks = Stock::all();
        $warehouses = Warehouse::all();
        $products = Products::all();
        $users = User::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['supply' => null, 'products' => $products, 'stocks' => $stocks, 'warehouses' => $warehouses, 'users' => $users], 'create');
    }

    public function store(Request $request)
    {
        $count = $request->product ? count($request->product) : 0;

        $warehouse_entry = WarehouseEntry::create([
            'date' => $request['date'],
            'time' => $request['time'],
            'notes' => $request['notes'],
            'user_id' => $request['user_id'],
        ]);

        for ($i = 0; $i < $count; $i++) {
            $product_code_type = $request['product_code_type'][$i];
            if ($request['product_code_type'][$i] != 'ES' && $request['product_code_type'][$i] != 'EA') {
                $product_code_type = 'EE';
            }
            $warehouse_entry->supplies()->create([
                'product_id' => $request['product'][$i],
                'code_type' => $product_code_type,
                'warehouse_id' => $request['warehouse_id'][$i],
                'stock_id' => $request['stock_id'][$i],
                'quantity' => $request['quantity'][$i],
                'cost' => $request['cost'][$i],
                'price' => $request['price'][$i],
                'addon' => $request['addon'][$i],
                'addon_perc' => $request['addon_perc'][$i],
            ]);
        }

        if ($request->file('excel')) {
            $file = $request->file('excel');
            $request->validate([
                'excel' => 'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp',
            ]);
            Excel::import(new SuppliesImport($warehouse_entry), $file);
        }
        return redirect(route('supplies.index'))->withFlashMessage(trans('تم ربط البضائع بالمستودعات'));
    }

    public function edit(Request $request, $id)
    {
        $entry = WarehouseEntry::findOrFail($id);

        $products = Products::all();
        $stocks = Stock::all();
        $users = User::all();
        $supplies = $entry->supplies()->orderBy('product_id', 'desc')->get();
        $warehouses = Warehouse::all();
        $product_id = $request->product;
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['supplies' => $supplies, 'products' => $products, 'stocks' => $stocks, 'warehouses' => $warehouses, 'users' => $users, 'entry' => $entry, 'product_id' => $product_id, 'edit' => true], 'edit');
    }

    public function update(Request $request, $id)
    {
        $entry = WarehouseEntry::findOrFail($id);

        $count = $request->product ? count($request->product) : 0;

        $entry->update([
            'date' => $request['date'],
            'time' => $request['time'],
            'notes' => $request['notes'],
            'user_id' => $request['user_id'],
        ]);
        $entry->supplies()->delete();
        for ($i = 0; $i < $count; $i++) {
            $product_code_type = $request['product_code_type'][$i];
            if ($request['product_code_type'][$i] != 'ES' && $request['product_code_type'][$i] != 'EA') {
                $product_code_type = 'EE';
            }
            $entry->supplies()->create([
                'product_id' => $request['product'][$i],
                'code_type' => $product_code_type,
                'warehouse_id' => $request['warehouse_id'][$i],
                'stock_id' => $request['stock_id'][$i],
                'quantity' => $request['quantity'][$i],
                'cost' => $request['cost'][$i],
                'price' => $request['price'][$i],
                'addon' => $request['addon'][$i],
                'addon_perc' => $request['addon_perc'][$i],
            ]);

            $entry->save();
        }
        return redirect(route('supplies.index'))->withFlashMessage(trans('admin.updated', ['name' => '']));
    }

    public function AjaxLoad(Supply $data)
    {
        $initSupplies = Supply::orderBy('created_at', 'desc')->currentYear();
        DB::statement(DB::raw('set @rownum=' . ($initSupplies->count() + 1)));
        $supplies = $initSupplies->select(['product_warehouses.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();

        return Datatables::of($supplies)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('id', function ($model) {
                return 'ENT-' . substr($model['created_at']->format('Y'), -2) . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })
            ->editColumn('code', function ($model) {
                if ($model->code_type != 'ES' && $model->code_type != 'EA') {
                    if (isset($model->product)) {
                        return $model->product->code;
                    }
                } else {
                    if (isset($model->part)) {
                        return $model->part->code;
                    }
                }
            })
            ->editColumn('name', function ($model) {
                if ($model->code_type != 'ES' && $model->code_type != 'EA') {
                    if (isset($model->product)) {
                        return $model->product->name;
                    }
                } else {
                    if (isset($model->part)) {
                        return $model->part->name;
                    }
                }
            })
            ->editColumn('quantity', function ($model) {

                return $model->quantity;
            })
            ->editColumn('cost', function ($model) {

                return round($model->cost, 2);
            })
            ->editColumn('price', function ($model) {

                return round($model->price, 2);
            })

            ->editColumn('warehouse', function ($model) {
                if (isset($model->warehouse)) {
                    return $model->warehouse->name;
                }
            })

            ->editColumn('action', function ($model) {
                if (isset($model->product) && isset($model->warehouseEntry)) {
                    return getAjaxAction($this->policy, $model, null, url('/supplies/' . $model->warehouseEntry->id . '/edit/?product=' . $model->product->id), route('supplies.destroy', $model->id));
                } else {
                    return getAjaxAction($this->policy, $model, null, null, route('supplies.destroy', $model->id));
                }
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function destroy(Request $request, $id)
    {
        $entry = Supply::findOrFail($id);
        // $entry->supplies()->delete();
        $entry->delete();

        $delMessage = trans('admin.deleted', ['name' => 'ادخال']);

        if ($request->ajax()) {
            return response()->json($delMessage);
        }

        return redirect(route('supplies.index'))->withFlashMessage($delMessage);
    }

    public function getWarehouses(Request $request)
    {
        $warehouses = Warehouse::where('stock_id', $request->stock_id)->currentYear()->get();
        return response()->json($warehouses);
    }
}
