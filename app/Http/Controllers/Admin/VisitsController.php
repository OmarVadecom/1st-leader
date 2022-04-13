<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Customers;
use App\Models\PriceOffer;
use App\Models\Products;
use App\Models\Purchase;
use App\Models\Sells;
use App\Models\VisitClient;
use App\Models\VisitDelegate;
use App\Models\VisitMarket;
use App\Models\Visits;
use App\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Carbon\Carbon;

class VisitsController extends MainController
{

    private $viewPath = 'admin.visit.';
    private $policy = 'visits.';

    public function index()
    {
        View::share('pageTitle', 'visits');
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        View::share('pageTitle', 'visits');
        $customers = Customers::all();
        $products = Products::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['products' => $products, 'customers' => $customers], 'create');
    }

    public function edit($id)
    {
        View::share('pageTitle', 'visits');
        $visit = Visits::find($id);
        $customers = Customers::all();
        $products = Products::all();
        $inproducts = explode(',', $visit->products_in);
        $inquantities = explode(',', $visit->quantities_in);
        $outproducts = explode(',', $visit->products_out);
        $outquantities = explode(',', $visit->quantities_out);
        $clients = explode(',', $visit->clientrate->client_clients);
        $marketbrand = explode(',', $visit->market->market_brand);
        $markettype = explode(',', $visit->market->market_type);
        $market_model = explode(',', $visit->market->market_model);
        // get previous
        $previous = Visits::where('id', '<', $visit->id)->max('id');
        // get next
        $next = Visits::where('id', '>', $visit->id)->min('id');

        $allinproducts = array();
        foreach ($inproducts as $inproduct) {
            $single = Products::find($inproduct);
            array_push($allinproducts, $single);
        }
        $inproducts = $allinproducts;

        return $this->getView($this->viewPath . 'edit', $this->policy . 'edit', ['previous' => $previous, 'next' => $next, 'visit' => $visit, 'products' => $products, 'customers' => $customers, 'inproducts' => $inproducts, 'inquantities' => $inquantities, 'outproducts' => $outproducts, 'outquantities' => $outquantities, 'client_clients' => $clients, 'marketbrand' => $marketbrand, 'markettype' => $markettype, 'market_model' => $market_model], 'edit');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cardimage' => 'mimes:jpg,png,jpeg',
        ]);
        $cardname = '';
        $card = $request->file('cardimage');
        if ($card && $card->isValid()) {
            $extensioncard = $card->getClientOriginalExtension();
            $cardname = 'card-image' . time() . '.' . $extensioncard;
            $card->move('public/uploads/card_images', $cardname);
        }
        $inproducts = implode(',', $request->in_product);
        $inquantities = implode(',', $request->in_quantity);
        $outproducts = implode(',', $request->out_product);
        $outquantities = implode(',', $request->out_quantity);
        $clients = implode(',', $request->client_clients);
        $marketbrand = implode(',', $request->market_brand);
        $markettype = implode(',', $request->market_type);
        $market_model = implode(',', $request->market_model);

        $visit = new Visits;
        $visit->user_id = Auth::user()->id;
        $visit->customer_id = $request->customer;
        $visit->type = $request->visittype;
        $visit->notes = $request->notes;
        $visit->inform = $request->inform;
        $visit->lat = $request->lat;
        $visit->lng = $request->lng;
        $visit->date = $request->date;
        $visit->hour = $request->time;
        $visit->card_image = $cardname;
        $visit->products_in = $inproducts;
        $visit->products_out = $outproducts;
        $visit->quantities_in = $inquantities;
        $visit->quantities_out = $outquantities;
        $visit->save();

        VisitClient::create([
            'visit_id' => $visit->id,
            'mainrate' => $request->mainrate,
            'segl_type' => $request->segl_type,
            'client_type' => $request->client_type,
            'resp_name' => $request->resp_name,
            'client_phone' => $request->client_phone,
            'client_decision' => $request->client_decision,
            'client_serious' => $request->client_serious,
            'client_ready' => $request->client_ready,
            'client_con' => $request->client_con,
            'client_clients' => $clients,
            'client_phone' => $request->client_phone,
            'client_ins' => $request->client_ins,
            'locationrate' => $request->locationrate,
            'location_type' => $request->location_type,
            'services' => $request->services,
            'location_status' => $request->location_status,
            'client_location_status' => $request->client_location_status,
            'goods_available' => $request->goods_available,
            'cleaning' => $request->cleaning,
            'equip_interest' => $request->equip_interest,
            'distance' => $request->distance,
            'workrate' => $request->workrate,
            'work_num' => $request->work_num,
            'nationality' => $request->nationality,
            'worker_rate' => $request->worker_rate,
            'worker_qualify' => $request->worker_qualify,
        ]);

        VisitDelegate::create([
            'visit_id' => $visit->id,
            'delegatestars' => $request->delegatestars,
            'delegateclient' => $request->delegateclient,
            'con_way' => $request->con_way,
            'del_notes' => $request->del_notes,
            'del_visit' => $request->del_visit,
            'del_visit_reason' => $request->del_visit_reason,
            'managervisit' => $request->managervisit,
            'managerdelegate' => $request->managerdelegate,
            'sales_notes' => $request->sales_notes,
            'sales_recommend' => $request->sales_recommend,
        ]);

        VisitMarket::create([
            'visit_id' => $visit->id,
            'market_brand' => $marketbrand,
            'market_type' => $markettype,
            'market_model' => $market_model,
        ]);

        return redirect(route('visits.index'))->withFlashMessage('تم انشاء الزياره بنجاح');
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'cardimage' => 'mimes:jpg,png,jpeg',
        ]);
        $card = $request->file('cardimage');
        $cardname = $request->oldcardimage;
        if ($card && $card->isValid()) {
            $extension = $card->getClientOriginalExtension();
            $cardname = 'card-image' . time() . '.' . $extension;
            $card->move('public/uploads/card_images', $cardname);
        }

        $inproducts = implode(',', $request->in_product);
        $inquantities = implode(',', $request->in_quantity);
        $outproducts = implode(',', $request->out_product);
        $outquantities = implode(',', $request->out_quantity);
        $clients = implode(',', $request->client_clients);
        $marketbrand = implode(',', $request->market_brand);
        $markettype = implode(',', $request->market_type);
        $market_model = implode(',', $request->market_model);

        $visit = Visits::find($id);
        $visit->type = $request->visittype;
        $visit->customer_id = $request->customer;
        $visit->notes = $request->notes;
        $visit->inform = $request->inform;
        $visit->lat = $request->lat;
        $visit->lng = $request->lng;
        $visit->date = $request->date;
        $visit->hour = $request->time;
        $visit->card_image = $cardname;
        $visit->products_in = $inproducts;
        $visit->products_out = $outproducts;
        $visit->quantities_in = $inquantities;
        $visit->quantities_out = $outquantities;
        $visit->save();

        VisitClient::where('visit_id', $visit->id)->update([
            'mainrate' => $request->mainrate,
            'segl_type' => $request->segl_type,
            'client_type' => $request->client_type,
            'resp_name' => $request->resp_name,
            'client_phone' => $request->client_phone,
            'client_decision' => $request->client_decision,
            'client_serious' => $request->client_serious,
            'client_ready' => $request->client_ready,
            'client_con' => $request->client_con,
            'client_clients' => $clients,
            'client_phone' => $request->client_phone,
            'client_ins' => $request->client_ins,
            'locationrate' => $request->locationrate,
            'location_type' => $request->location_type,
            'services' => $request->services,
            'location_status' => $request->location_status,
            'client_location_status' => $request->client_location_status,
            'goods_available' => $request->goods_available,
            'cleaning' => $request->cleaning,
            'equip_interest' => $request->equip_interest,
            'distance' => $request->distance,
            'workrate' => $request->workrate,
            'work_num' => $request->work_num,
            'nationality' => $request->nationality,
            'worker_rate' => $request->worker_rate,
            'worker_qualify' => $request->worker_qualify,
        ]);

        VisitDelegate::where('visit_id', $visit->id)->update([
            'delegatestars' => $request->delegatestars,
            'delegateclient' => $request->delegateclient,
            'con_way' => $request->con_way,
            'del_notes' => $request->del_notes,
            'del_visit' => $request->del_visit,
            'del_visit_reason' => $request->del_visit_reason,
            'managervisit' => $request->managervisit,
            'managerdelegate' => $request->managerdelegate,
            'sales_notes' => $request->sales_notes,
            'sales_recommend' => $request->sales_recommend,
        ]);
        VisitMarket::where('visit_id', $visit->id)->update([
            'market_brand' => $marketbrand,
            'market_type' => $markettype,
            'market_model' => $market_model,
        ]);

        return redirect(route('visits.index'))->withFlashMessage('تم تعديل بيانات الزياره بنجاح');
    }

    public function show($id)
    {
        View::share('pageTitle', 'visits');

        $visit = Visits::find($id);
        $products = explode(',', $visit->products_id);
        $quantities = explode(',', $visit->quantities);
        $allproducts = array();
        foreach ($products as $product) {
            $single = Products::find($product);
            array_push($allproducts, $single);
        }
        return $this->getView($this->viewPath . 'show', $this->policy . 'show', ['visit' => $visit, 'allproducts' => $allproducts, 'quantities' => $quantities], 'create');
    }

    public function AjaxLoad(Visits $data)
    {
        $initVisits = Visits::currentYear();
        DB::statement(DB::raw('set @rownum=' . ($initVisits->count() + 1)));
        $visits = $initVisits->select(['visits.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();

        return Datatables::of($visits)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('id', function ($model) {
                return str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })

            ->editColumn('user', function ($model) {

                return $model->user->name;
            })

            ->editColumn('customer', function ($model) {

                return $model->customer->name;
            })

            ->editColumn('priceoffer', function ($model) {
                $return = '';
                if (Auth::user()->can('sliders.create')) {
                    if (count($model->priceoffers) > 0) {
                        $return .= '<a href="' . url('/') . '/offer/' . $model->priceoffers[0]->id . '" target="_blank">عرض السعر الغير معمد</a>';
                    }
                    if (count($model->priceoffers) > 1) {
                        $return .= '<br><a href="' . url('/') . '/offer/' . $model->priceoffers[1]->id . '" target="_blank">عرض السعر المعمد</a>';
                    }
                }
                return $return;
            })

            ->editColumn('status', function ($model) {

                if (count($model->priceoffers) == 2) {
                    $status = "<i style='color:green' class='fa fa-check' aria-hidden='true'></i>";
                } else {
                    $status = "<i style='color:red' class='fa fa-times' aria-hidden='true'></i>";
                }

                if ($model->prepare_order == 1) {
                    $prepare_order = "<i style='color:green' class='fa fa-check' aria-hidden='true'></i>";
                } else {
                    $prepare_order = "<i style='color:red' class='fa fa-times' aria-hidden='true'></i>";
                }

                if ($model->delivery_order == 1) {
                    $delivery_order = "<i style='color:green' class='fa fa-check' aria-hidden='true'></i>";
                } else {
                    $delivery_order = "<i style='color:red' class='fa fa-times' aria-hidden='true'></i>";
                }
                return 'سعر معمد: ' . $status . '<br>امر التحضير: ' . $prepare_order . '<br>امر التسليم: ' . $delivery_order;
            })

            ->editColumn('action', function ($model) {
                if ($model->delivery_order == 1) {
                    return getAjaxAction($this->policy, $model, null, route('visits.edit', $model->id));
                } else {
                    return getAjaxAction($this->policy, $model, null, route('visits.edit', $model->id), route('visits.destroy', $model->id));
                }
            })
            ->escapeColumns([])
            ->make(true);
    }

    //----------------------------------------------------
    //-----------------prepare----------------------------

    public function preparing_orders()
    {
        View::share('pageTitle', 'preparing_orders');

        return $this->getView($this->viewPath . 'prepare.index', $this->policy . 'preparing_orders');
    }

    public function AjaxLoadprepare(Visits $data)
    {

        $products = PriceOffer::where('type', 1)->currentYear()->get();
        return Datatables::of($products)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('user', function ($model) {

                return $model->user->name;
            })

            ->editColumn('customer', function ($model) {

                return $model->customer->name;
            })

            ->editColumn('status', function ($model) {

                if ((isset($model->visit) && $model->visit->prepare_order == 1) || ($model->prepare == 1)) {
                    $prepare_order = "<i style='color:green' class='fa fa-check' aria-hidden='true'></i>";
                } else {
                    $prepare_order = "<i style='color:red' class='fa fa-times' aria-hidden='true'></i>";
                }

                return 'امر التحضير: ' . $prepare_order;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('admin.preparing.show', $model->id));
            })
            ->make(true);
    }

    public function show_preparing_orders($id)
    {
        View::share('pageTitle', 'preparing_orders');
        $visit = PriceOffer::find($id);
        $products = explode(',', $visit->products_id);
        $quantities = explode(',', $visit->quantities);
        $allproducts = array();
        foreach ($products as $product) {
            $single = Products::find($product);
            array_push($allproducts, $single);
        }

        // get previous
        $previous = PriceOffer::where('type', 1)->where('id', '<', $visit->id)->max('id');
        // get next
        $next = PriceOffer::where('type', 1)->where('id', '>', $visit->id)->min('id');

        return $this->getView($this->viewPath . 'prepare.show', $this->policy . 'show_preparing_orders', ['previous' => $previous, 'next' => $next, 'visit' => $visit, 'allproducts' => $allproducts, 'quantities' => $quantities], 'create');
    }

    public function update_preparing_orders(Request $request)
    {
        $id = $request->visit_id;
        $price_id = $request->price_id;
        $notes = $request->prepare_notes;
        $visit = Visits::find($id);
        if ($visit) {
            $visit->prepare_order = (bool) $request->status;
            $visit->prepare_notes = $notes;
            $visit->save();
        }
        $price = PriceOffer::find($price_id);
        $price->prepare = (bool) $request->status;
        $price->prepare_notes = $notes;
        $price->save();
        return back();
    }

    //---------------------------------------------------------------
    //--------------------------delivery-----------------------------

    public function delivery_orders()
    {
        View::share('pageTitle', 'delivery_orders');
        return $this->getView($this->viewPath . 'delivery.index', $this->policy . 'delivery_orders');
    }
    public function show_delivery_orders($id)
    {
        View::share('pageTitle', 'delivery_orders');
        $visit = PriceOffer::find($id);
        $products = explode(',', $visit->products_id);
        $quantities = explode(',', $visit->quantities);
        $allproducts = array();
        foreach ($products as $product) {
            $single = Products::find($product);
            array_push($allproducts, $single);
        }
        // get previous
        $previous = PriceOffer::where('prepare', 1)->where('id', '<', $visit->id)->max('id');
        // get next
        $next = PriceOffer::where('prepare', 1)->where('id', '>', $visit->id)->min('id');

        return $this->getView($this->viewPath . 'delivery.show', $this->policy . 'show_delivery_orders', ['visit' => $visit, 'allproducts' => $allproducts, 'quantities' => $quantities, 'next' => $next, 'previous' => $previous], 'create');
    }

    public function update_delivery_orders(Request $request)
    {
        $id = $request->price_id;
        $visit = PriceOffer::find($id);
        // $products = explode(',', $visit->products_id);
        // $quantities = explode(',', $visit->quantities);
        // $prices = explode(',', $visit->totals);
        // if ((boolean) $request->status == 1) {
        //     foreach ($products as $key => $product) {
        //         $productupd = Products::find($product);
        //           Sells::create([
        //             'product_id'=> $product,
        //             'quantity'=> $quantities[$key],
        //             'price'=> $prices[$key],
        //             'insurance'=> $visit->insurance,
        //         ]);
        //         $quant = $productupd->quantity - $quantities[$key];
        //         $productupd->quantity = $quant;
        //         $productupd->save();
        //     }
        // }
        $this->validate($request, [
            'carnumber' => 'mimes:jpeg,jpg,png',
            'cardriver' => 'mimes:jpeg,jpg,png',
        ]);

        $carnumberf = '';
        $cardriverf = '';
        $carnumber = $request->file('carnumber');
        $cardriver = $request->file('cardriver');

        if ($carnumber && $carnumber->isValid()) {
            $extension = $carnumber->getClientOriginalExtension();
            $carnumberf = 'car-number' . time() . '.' . $extension;
            $carnumber->move('public/uploads/car_numbers', $carnumberf);
        }
        if ($cardriver && $cardriver->isValid()) {
            $extension = $cardriver->getClientOriginalExtension();
            $cardriverf = 'car-driver' . time() . '.' . $extension;
            $cardriver->move('public/uploads/drivers', $cardriverf);
        }
        $visit->license_image = $carnumberf;
        $visit->driver_image = $cardriverf;
        $visit->delivery = (bool) $request->status;
        $visit->save();
        return back();
    }

    public function AjaxLoaddelivery(Visits $data)
    {

        $products = PriceOffer::where('prepare', 1)->currentYear()->get();
        return Datatables::of($products)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('user', function ($model) {

                return $model->user->name;
            })

            ->editColumn('customer', function ($model) {

                return $model->customer->name;
            })

            ->editColumn('status', function ($model) {

                if ($model->type == 1) {
                    $status = "<i style='color:green' class='fa fa-check' aria-hidden='true'></i>";
                } else {
                    $status = "<i style='color:red' class='fa fa-times' aria-hidden='true'></i>";
                }
                //---------------
                if ($model->prepare == 1) {
                    $prepare_order = "<i style='color:green' class='fa fa-check' aria-hidden='true'></i>";
                } else {
                    $prepare_order = "<i style='color:red' class='fa fa-times' aria-hidden='true'></i>";
                }
                //------------------
                if ($model->delivery == 1) {
                    $delivery_order = "<i style='color:green' class='fa fa-check' aria-hidden='true'></i>";
                } else {
                    $delivery_order = "<i style='color:red' class='fa fa-times' aria-hidden='true'></i>";
                }
                return 'سعر معمد: ' . $status . '<br>امر التحضير: ' . $prepare_order . '<br>امر التسليم: ' . $delivery_order;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('admin.delivery.show', $model->id));
            })
            ->make(true);
    }

    //-----------------------------------------------------------
    //---------------------------Reports-------------------------

    public function sold_report()
    {
        View::share('pageTitle', 'movment-track');
        return $this->getView($this->viewPath . 'reports.sold', $this->policy . 'sold_report');
    }

    public function AjaxLoadsold()
    {
        $visits = PriceOffer::where('delivery', 1)->currentYear()->get();
        $allproducts = array();
        $products = array();
        $quantities = array();
        foreach ($visits as $visit) {
            $productss = explode(',', $visit->products_id);
            $quantitiess = explode(',', $visit->quantities);
            $products = array_merge($products, $productss);
            $quantities = array_merge($quantities, $quantitiess);
        }
        foreach ($products as $key => $product) {
            $single = Products::find($product);
            $single->quantityp = $quantities[$key];
            array_push($allproducts, $single);
        }

        return Datatables::of($allproducts)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('product', function ($model) {

                return $model->name_en;
            })

            ->editColumn('quantity', function ($model) {

                return $model->quantityp;
            })

            ->make(true);
    }

    public function buy_report()
    {
        View::share('pageTitle', 'movment-track');
        return $this->getView($this->viewPath . 'reports.buy', $this->policy . 'buy_report');
    }
    public function AjaxLoadbuy()
    {
        $purchases = Purchase::with('products')->currentYear()->get();
        return Datatables::of($purchases)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('product', function ($model) {

                return $model->products->name_en;
            })

            ->editColumn('quantity', function ($model) {

                return $model->quantity;
            })

            ->editColumn('date', function ($model) {

                return $model->date . ' ' . $model->time;
            })

            ->make(true);
    }

    public function mahgoz_report()
    {
        View::share('pageTitle', 'movment-track');
        return $this->getView($this->viewPath . 'reports.mahgoz', $this->policy . 'booked_report');
    }

    public function AjaxLoadmahgoz()
    {
        $visits = PriceOffer::where('delivery', 1)->orwhere('prepare', 1)->currentYear()->get();
        $allproducts = array();
        $products = array();
        $quantities = array();
        foreach ($visits as $visit) {
            $productss = explode(',', $visit->products_id);
            $quantitiess = explode(',', $visit->quantities);
            $products = array_merge($products, $productss);
            $quantities = array_merge($quantities, $quantitiess);
        }
        foreach ($products as $key => $product) {
            $single = Products::find($product);
            $single->quantityp = $quantities[$key];
            array_push($allproducts, $single);
        }

        return Datatables::of($allproducts)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('product', function ($model) {

                return $model->name_en;
            })

            ->editColumn('quantity', function ($model) {

                return $model->quantityp;
            })

            ->make(true);
    }

    public function available_report()
    {
        View::share('pageTitle', 'movment-track');
        return $this->getView($this->viewPath . 'reports.available', $this->policy . 'available_report');
    }

    public function sells_of_day()
    {
        $customers = Customers::all();
        View::share('pageTitle', 'movment-track');
        return $this->getView($this->viewPath . 'reports.sells_of_day', $this->policy . 'sells_of_day', ['customers' => $customers]);
    }

    public function reports_sells(Request $request)
    {
        if ($request['date_from']) {

            $from = Carbon::parse($request['date_from'])->startOfDay();

            if($request['date_to'] === "") {
                $to = date('Y-m-d');
            } else {
                $to = Carbon::parse($request['date_to'])->endOfDay();
            }

            if($request['customer'] && $request['customer'] !== "") {
                $sells = Sells::whereBetween('created_at', [$from, $to])->where('customer_id', $request['customer'])->get();
                $sum_sells_vat = Sells::whereBetween('created_at', [$from, $to])->where('customer_id', $request['customer'])->sum('total_vat');
                $sum_sells_total = Sells::whereBetween('created_at', [$from, $to])->where('customer_id', $request['customer'])->sum('total_money');
            } else {
                $results = Sells::whereBetween('created_at', [$from, $to]);
                $sells = $results->get();
                $sum_sells_vat = $results->sum('total_vat');
                $sum_sells_total = $results->sum('total_money');
            }

        } else {
            $sells = Sells::all();
            $sum_sells_vat = Sells::sum('total_vat');
            $sum_sells_total = Sells::sum('total_money');
        }

        View::share('pageTitle', 'movment-track');
        return $this->getView($this->viewPath . 'reports.sells', $this->policy . 'reports_sells', ['sells' => $sells, 'total' => $sum_sells_total, 'vat' => $sum_sells_vat, 'from' => $from, 'to' => $to]);
    }

    public function AjaxLoadavailable()
    {
        $visits = Products::where('quantity', '>', 0)->get();

        return Datatables::of($visits)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('product', function ($model) {

                return $model->name;
            })

            ->editColumn('quantity', function ($model) {

                return $model->quantity;
            })

            ->make(true);
    }

    public function AjaxLoadSells(Request $request)
    {
        if ($request->get('from')) {

            $from = Carbon::parse($request->get('from'))->startOfDay();

            if($request->get('to') === "") {
                $to = date('Y-m-d');
            } else {
                $to   = Carbon::parse($request->get('to'))->endOfDay();
            }

            $sells = Sells::whereBetween('created_at', [$from, $to])->get();
        } else {
            $sells = Sells::all();
        }

        return Datatables::of($sells)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('id', function ($model) {
                return $model->code;
            })

            ->editColumn('total_money', function ($model) {
                return $model->total_money;
            })

            ->editColumn('total_vat', function ($model) {
                return $model->total_vat;
            })

            ->make(true);
    }

    public function destroy($id, Request $request)
    {
        $visit = Visits::findOrFail($id);
        VisitClient::where('visit_id', $visit->id)->delete();
        VisitDelegate::where('visit_id', $visit->id)->delete();
        VisitMarket::where('visit_id', $visit->id)->delete();
        $visit->delete();
        $delMessage = trans('admin.deleted', ['name' => ' زياره']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('brands.index'))->withFlashMessage($delMessage);
    }

    public function mapvisits(Request $request)
    {
        $type = $request->get('type');
        if ($type == "all") {
            $visits = Visits::all();
        } elseif ($type == "target") {
            $visits = Visits::where('type', 0)->get();
        } else {
            $visits = Visits::where('type', 1)->get();
        }
        return $this->getView($this->viewPath . 'map', $this->policy . 'map_visits', ['visits' => $visits]);
    }
}
