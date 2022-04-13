<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Product;
use App\Models\Products;
use App\Models\Stock;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class StockController extends MainController
{
    private $viewPath = 'admin.stock.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.stock'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $stocks = Stock::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['stock' => null, 'stocks' => $stocks], 'create');
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $stocks = Stock::all();
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['stock' => $stock, 'stocks' => $stocks], 'edit');
    }

    public function store(Request $request)
    {
        $stock = Stock::create([
            'name' => $request->name,
        ]);
        return redirect(route('stock.index'))->withFlashMessage(trans('admin.created', ['name' => 'مخزون']));
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::find($id)->update([
            'name' => $request->name,
        ]);
        return redirect(route('stock.index'))->withFlashMessage(trans('admin.created', ['name' => 'مخزون']));
    }

    public function AjaxLoad(Stock $data)
    {
        $stocks = $data->currentYear()->get();
        return Datatables::of($stocks)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('stock.edit', $model->id), route('stock.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }


    public function stockreport()
    {
        $stocks = Stock::all();
        $stocks = Stock::all();
        $products = Products::all();
        return $this->getView($this->viewPath . 'get', $this->policy . 'view', ['stocks' => $stocks, 'stocks' => $stocks, 'products' => $products]);
    }

    public function poststockreport(Request $request)
    {
        $stock = null;
        $stock = null;
        if ($request->stock != "all") {
            $stock = Stock::find($request->stock);
        }
        if ($request->stock != "all") {
            $stock = Stock::find($request->stock);
        }
        $product = $request->product;
        $products = Product::all();
        if ($product != 'all') {
            $products = Products::where('id', $request->product)->get();
        }
        $datefrom = $request->date_from;

        $dateto = $request->date_to;
        if ($dateto == null) {
            $dateto = date("Y-m-d");
        }

        return $this->getView($this->viewPath . 'post', $this->policy . 'view', ['stock' => $stock, 'stock' => $stock, 'product' => $product, 'datefrom' => $datefrom, 'dateto' => $dateto, 'products' => $products]);
    }
}
