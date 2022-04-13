<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Customers;
use App\Models\Delivery;
use App\Models\DeliveryProduct;
use App\Models\MaintenanceReport;
use App\Models\Products;
use App\Models\Parts;
use App\Models\Warehouse;
use App\User;
use DataTables;
use Symfony\Component\HttpFoundation\Request;
use Auth;
use Response;

class DeliveryController extends MainController
{

    const VIEWPATH = 'admin.delivery.';
    private $policy = 'delivery.';

    public function index()
    {
        return $this->getView(self::VIEWPATH . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $maintenance = null;
        $offer_products_quantities = [];
        $offer_products = [];
        $customerss = [];
        if (\Request::get('m')) {
            $maintenance = \Request::get('m');
            $maintenance = MaintenanceReport::find($maintenance);
            $customerss = Customers::all();
            if ($maintenance->products_id != '') {
                $offer_products_ids = explode(',', $maintenance->products_id);
            } else {
                $offer_products_ids = [];
            }

            if ($maintenance->parts_id != '') {
                $offer_parts_ids = explode(',', $maintenance->parts_id);
            } else {
                $offer_parts_ids = [];
            }
            $offer_products = [];
            if (isset($maintenance->Maintenance->product_id)) {
                array_push($offer_products, Products::find($maintenance->Maintenance->product_id));
            } elseif (isset($maintenance->Maintenance->part_id)) {
                array_push($offer_products, Parts::find($maintenance->Maintenance->part_id));
            }
            array_push($offer_products_quantities, $maintenance->Maintenance->quantity);

            // foreach ($offer_products_ids as $key => $pid) {
            //     array_push($offer_products, Products::find($pid));
            // }
            // foreach ($offer_parts_ids as $key => $pid) {
            //     array_push($offer_products, Parts::find($pid));
            // }
            // $offer_products_quantities = explode(',', $maintenance->quantities);

        }
        $customers = Customers::pluck('name', 'id')->toArray();
        $products = Products::all();
        $warhouses = Warehouse::all();
        $users = User::Where('type', 3)->get();
        return $this->getView(self::VIEWPATH . 'create', $this->policy . 'create', ['customers' => $customers, 'products' => $products, 'warhouses' => $warhouses, 'users' => $users, 'maintenance' => $maintenance, 'customerss' => $customerss, 'offer_products' => $offer_products, 'offer_products_quantities' => $offer_products_quantities], 'create');
    }

    public function edit($id)
    {
        $delivery = Delivery::findOrFail($id);
        $customers = Customers::pluck('name', 'id')->toArray();
        $products = Products::all();
        $warhouses = Warehouse::all();
        $delivery_products = $delivery->products;
        $users = User::Where('type', 2)->get();
        $edit = true;
        return $this->getView(self::VIEWPATH . 'edit', $this->policy . 'edit', ['customers' => $customers, 'products' => $products, 'warhouses' => $warhouses, 'delivery' => $delivery, 'delivery_products' => $delivery_products, 'users' => $users, 'edit' => $edit], 'edit');
    }

    public function store(Request $request)
    {
        $input = $request->except(['_token', 'prstatus']);
        //for testing only
        $input = array_merge($input, ['reciept_lat' => '0', 'reciept_lng' => '0', 'maintenance_id' => $request->maintenance_id]);
        $delivery = Delivery::create($input);
        if (isset($input['product']) && count($input['product']) > 0) {
            for ($i = 0; $i < count($input['product']); $i++) {
                $status = 0;
                if ($input['quantity'][$i] - $input['delivered'][$i] == 0) {
                    $status = 1;
                }
                DeliveryProduct::create([
                    'delivery_id' => $delivery->id,
                    'product_id' => $input['product'][$i],
                    'code_type' => $input['product_code_type'][$i],
                    'quantity' => $input['quantity'][$i],
                    'user_id' => $input['user'][$i],
                    'delivered' => $input['delivered'][$i],
                    'remains' => $input['quantity'][$i] - $input['delivered'][$i],
                    'status' => $status,
                    'warehouse_id' => $input['warehouse'][$i],
                ]);
            }
        }
        return redirect(route('delivery.index'))->withFlashMessage(trans('admin.created', ['name' => ' أمر تسليم']));
    }

    public function ajaxLoad()
    {
        $delivery = Delivery::orderby('created_at', 'desc')->currentYear()->get();
        return Datatables::of($delivery)
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

                return $model->deliverystatus;
            })
            ->editColumn('action', function ($model) {
                if (Auth::user()->id == 9) {
                    return getAjaxAction($this->policy, $model, route('delivery.show', $model->id), route('delivery.edit', $model->id), route('delivery.destroy', $model->id));
                } else {
                    return getAjaxAction($this->policy, $model, route('delivery.show', $model->id), route('delivery.edit', $model->id), null);
                }
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'date',
        ]);
        $input = $request->except(['_token', 'prstatus']);
        //for testing only
        $input = array_merge($input, ['reciept_lat' => '0', 'reciept_lng' => '0']);
        $delivery = Delivery::find($id);
        $delivery->update($input);
        foreach ($delivery->products as $key => $pro) {
            if ($pro->remains != 0) {
                $status = 0;
                $delivered = $pro->delivered + $input['delivered'][$key];
                $sub = $pro->quantity - $delivered;
                if ($sub == 0) {
                    $status = 1;
                }
                $pro->update([
                    'delivered' => $delivered,
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
        return redirect(route('delivery.index'))->withFlashMessage(trans('admin.updated', ['name' => ' أمر التسليم']));
    }

    public function show($id)
    {
        $delivery = Delivery::find($id);
        return $this->getView(self::VIEWPATH . 'show', $this->policy . 'show', ['delivery' => $delivery], 'create');
    }
    public function destroy($id, Request $request)
    {
        DeliveryProduct::where('delivery_id', $id)->delete();
        Delivery::findOrFail($id)->delete();


        $delMessage = trans('admin.deleted', ['name' => 'امر تسليم']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('delivery.index'))->withFlashMessage($delMessage);
    }
}
