<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Sanadat;
use Illuminate\Support\Facades\DB;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Illuminate\Support\Facades\Auth;
use Salla\ZATCA\Tags\InvoiceDate;
use App\Models\MaintenanceReport;
use Salla\ZATCA\Tags\TaxNumber;
use App\Models\DeliveryProduct;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\Seller;
use Illuminate\Http\Request;
use App\Models\SellProduct;
use App\Models\Warehouse;
use App\Models\Customers;
use App\Models\Delivery;
use App\Models\MoneyBox;
use App\Models\Products;
use App\Models\Parts;
use App\Models\Sells;
use DataTables;
use Response;
use App\User;
use View;

class SellController extends MainController
{
    private $viewPath = 'admin.sell.';
    private $policy = 'page-categories.';

    public function __construct()
    {
        View::share('pageTitle', trans('admin.sell'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function AjaxLoad(Sells $data)
    {
        if (auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
            $initSells = Sells::where('type', 0)->whereNull('main_type')->orderby('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
            $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        } else {
            $initSells = Sells::where('type', 0)->whereNull('main_type')->where('branch', auth()->user()['branch'])->orderby('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
            $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        }

        return Datatables::of($sells)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('code', function ($model) {
                return $model->code . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })

            ->editColumn('total', function ($model) {
                return $model->totalmoney;
            })
            ->editColumn('date', function ($model) {
                return $model->date . ' ' . $model->time;
            })
            ->editColumn('client', function ($model) {

                return $model->client->name;
            })
            ->editColumn('action', function ($model) {
                if( auth()->user()['id'] === 1 || auth()->user()['id'] === 7 || auth()->user()['id'] === 9) {
                    return getAjaxAction($this->policy, $model, route('sells.show', $model->id) . '?invoice_num=' . $model->rownum, route('sells.edit', $model->id) . '?invoice_num=' . $model->rownum, route('sells.destroy', $model->id));
                }
                return getAjaxAction($this->policy, $model, route('sells.show', $model->id) . '?invoice_num=' . $model->rownum);
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function AjaxLoadinternal()
    {

        // $delivery = Delivery::with('products')->whereHas('products', function ($q) {
        //     $q->where('remains', 0)->where('inv', 0);
        // })->orderby('created_at', 'desc')->currentYear()->get();
        // foreach ($delivery as $key => $dlv) {
        //     if ($dlv->deliverystatus != "<span style='color:green'>تم تسليمها</span>") {
        //         $delivery->forget($key);
        //     }
        // }

        if (auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
            $initSells = Sells::where('type', 3)->orderby('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
            $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        } else {
            $initSells = Sells::where('type', 3)->where('branch', auth()->user()['branch'])->orderby('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
            $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        }

        return Datatables::of($sells)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('code', function ($model) {

                return $model->code . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })

            ->editColumn('date', function ($model) {
                return $model->date . ' ' . $model->time;
            })
            ->editColumn('client', function ($model) {

                return $model->client->name;
            })

            ->editColumn('total', function ($model) {

                return $model->total_money;
            })

            ->editColumn('action', function ($model) {
                if( auth()->user()['id'] === 1 || auth()->user()['id'] === 7 || auth()->user()['id'] === 9) {
                    return getAjaxAction($this->policy, $model, route('sells.show', $model->id) . '?invoice_num=' . $model->rownum, route('sells.edit', $model->id) . '?main_type=3' . '&invoice_num=' . $model->rownum, route('sells.destroy', $model->id));
                }
                return getAjaxAction($this->policy, $model, route('sells.show', $model->id) . '?invoice_num=' . $model->rownum);
            })
            ->escapeColumns([])
            ->make(true);
//             ->editColumn('action', function ($model) {
//                 return '<a href="' . route('sells.create') . '?delivery=' . $model->id . '" class="btn btn-circle"><i class="icon-plus"></i></a> ';

// //                return getAjaxAction($this->policy, $model, route('delivery.show', $model->id), route('delivery.edit', $model->id), null);
//             })
    }

    public function AjaxLoadmaintenance(Sells $data, Request $request)
    {
        if ($request['main_type'] === '2') {
            if (auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
                $initSells = Sells::where('type', 2)->where('main_type', 2)->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            } else {
                $initSells = Sells::where('type', 2)->where('main_type', 2)->where('branch', auth()->user()['branch'])->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            }
        } elseif($request['main_type'] === '1') {
            if (auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
                $initSells = Sells::where('type', 2)->whereNull('main_type')->orWhere('main_type', 1)->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            } else {
                $initSells = Sells::where('type', 2)->whereNull('main_type')->orWhere('main_type', 1)->where('branch', auth()->user()['branch'])->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            }
        } elseif($request['main_type'] === '4') {
            if (auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
                $initSells = Sells::where('type', 4)->where('main_type', 4)->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            } else {
                $initSells = Sells::where('type', 4)->where('main_type', 4)->where('branch', auth()->user()['branch'])->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            }
        } elseif($request['main_type'] === '5') {
            if (auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
                $initSells = Sells::where('type', 5)->where('main_type', 5)->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            } else {
                $initSells = Sells::where('type', 5)->where('main_type', 5)->where('branch', auth()->user()['branch'])->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            }
        } else {
            if (auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
                $initSells = Sells::orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            } else {
                $initSells = Sells::where('branch', auth()->user()['branch'])->orderby('created_at', 'desc')->currentYear();
                DB::statement(DB::raw('set @rownum=' . ($initSells->count() + 1)));
                $sells = $initSells->select(['sells.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
            }
        }

        return Datatables::of($sells)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('code', function ($model) {

                return $model->code . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })

            ->editColumn('total', function ($model) {
                $totals = explode(',', $model->totals);
                $sum = 0;
                if (count($totals) > 0) {
                    $sum = array_sum($totals);
                }
                if (isset($model->addon_disc) && $model->addon_disc != "" && $model->addon_disc != 0) {
                    return $sum - $model->addon_disc;
                }
                return $sum;
            })
            ->editColumn('date', function ($model) {
                return $model->date . ' ' . $model->time;
            })
            ->editColumn('client', function ($model) {

                return $model->client->name;
            })
            ->editColumn('action', function ($model) {
                if (auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
                    return getAjaxAction($this->policy, $model, route('sells.show', $model->id) . '?invoice_num=' . $model->rownum, route('sells.edit', $model->id) . '?main_type=' . request('main_type') . '&invoice_num=' . $model->rownum, route('sells.destroy', $model->id));
                }

                return getAjaxAction($this->policy, $model, route('sells.show', $model->id) . '?invoice_num=' . $model->rownum);
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function internalsells()
    {
        return $this->getView($this->viewPath . 'indexinternal', $this->policy . 'view');
    }

    public function mntsells()
    {
        return $this->getView($this->viewPath . 'indexmaintenance', $this->policy . 'view');
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

    public function qrcode (){
        return $this->getView($this->viewPath . 'qrcode', $this->policy . 'create', [], 'create');
    }

    public function create(Request $request)
    {
        if (\Request::get('m')) {
            $maintenance = \Request::get('m');
            $offer = MaintenanceReport::find($maintenance);
            if ($offer->products_id != '') {
                $offer_products_ids = explode(',', $offer->products_id);
            } else {
                $offer_products_ids = [];
            }

            if ($offer->parts_id != '') {
                $offer_parts_ids = explode(',', $offer->parts_id);
            } else {
                $offer_parts_ids = [];
            }

            $offer_products_quantities = explode(',', $offer->quantities);
            $offer_products_prices = explode(',', $offer->prices);
            $offer_products_discounts = explode(',', $offer->discounts);
            $offer_products_taxes = explode(',', $offer->dreba);
            $offer_products_totals = explode(',', $offer->totals);
            $offer_products = [];

            foreach ($offer_products_ids as $key => $pid) {
                array_push($offer_products, Products::find($pid));
            }
            foreach ($offer_parts_ids as $key => $pid) {
                array_push($offer_products, Parts::find($pid));
            }

            $total_price = 0;
            if (count($offer_products_totals) > 0) {
                $total_price = array_sum($offer_products_totals);
            }
            $customers = Customers::all();
            $products = Products::all();
            $warehouses = Warehouse::all();
            $boxs = MoneyBox::all();
            return $this->getView($this->viewPath . 'create', $this->policy . 'update', ['offer_products_quantities' => $offer_products_quantities, 'offer_products_prices' => $offer_products_prices, 'offer_products_discounts' => $offer_products_discounts, 'offer_products_taxes' => $offer_products_taxes, 'offer_products_totals' => $offer_products_totals, 'offer_products' => $offer_products, 'offer' => $offer, 'customers' => $customers, 'products' => $products, 'total_price' => $total_price, 'warehouses' => $warehouses, 'maintenance' => $maintenance, 'boxs' => $boxs, 'edit' => true], 'edit');
        }
        $customers = Customers::all();
        $products = Products::all();
        $warehouses = Warehouse::all();
        $users = User::Where('type', 3)->get();
        $del_products_ids = [];
        $delivery_products_ids=[];
        $delivery_quantities=[];
        $delivery = null;
        $dlv = $request->delivery;
        if (isset($dlv) && $dlv != '') {
            $delivery = Delivery::find($dlv);
            if (isset($delivery)) {
                $del_products_ids = $delivery->products;
            }
        }
        if(count($del_products_ids) > 0){
            foreach ($del_products_ids as $key => $proid) {
                array_push($delivery_products_ids, $proid->product);
                array_push($delivery_quantities, $proid->quantity);
            }
        }
        $boxs = MoneyBox::all();

        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['customers' => $customers, 'products' => $products, 'warehouses' => $warehouses, 'users' => $users, 'del_products_ids' => $del_products_ids, 'delivery' => $delivery, 'boxs' => $boxs,'delivery_products_ids'=>$delivery_products_ids,'delivery_quantities'=>$delivery_quantities], 'create');
    }

    public function store(Request $request)
    {
        $quantities = '';
        $discounts  = '';
        $products   = '';
        $darebas    = '';
        $totalss    = '';
        $prices     = '';
        $parts      = '';

        if ($request['product']) {
            $elements_type  = $request['product_code_type'];
            $quantities     = [];
            $discounts      = [];
            $products       = [];
            $darebas        = [];
            $totalss        = [];
            $prices         = [];
            $parts          = [];

            foreach ($request['product'] as $k => $element) {
                if ($elements_type[$k] !== 'ES' && $elements_type[$k] !== 'EA') {
                    $quantities[]   = $request['quantity'][$k];
                    $discounts[]    = $request['discount'][$k];
                    $products[]     = $element;
                    $darebas[]      = $request['dareba'][$k];
                    $totalss[]      = $request['totals'][$k];
                    $prices[]       = $request['price'][$k];
                }
            }
            foreach ($request['product'] as $k => $element) {
                if ($elements_type[$k] === 'ES' || $elements_type[$k] === 'EA') {
                    $quantities[]   = $request['quantity'][$k];
                    $discounts[]    = $request['discount'][$k];
                    $darebas[]      = $request['dareba'][$k];
                    $totalss[]      = $request['totals'][$k];
                    $prices[]       = $request['price'][$k];
                    $parts[]        = $element;
                }
            }

            $quantities = implode(',', $quantities);
            $discounts  = implode(',', $discounts);
            $products   = implode(',', $products);
            $darebas    = implode(',', $darebas);
            $totalss    = implode(',', $totalss);
            $prices     = implode(',', $prices);
            $parts      = implode(',', $parts);
        }

        $offer = Sells::create([
            'maintenance_id'    => $request['maintenance_id'],
            'down_payment'      => $request['down_payment'],
            'warehouse_id'      => $request['warehouse'],
            'invoice_type'      => $request['invoice_type'],
            'delivery_id'       => $request['delivery'],
            'customer_id'       => $request['customer'],
            'products_id'       => $products,
            'addon_disc'        => $request['addon_disc'],
            'quantities'        => $quantities,
            'main_type'         => $request['main_type'],
            'discounts'         => $discounts,
            'parts_id'          => $parts,
            'user_id'           => auth()->id(),
            'branch'            => auth()->user()['branch'] ?? null,
            'box_id'            => $request['box_id'],
            'prices'            => $prices,
            'totals'            => $totalss,
            'notes'             => $request['notes'],
            'dreba'             => $darebas,
            'type'              => $request['invtype'],
            'date'              => $request['date'],
            'time'              => $request['time']
        ]);

        if($offer->prices !== null) {
            $total_before_vat   = 0;
            $quantities_total   = explode(',', $offer->quantities);
            $prices_total       = explode(',', $offer->prices);
            $total_vat          = 0;
            $total              = 0;

            foreach($prices_total as $key => $price) {
                $subtotal           = round((float)$quantities_total[$key] * (float)$price, 2);
                $discounts          = $subtotal * ((float)$quantities_total[$key] / 100);
                $totalBeforeVat     = $subtotal - $discounts;
                $total_before_vat   += $totalBeforeVat;
                $totalVatVal        = $totalBeforeVat * (getSettings('site_vat_value') / 100);
                $total_vat          += $totalVatVal;
                $totalVat           = round((float)$totalBeforeVat + (float)$totalVatVal, 2);
                $total              += $totalVat;
            }
            if (isset($offer->addon_disc) && $offer->addon_disc !== "" && $offer->addon_disc !== 0) {
                $total_before_vat   -= (float)$offer->addon_disc;
                $total_vat          = $total_before_vat * (getSettings('site_vat_value') / 100);
                $total              = $total_before_vat + $total_vat;
            }
            $offer->update(['total_money' => $total, 'total_vat' => $total_vat]);

            if($offer->invoice_type === 'cache') {
                $offer->dailyTransaction()->create([
                    'customer_id'   => $request['customer'],
                    'total_money'   => $total,
                    'total_vat'     => $total_vat,
                    'user_id'       => auth()->id(),
                    'box_id'        => $request['box_id']
                ]);
            }
        }

        if($offer->invoice_type === 'deferred' && $offer->down_payment !== 0 && $offer->down_payment !== null) {
            $sand = Sanadat::create([
                'cl_sup_id'     => $offer->customer_id,
                'acc_type'      => 'client',
                'sell_id'        => $offer->id,
                'box_id'        => $offer->box_id,
                'p_type'        => 1,
                'notes'         => $offer->notes,
                'type'          => 1,
                'cost'          => $offer->down_payment,
                'date'          => $offer->date,
                'time'          => $offer->time
            ]);

            $data = [
                'total_money'   => $sand->cost,
                'customer_id'   => $sand->cl_sup_id,
                'total_vat'     => $sand->cost * 0.15,
                'user_id'       => auth()->id(),
                'box_id'        => $sand->box_id
            ];

            $sand->dailyTransaction()->create($data);
        }

        $quantities = $request['quantity'];
        $prices     = $request['price'];
        foreach ($request['product'] as $k => $element) {
            if ($elements_type[$k] === 'ES' || $elements_type[$k] === 'EA') {
                SellProduct::create([
                    'warehouse_id'  => $offer->warehouse_id,
                    'quantity'      => $quantities[$k],
                    'sell_id'       => $offer->id,
                    'part_id'       => (int) $element,
                    'price'         => $prices[$k],
                    'type'          => $request['invtype']
                ]);
            } else {
                SellProduct::create([
                    'warehouse_id'  => $offer->warehouse_id,
                    'product_id'    => (int) $element,
                    'quantity'      => $quantities[$k],
                    'sell_id'       => $offer->id,
                    'price'         => $prices[$k],
                    'type'          => $request['invtype']
                ]);
            }
        }
        if ($request['invtype'] === 1) {
            DeliveryProduct::where('delivery_id', $request['delivery'])->update(['inv' => 1]);
        }

        if($request['main_type'] === '2' && $request['prstatus'] === '0') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=2')->withFlashMessage(trans('admin.created', ['name' => 'فاتورة بيع صيانه خارجيه']));
        }

        if($request['invtype'] === '2' && $request['main_type'] === '2' && $request['prstatus'] === '1') {
            if($offer->type === '2' && $offer->main_type === '2') {
                $count = $offer->where('type', 2)->where('main_type', 2)->currentYear()->count();
                return redirect(url('/') . "/sells/" . $offer->id . '?invoice_num=' . $count);
            }
        }

        if($request['main_type'] === '3' && $request['prstatus'] === '0') {
            return redirect(route('admin.sellsint.index'))->withFlashMessage(trans('admin.created', ['name' => 'فاتورة بيع داخليه']));
        }

        if($request['main_type'] === '3' && $request['prstatus'] === '1') {
            $count = $offer->where('type', 3)->where('main_type', 3)->currentYear()->count();
            return redirect(url('/') . "/sells/" . $offer->id . '?invoice_num=' . $count);
        }

        if($request['main_type'] === '4' && $request['prstatus'] === '0') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=4')->withFlashMessage(trans('admin.created', ['name' => 'فاتورة بيع زيارة ميدانيه']));
        }

        if($request['main_type'] === '4' && $request['prstatus'] === '1') {
            if($offer->type === '4' && $offer->main_type === '4') {
                $count = $offer->where('type', 4)->where('main_type', 4)->currentYear()->count();
                return redirect(url('/') . "/sells/" . $offer->id . '?invoice_num=' . $count);
            }
            return redirect(route('admin.sellsmnt.index') . '?main_type=4')->withFlashMessage(trans('admin.created', ['name' => 'فاتورة بيع زيارة ميدانيه']));
        }

        if($request['main_type'] === '5' && $request['prstatus'] === '0') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=5')->withFlashMessage(trans('admin.created', ['name' => 'فاتورة بيع مركز الاتصالات']));
        }

        if($request['invtype'] === '2' && $request['main_type'] === null && $request['prstatus'] === '0') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=1')->withFlashMessage(trans('admin.created', ['name' => 'فاتورة بيع ورشه']));
        }

        if($request['invtype'] === '2' && $request['main_type'] === null && $request['prstatus'] === '1') {
            if($offer->type === '2' && ($offer->main_type === null || $offer->main_type === 1)) {
                $count = $offer->where('type', 2)->whereNull('main_type')->orWhere('main_type', 1)->currentYear()->count();
                return redirect(url('/') . "/sells/" . $offer->id . '?invoice_num=' . $count);
            }
        }

        if($request['prstatus'] === '1') {
            $count = $offer->where('type', 0)->whereNULL('main_type')->currentYear()->count();
            return redirect(url('/') . "/sells/" . $offer->id . '?invoice_num=' . $count);
        }

        return redirect(route('sells.index'))->withFlashMessage(trans('admin.created', ['name' => 'فاتوره بيع معرض']));
    }

    public function show($id)
    {
        $offer = Sells::find($id);
        $customer = Customers::find($offer->customer_id);
        $products = explode(',', $offer->products_id);
        $parts = explode(',', $offer->parts_id);
        $quantities = explode(',', $offer->quantities);
        $prices = explode(',', $offer->prices);
        $discounts = explode(',', $offer->discounts);
        $drebas = explode(',', $offer->dreba);

        // get previous
        $previous = Sells::where('id', '<', $offer->id)->max('id');
        // get next
        $next = Sells::where('id', '>', $offer->id)->min('id');

        $allproducts = array();
        if (count($products) > 0 && $products[0] != null) {
            foreach ($products as $product) {
                $single = Products::find($product);
                array_push($allproducts, $single);
            }
        }
        if (count($parts) > 0 && $parts[0] != null) {
            foreach ($parts as $part) {
                $single = Parts::find($part);
                array_push($allproducts, $single);
            }
        }
        $total = 0;
        $total_vat = 0;
        $total_discount = 0;
        $total_quantitiy_price = 0;
        $total_before_vat = 0;
        foreach ($allproducts as $key => $product) {
            if (isset($product)) {
                $subtotal = round($quantities[$key] * $prices[$key], 2);
                $total_quantitiy_price += $subtotal;
                $totalsecond = $subtotal * ($discounts[$key] / 100);
                $total_discount += $totalsecond;
                $totalbeforevat = $subtotal - $totalsecond;

                $total_before_vat += $totalbeforevat;
                $totalvatval = $totalbeforevat * (getSettings('site_vat_value') / 100);
                $total_vat += $totalvatval;
                $totalvat = round($totalbeforevat + $totalvatval, 2);
                $total += $totalvat;

            }
        }
        if (isset($offer->addon_disc) && $offer->addon_disc != "" && $offer->addon_disc != 0) {
            $total_before_vat = $total_before_vat - $offer->addon_disc;
            $total_vat = $total_before_vat * (getSettings('site_vat_value') / 100);
            $total = $total_before_vat + $total_vat;
        }
        $total=number_format(round($total,2));
        $total_vat=round($total_vat,2);
        $timestamp = gmdate("Y-m-d\TH:i:s\Z", strtotime($offer->created_at));
        $vat_num = "300235684700003";
        $company = "شركة القائد الاول";
        $qrcode_img = GenerateQrCode::fromArray([
            new Seller($company), // seller name
            new TaxNumber($vat_num), // seller tax number
            new InvoiceDate($timestamp), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($total), // invoice total amount
            new InvoiceTaxAmount($total_vat), // invoice tax amount
        ])->render();

        $qrcode_string = GenerateQrCode::fromArray([
            new Seller($company), // seller name
            new TaxNumber($vat_num), // seller tax number
            new InvoiceDate($timestamp), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($total), // invoice total amount
            new InvoiceTaxAmount($total_vat), // invoice tax amount
        ])->toBase64();

        $qr_data = "inv=".$offer->code."&seller=" . $company . "&vat_num=" . $vat_num . "&time=" . $timestamp . "&total=" . $total . "&vat=" . $total_vat;

        return $this->getView($this->viewPath . 'show', $this->policy . 'create', ['previous' => $previous, 'next' => $next, 'offer' => $offer, 'allproducts' => $allproducts, 'quantities' => $quantities, 'prices' => $prices, 'discounts' => $discounts, 'drebas' => $drebas, 'customer' => $customer, 'qrcode_img' => $qrcode_img, 'qrcode_string' => $qrcode_string, 'qr_data' => $qr_data], 'create');
    }

    public function edit($id)
    {
        $offer = Sells::findOrFail($id);
        $customers = Customers::all();
        $products = Products::all();
        $warehouses = Warehouse::all();
        $boxs = MoneyBox::all();
        if ($offer->products_id != '') {
            $offer_products_ids = explode(',', $offer->products_id);
        } else {
            $offer_products_ids = [];
        }

        if ($offer->parts_id != '') {
            $offer_parts_ids = explode(',', $offer->parts_id);
        } else {
            $offer_parts_ids = [];
        }

        $offer_products_quantities = explode(',', $offer->quantities);
        $offer_products_prices = explode(',', $offer->prices);
        $offer_products_discounts = explode(',', $offer->discounts);
        $offer_products_taxes = explode(',', $offer->dreba);
        $offer_products_totals = explode(',', $offer->totals);
        $offer_products = [];

        foreach ($offer_products_ids as $key => $pid) {
            array_push($offer_products, Products::find($pid));
        }
        foreach ($offer_parts_ids as $key => $pid) {
            array_push($offer_products, Parts::find($pid));
        }

        $total_price = 0;
        if (count($offer_products_totals) > 0) {
            $total_price = array_sum($offer_products_totals);
        }
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['offer_products_quantities' => $offer_products_quantities, 'offer_products_prices' => $offer_products_prices, 'offer_products_discounts' => $offer_products_discounts, 'offer_products_taxes' => $offer_products_taxes, 'offer_products_totals' => $offer_products_totals, 'offer_products' => $offer_products, 'offer' => $offer, 'customers' => $customers, 'products' => $products, 'total_price' => $total_price, 'warehouses' => $warehouses, 'boxs' => $boxs, 'edit' => true], 'edit');
    }

    public function update($id, Request $request)
    {
        $offer = Sells::findOrFail($id);
        $products = '';
        $prices = '';
        $quantities = '';
        $darebas = '';
        $discounts = '';
        $totalss = '';
        $parts = '';
        if ($request->product) {
            $products = [];
            $parts = [];
            $prices = [];
            $quantities = [];
            $darebas = [];
            $discounts = [];
            $totalss = [];

            $elements_type = $request->product_code_type;

            foreach ($request->product as $k => $element) {
                if ($elements_type[$k] != 'ES' && $elements_type[$k] != 'EA') {
                    array_push($products, $element);
                    array_push($prices, $request->price[$k]);
                    array_push($quantities, $request->quantity[$k]);
                    array_push($darebas, $request->dareba[$k]);
                    array_push($discounts, $request->discount[$k]);
                    array_push($totalss, $request->totals[$k]);
                }
            }
            foreach ($request->product as $k => $element) {
                if ($elements_type[$k] == 'ES' || $elements_type[$k] == 'EA') {
                    array_push($parts, $element);
                    array_push($prices, $request->price[$k]);
                    array_push($quantities, $request->quantity[$k]);
                    array_push($darebas, $request->dareba[$k]);
                    array_push($discounts, $request->discount[$k]);
                    array_push($totalss, $request->totals[$k]);
                }
            }

            $products = implode(',', $products);
            $parts = implode(',', $parts);
            $prices = implode(',', $prices);
            $quantities = implode(',', $quantities);
            $darebas = implode(',', $darebas);
            $discounts = implode(',', $discounts);
            $totalss = implode(',', $totalss);
        }

        $offer->update([
            'user_id'           => auth()->id(),
            'delivery_id' => $request->delivery_id,
            'customer_id' => $request->customer,
            'products_id' => $products,
            'parts_id' => $parts,
            'quantities' => $quantities,
            'dreba' => $darebas,
            'prices' => $prices,
            'discounts' => $discounts,
            'type' => $request->invtype ?? 0,
            'notes' => $request->notes,
            'totals' => $totalss,
            'date' => $request->date,
            'time' => $request->time,
            'warehouse_id' => $request->warehouse,
            'addon_disc' => $request->addon_disc,
            'invoice_type'   => $request['invoice_type'],
            'down_payment'   => $request['down_payment'],
            'branch'            => auth()->user()['branch'] ?? null,

        ]);



        if($offer->prices !== null) {
            $total_before_vat   = 0;
            $quantities_total   = explode(',', $offer->quantities);
            $prices_total       = explode(',', $offer->prices);
            $total_vat          = 0;
            $total              = 0;

            foreach($prices_total as $key => $price) {
                $subtotal           = round((float)$quantities_total[$key] * (float)$price, 2);
                $discounts          = $subtotal * ((float)$quantities_total[$key] / 100);
                $totalBeforeVat     = $subtotal - $discounts;
                $total_before_vat   += $totalBeforeVat;
                $totalVatVal        = $totalBeforeVat * (getSettings('site_vat_value') / 100);
                $total_vat          += $totalVatVal;
                $totalVat           = round((float)$totalBeforeVat + (float)$totalVatVal, 2);
                $total              += $totalVat;
            }
            if (isset($offer->addon_disc) && $offer->addon_disc !== "" && $offer->addon_disc !== 0) {
                $total_before_vat   -= (float)$offer->addon_disc;
                $total_vat          = $total_before_vat * (getSettings('site_vat_value') / 100);
                $total              = $total_before_vat + $total_vat;
            }
            $offer->update(['total_money' => $total, 'total_vat' => $total_vat]);

            $offer->dailyTransaction()->update([
                'customer_id'   => $request['customer'],
                'total_money'   => $total,
                'total_vat'     => $total_vat,
                'user_id'       => auth()->id(),
                'box_id'        => $request['box_id']
            ]);
        }

        if($offer->invoice_type === 'deferred' && $offer->down_payment !== 0 && isset($offer->sand) && $offer->down_payment !== null) {
            $sand = $offer->sand->update([
                'cl_sup_id'     => $offer->customer_id,
                'acc_type'      => 'client',
                'box_id'        => $offer->box_id,
                'p_type'        => 1,
                'notes'         => $offer->notes,
                'type'          => 1,
                'cost'          => $offer->down_payment,
                'date'          => $offer->date,
                'time'          => $offer->time
            ]);

            $data = [
                'total_money'   => $offer->sand->cost,
                'customer_id'   => $offer->sand->cl_sup_id,
                'total_vat'     => $offer->sand->cost * 0.15,
                'user_id'       => auth()->id(),
                'box_id'        => $offer->sand->box_id
            ];

            $offer->sand->dailyTransaction()->update($data);
        }

        SellProduct::where('sell_id', $offer->id)->delete();
        $prices = $request->price;
        $quantities = $request->quantity;
        foreach ($request->product as $k => $element) {
            if ($elements_type[$k] == 'ES' || $elements_type[$k] == 'EA') {
                SellProduct::create([
                    'warehouse_id' => $offer->warehouse_id,
                    'sell_id' => $offer->id,
                    'part_id' => (int) $element,
                    'price' => $prices[$k],
                    'quantity' => $quantities[$k],
                    'type' => $request->invtype,
                ]);
            } else {
                SellProduct::create([
                    'warehouse_id' => $offer->warehouse_id,
                    'sell_id' => $offer->id,
                    'product_id' => (int) $element,
                    'price' => $prices[$k],
                    'quantity' => $quantities[$k],
                    'type' => $request->invtype,
                ]);
            }
        }

        if(($request['main_type'] === '2' || ($offer->main_type === 2 && $offer->type === 2)) && $request->prstatus === '0') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=2')->withFlashMessage(trans('admin.updated', ['name' => 'فاتورة بيع صيانه خارجيه']));
        }

        if(($request['invtype'] === '2' && $request['main_type'] === null) && $request->prstatus === '0') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=1')->withFlashMessage(trans('admin.updated', ['name' => 'فاتورة بيع ورشه']));
        }

        if($request['main_type'] === '4'&& $request->prstatus === '0') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=4')->withFlashMessage(trans('admin.updated', ['name' => 'فاتورة بيع زيارة ميدانيه']));
        }

        if($request['main_type'] === '5'&& $request->prstatus === '0') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=5')->withFlashMessage(trans('admin.updated', ['name' => 'فاتورة بيع مركز الاتصالات']));
        }

        if(($request['main_type'] === '3' || $offer->type === 3) && $request->prstatus === '0') {
            return redirect(route('admin.sellsint.index'))->withFlashMessage(trans('admin.updated', ['name' => 'فاتورة بيع داخليه']));
        }

        if ($request['prstatus'] === '1') {
            if(
                ($offer->type === '3' && $offer->main_type === 3) ||
                ($offer->type === '0' && $offer->main_type === null) ||
                ($offer->type === '2' && $offer->main_type === 2) ||
                ($offer->type === '2' && $offer->main_type === null) ||
                ($offer->type === '4' && $offer->main_type === 4)
            ) {
                return redirect(url('/') . "/sells/" . $offer->id . '?invoice_num=' . $request['invoice_num']);
            }

            return redirect(url('/') . "/sells/" . $offer->id)->withFlashMessage(trans('admin.updated', ['name' => ' فاتوره بيع']));
        } else {
            if ($request->maintenance_id) {
                return redirect(route('maintenance.index'))->withFlashMessage(trans('admin.updated', ['name' => 'فاتوره بيع']));
            } else {
                return redirect(route('sells.index'))->withFlashMessage(trans('admin.updated', ['name' => 'فاتوره بيع معرض']));
            }
        }
    }

    public function destroy($id, Request $request)
    {
        $sell = Sells::findOrFail($id);
//        if($sell->invoice_type === 'deferred' && $sell->down_payment !== 0 && isset($sell->sand)) {
//            $sell->sand->delete();
//            if(isset($sell->dailyTransaction)) {
//                $sell->sand->dailyTransaction()->delete();
//            }
//        }
//        if(isset($sell->dailyTransaction)) {
//            $sell->dailyTransaction()->delete();
//        }
        $sell->delete();
        $delMessage = trans('admin.deleted', ['name' => 'فاتوره بيع']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }

        if($request['main_type'] === '1') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=1')->withFlashMessage(trans('admin.deleted', ['name' => 'فاتورة بيع طلبات الورشه']));
        }

        if($request['main_type'] === '2') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=2')->withFlashMessage(trans('admin.deleted', ['name' => 'فاتورة بيع طلبات الورشه']));
        }

        if($request['main_type'] === '4') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=4')->withFlashMessage(trans('admin.deleted', ['name' => 'فاتورة بيع زيارة ميدانيه']));
        }

        if($request['main_type'] === '5') {
            return redirect(route('admin.sellsmnt.index') . '?main_type=5')->withFlashMessage(trans('admin.deleted', ['name' => 'فاتورة بيع مركز الاتصالات']));
        }

        if($request['main_type'] === '3') {
            return redirect(route('admin.sellsint.index'))->withFlashMessage(trans('admin.deleted', ['name' => 'فاتورة بيع داخليه']));
        }

        return redirect(route('sells.index'))->withFlashMessage($delMessage);
    }
}
