<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Products;
use App\Models\ProductTransport;
use App\Models\Supply;
use App\Models\Warehouse;
use App\User;
use DataTables;
use Symfony\Component\HttpFoundation\Request;

class ProductTransportController extends MainController
{

    const VIEWPATH = 'admin.transport.';
    private $policy = 'users.';

    public function index()
    {
        return view(self::VIEWPATH . 'index');
    }

    public function create()
    {
        $products = Products::all();
        $warhouses = Warehouse::all();
        $users = User::Where('type', 3)->get();
        return view('admin.transport.create', compact('products', 'warhouses', 'users'));
    }

    public function edit($id)
    {
        $products = Products::all();
        $warhouses = Warehouse::all();
        $users = User::Where('type', 3)->get();
        $transport = ProductTransport::findOrFail($id);
        $transport_products = explode(',', $transport->products_id);
        $quantities = explode(',', $transport->quantities);
        $ware_from = explode(',', $transport->ware_from);
        $ware_to = explode(',', $transport->ware_to);
        $users_id = explode(',', $transport->users_id);
        $edit = true;
        return view(self::VIEWPATH . 'edit', compact('products', 'warhouses', 'transport', 'transport_products', 'users', 'edit', 'quantities', 'ware_from', 'ware_to', 'users_id'));
    }

    public function store(Request $request)
    {
        $input = $request->except(['_token']);
        //for testing only
        $input = array_merge($input, ['products_id' => implode(',', $request->product), 'ware_from' => implode(',', $request->ware_from), 'ware_to' => implode(',', $request->ware_to), 'quantities' => implode(',', $request->quantity), 'users_id' => implode(',', $request->user), 'codes_type' => implode(',', $request->product_code_type)]);
        $transport = ProductTransport::create($input);
        if (isset($input['product']) && count($input['product']) > 0) {
            for ($i = 0; $i < count($input['product']); $i++) {
                Supply::create([
                    'product_id' => $input['product'][$i],
                    'code_type' => $input['product_code_type'][$i],
                    'quantity' => -1 * $input['quantity'][$i],
                    'user_id' => $input['user'][$i],
                    'stock_id' => 0,
                    'entry_id' => 0,
                    'transport_id' => $transport->id,
                    'warehouse_id' => $input['ware_from'][$i],
                    'ware_to' => $input['ware_to'][$i],
                ]);
                Supply::create([
                    'product_id' => $input['product'][$i],
                    'code_type' => $input['product_code_type'][$i],
                    'quantity' => $input['quantity'][$i],
                    'user_id' => $input['user'][$i],
                    'entry_id' => 0,
                    'stock_id' => 0,
                    'transport_id' => $transport->id,
                    'warehouse_id' => $input['ware_to'][$i],
                ]);
            }
        }
        return redirect(route('transport.index'))->withFlashMessage(trans('admin.created', ['name' => ' أمر نقل']));
    }

    public function ajaxLoad()
    {
        $transport = Supply::WhereNotNull('transport_id')->where('quantity', '<', 0)->orderby('created_at', 'desc')->currentYear()->get();
        return Datatables::of($transport)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('date', function ($model) {
                return $model->transport->date;
            })
            ->editColumn('product', function ($model) {
                if($model->product !== null) {
                    return $model->product->code;
                }
            })
            ->editColumn('quantity', function ($model) {
                return -1 * $model->quantity;
            })
            ->editColumn('from', function ($model) {

                return $model->warehouse->name;
            })
            ->editColumn('to', function ($model) {

                return $model->warehouseto->name;
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('transport.show', $model->transport_id), route('transport.edit', $model->transport_id), null);
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function update(Request $request, $id)
    {
        $input = $request->except(['_token']);
        //for testing only
        $input = array_merge($input, ['products_id' => implode(',', $request->product), 'ware_from' => implode(',', $request->ware_from), 'ware_to' => implode(',', $request->ware_to), 'quantities' => implode(',', $request->quantity), 'users_id' => implode(',', $request->user), 'codes_type' => implode(',', $request->product_code_type)]);
        $transport = ProductTransport::find($id);
        $transport->update($input);
        if (isset($input['product']) && count($input['product']) > 0) {
            Supply::where('transport_id', $transport->id)->delete();
            for ($i = 0; $i < count($input['product']); $i++) {
                Supply::create([
                    'product_id' => $input['product'][$i],
                    'code_type' => $input['product_code_type'][$i],
                    'quantity' => -1 * $input['quantity'][$i],
                    'user_id' => $input['user'][$i],
                    'stock_id' => 0,
                    'entry_id' => 0,
                    'transport_id' => $transport->id,
                    'warehouse_id' => $input['ware_from'][$i],
                    'ware_to' => $input['ware_to'][$i],

                ]);
                Supply::create([
                    'product_id' => $input['product'][$i],
                    'code_type' => $input['product_code_type'][$i],
                    'quantity' => $input['quantity'][$i],
                    'user_id' => $input['user'][$i],
                    'entry_id' => 0,
                    'stock_id' => 0,
                    'transport_id' => $transport->id,
                    'warehouse_id' => $input['ware_to'][$i],
                ]);
            }
        }
        return redirect(route('transport.index'))->withFlashMessage(trans('admin.updated', ['name' => ' أمر النقل']));
    }

    public function show($id)
    {
        $transport = ProductTransport::find($id);
        $transportproduct = Supply::where('transport_id', $id)->where('quantity', '<', 0)->get();
        return $this->getView(self::VIEWPATH . 'show', $this->policy . 'create', ['delivery' => $transport, 'transproducts' => $transportproduct], 'create');
    }
}
