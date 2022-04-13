<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Customers;
use App\Models\Delivery;
use App\Models\DeliveryProduct;
use App\Models\Preparation;
use App\Models\PrepareProduct;
use App\Models\Products;
use App\Models\Warehouse;
use App\User;
use DataTables;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Request;
use Response;

class PreparationsController extends MainController
{
    private $viewPath = 'admin.preparation.';
    private $policy = 'preparation.';
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $customers = Customers::pluck('name', 'id')->toArray();
        $products = Products::all();
        $warhouses = Warehouse::all();
        $users = User::Where('type', 2)->get();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['customers' => $customers, 'products' => $products, 'warhouses' => $warhouses, 'users' => $users], 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'date',
        ]);
        $input = $request->except(['_token', 'prstatus']);
        //for testing only
        $input = array_merge($input, ['reciept_lat' => '0', 'reciept_lng' => '0']);

        $preparation = Preparation::create($input);
        if (isset($input['product']) && count($input['product']) > 0) {
            for ($i = 0; $i < count($input['product']); $i++) {
                $status = 0;
                if ($input['quantity'][$i] - $input['prepared'][$i] == 0) {
                    $status = 1;
                }
                PrepareProduct::create([
                    'prepare_id' => $preparation->id,
                    'product_id' => $input['product'][$i],
                    'quantity' => $input['quantity'][$i],
                    'user_id' => $input['user'][$i],
                    'prepared' => $input['prepared'][$i],
                    'remains' => $input['quantity'][$i] - $input['prepared'][$i],
                    'status' => $status,
                    'warehouse_id' => $input['warehouse_id'][$i],
                ]);
            }
        }
        return redirect(route('preparations.index'))->withFlashMessage(trans('admin.created', ['name' => ' أمر تحضير']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function show($id)
    {
        $prepare = Preparation::find($id);
        return $this->getView($this->viewPath . 'show', $this->policy . 'show', ['prepare' => $prepare], 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $preparation = Preparation::findOrFail($id);
        $customers = Customers::pluck('name', 'id')->toArray();
        $products = Products::all();
        $warhouses = Warehouse::all();
        $preparation_products = $preparation->products;
        $users = User::Where('type', 2)->get();
        $edit = true;
        return $this->getView($this->viewPath . 'edit', $this->policy . 'edit', ['customers' => $customers, 'products' => $products, 'warhouses' => $warhouses, 'preparation' => $preparation, 'preparation_products' => $preparation_products, 'users' => $users, 'edit' => $edit], 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'date',
        ]);
        $input = $request->except(['_token', 'prstatus']);
        //for testing only
        $input = array_merge($input, ['reciept_lat' => '0', 'reciept_lng' => '0']);
        $preparation = Preparation::find($id);
        $preparation->update($input);
        foreach ($preparation->products as $key => $pro) {
            if ($pro->id == $input['product'][$key]) {
                if ($pro->remains != 0) {
                    $status = 0;
                    $prepared = $pro->prepared + $input['prepared'][$key];
                    $sub = $pro->quantity - $prepared;
                    if ($sub == 0) {

                        $status = 1;
                        $delivery = Delivery::create([
                            'time' => $preparation->time,
                            'date' => $preparation->date,
                            'customer_id' => $preparation->customer_id,
                            'price_id' => $preparation->price_id,
                            'prepare_id' => $preparation->id,
                        ]);

                        DeliveryProduct::create([
                            'delivery_id' => $delivery->id,
                            'product_id' => $pro->product_id,
                            'quantity' => $pro->quantity,
                            'remains' => $pro->quantity,
                        ]);
                    }
                    $pro->update([
                        'prepared' => $prepared,
                        'remains' => $sub,
                        'status' => $status,
                        'warehouse_id' => $input['warehouse_id'][$key],
                        'user_id' => $input['user'][$key],
                    ]);
                } else {
                    $pro->update([
                        'warehouse_id' => $input['warehouse_id'][$key],
                        'user_id' => $input['user'][$key],
                    ]);
                }
            }
        }
        return redirect(route('preparations.index'))->withFlashMessage(trans('admin.updated', ['name' => ' أمر تحضير']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $preparation = Preparation::findOrFail($id);
        if (!isset($preparation->delivery)) {
            PrepareProduct::where('prepare_id', $id)->delete();
            Preparation::findOrFail($id)->delete();
        }


        $delMessage = trans('admin.deleted', ['name' => 'امر تحضير']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('preparations.index'))->withFlashMessage($delMessage);
    }

    public function ajaxLoad()
    {
        $preparations = Preparation::orderby('created_at', 'desc')->currentYear()->get();
        return Datatables::of($preparations)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('customer', function ($model) {
                return $model->customer()->first()->name;
            })
            ->editColumn('date', function ($model) {
                return $model->date . ' ' . $model->time;
            })
            ->editColumn('status', function ($model) {

                return $model->preparestatus;
            })
            ->editColumn('action', function ($model) {
                if (Auth::user()->id == 9) {
                    return getAjaxAction($this->policy, $model, route('preparations.show', $model->id), route('preparations.edit', $model->id), route('preparations.destroy', $model->id));
                } else {
                    return getAjaxAction($this->policy, $model, route('preparations.show', $model->id), route('preparations.edit', $model->id), null);
                }
            })
            ->escapeColumns([])
            ->make(true);
    }
}
