<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Attachment;
use App\Models\Customers;
use App\Models\Funds;
use App\Models\Parts;
use App\Models\Preparation;
use App\Models\PrepareProduct;
use App\Models\PriceOffer;
use App\Models\Products;
use App\Models\Visits;
use App\Models\Warehouse;
use App\Models\DeliveryProduct;
use App\Models\SellProduct;
use App\Models\Supplier;
use App\Models\MoneyBox;
use Auth;
use App\Models\CustomerCategory;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\NumberFormatter;
use Response;

class PriceOfferController extends MainController
{
    private $viewPath = 'admin.priceoffer.';
    private $policy = 'PriceOffers.';
    private $number = '';


    public function __construct()
    {
        View::share('pageTitle', trans('admin.priceoffer'));
    }

    public function create()
    {
        $type = Input::get('type');
        $visit_id = Input::get('visit');
        $parent = Input::get('parent');
        $boxs = MoneyBox::all();
        $edit = null;
        $customers = Customers::all();
        $products = Products::all();
        $warehouses = Warehouse::all();
        $suppliers = '';
        if (\Request::get('status') == 1 || \Request::get('status') == 2) {
            if (\Request::get('pur_type')) {
                $suppliers = Supplier::where('type', 1)->get();
            } else {
                $suppliers = Supplier::where('type', 0)->get();
            }
        }
        if (isset($parent)) {
            $edit = true;
            $offer = PriceOffer::findOrFail($parent);
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
            $offer_products_client_details = explode(',', $offer->client_details);
            $offer_products_offer_details = explode(',', $offer->offer_details);
            $addon_notes = explode(',', $offer->addon_notes);
            $addon_discounts = explode(',', $offer->addon_discount);
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
            return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['offer_products_quantities' => $offer_products_quantities, 'offer_products_client_details' => $offer_products_client_details, 'offer_products_offer_details' => $offer_products_offer_details, 'offer_products_prices' => $offer_products_prices, 'offer_products_discounts' => $offer_products_discounts, 'offer_products_taxes' => $offer_products_taxes, 'offer_products_totals' => $offer_products_totals, 'offer_products' => $offer_products, 'offer' => $offer, 'customers' => $customers, 'products' => $products, 'addon_notes' => $addon_notes, 'addon_discounts' => $addon_discounts, 'total_price' => $total_price, 'warehouses' => $warehouses, 'boxs' => $boxs, 'edit' => $edit], 'edit');
        }
        if (isset($visit_id)) {
            $visit = Visits::find($visit_id);
            $alproducts = explode(',', $visit->products_id);
            $quantities = explode(',', $visit->quantities);
            $allproducts = array();
            foreach ($alproducts as $product) {
                $single = Products::find($product);
                array_push($allproducts, $single);
            }
            return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['visit' => $visit, 'allproducts' => $allproducts, 'quantities' => $quantities, 'type' => $type, 'customers' => $customers, 'products' => $products, 'warehouses' => $warehouses], 'edit');
        } else {
            return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['customers' => $customers, 'products' => $products, 'warehouses' => $warehouses, 'suppliers' => $suppliers], 'edit');
        }
    }

    public function edit($id, Request $request)
    {
        $offer = PriceOffer::findOrFail($id);
        $customers = Customers::all();
        $products = Products::all();
        $boxs = MoneyBox::all();

        $suppliers = '';
        if (\Request::get('status') == 1 || \Request::get('status') == 2) {
            if (\Request::get('pur_type')) {
                $suppliers = Supplier::where('type', 1)->get();
            } else {
                $suppliers = Supplier::where('type', 0)->get();
            }
        }
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
        $offer_products_client_details = explode(',', $offer->client_details);
        $offer_products_offer_details = explode(',', $offer->offer_details);
        $addon_notes = explode(',', $offer->addon_notes);
        $addon_discounts = explode(',', $offer->addon_discount);
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
        if ($request->q == "verify") {
            $verify = true;
        } else {
            $verify = null;
        }

        return $this->getView($this->viewPath . 'edit', $this->policy . 'edit', ['offer_products_quantities' => $offer_products_quantities, 'offer_products_client_details' => $offer_products_client_details, 'offer_products_offer_details' => $offer_products_offer_details, 'offer_products_prices' => $offer_products_prices, 'offer_products_discounts' => $offer_products_discounts, 'offer_products_taxes' => $offer_products_taxes, 'offer_products_totals' => $offer_products_totals, 'offer_products' => $offer_products, 'offer' => $offer, 'customers' => $customers, 'products' => $products, 'addon_notes' => $addon_notes, 'addon_discounts' => $addon_discounts, 'total_price' => $total_price, 'verify' => $verify, 'suppliers' => $suppliers, 'boxs' => $boxs, 'edit' => true], 'edit');
    }

    public function show($id, Request $request)
    {
        $offer = PriceOffer::find($id);
        $customer = Customers::find($offer->customer_id);
        $products = explode(',', $offer->products_id);
        $parts = explode(',', $offer->parts_id);
        $quantities = explode(',', $offer->quantities);
        $prices = explode(',', $offer->prices);
        $discounts = explode(',', $offer->discounts);
        $drebas = explode(',', $offer->dreba);

        // get previous
        $previous = PriceOffer::where('id', '<', $offer->id)->where('status', 0)->max('id');
        // get next
        $next = PriceOffer::where('id', '>', $offer->id)->where('status', 0)->min('id');

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
        if ($request->get('type') == 'image') {
            return $this->getView($this->viewPath . 'show_img', $this->policy . 'show', ['previous' => $previous, 'next' => $next, 'offer' => $offer, 'allproducts' => $allproducts, 'quantities' => $quantities, 'prices' => $prices, 'discounts' => $discounts, 'drebas' => $drebas, 'customer' => $customer], 'create');
        } else {
            return $this->getView($this->viewPath . 'show', $this->policy . 'show', ['previous' => $previous, 'next' => $next, 'offer' => $offer, 'allproducts' => $allproducts, 'quantities' => $quantities, 'prices' => $prices, 'discounts' => $discounts, 'drebas' => $drebas, 'customer' => $customer], 'create');
        }
    }

    public function store(Request $request)
    {
        $products = '';
        $prices = '';
        $quantities = '';
        $darebas = '';
        $discounts = '';
        $parts = '';
        $totalss = '';
        $addon_discount = '';
        $addon_notes = '';

        if ($request->product) {
            $products = [];
            $parts = [];
            $prices = [];
            $quantities = [];
            $darebas = [];
            $discounts = [];
            $totalss = [];
            $addon_discount = [];
            $addon_notes = [];
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
            $addon_discount = implode(',', $addon_discount);
            $addon_notes = implode(',', $addon_notes);
        }
        $offer_details = implode(',', $request->offer_details);
        $client_details = implode(',', $request->client_details);
        if (isset($request->status)) {
            $status = $request->status;
        } else {
            $status = 0;
        }

        $supplier_name = null;
        $supplier_id = null;
        if ($request->supplier_id) {
            $supplier_name = Supplier::find($request->supplier_id)->name;
            $supplier_id = $request->supplier_id;
        }


        $offer = PriceOffer::create([
            'box_id' => $request->box_id,
            'parent' => $request->parent,
            'user_id' => Auth::user()->id,
            'visit_id' => $request->visit_id,
            'customer_id' => $request->customer,
            'products_id' => $products,
            'parts_id' => $parts,
            'quantities' => $quantities,
            'dreba' => $darebas,
            'prices' => $prices,
            'discounts' => $discounts,
            'type' => 0,
            'notes' => $request->notes,
            'totals' => $totalss,
            'date' => $request->date,
            'time' => $request->time,
            'offer_duration' => $request->offer_duration,
            'declaration' => $request->declaration,
            'offer_details' => $offer_details,
            'client_details' => $client_details,
            'status' => $status,
            'supplier' => $supplier_name,
            'supplier_id' => $supplier_id,
            'supplier_comp' => $request->supplier_comp,
            'pur_type' => $request->pur_type,
            'addon_disc' => $request->addon_disc,

        ]);

        if ($offer->status == 1) {
            $route = route('admin.po_purchase.index') . '?status=1';
        } else {
            $route = route('priceoffer.index');
        }


        if ($request->prstatus == 1) {
            return redirect(url('/') . "/offer/" . $offer->id)->withFlashMessage(trans('admin.created', ['name' => 'عرض سعر']));
        } else {
            return redirect($route)->withFlashMessage(trans('admin.created', ['name' => 'عرض سعر']));
        }
    }

    public function update($id, Request $request)
    {

        $offer = PriceOffer::findOrFail($id);
        $products = '';
        $prices = '';
        $quantities = '';
        $darebas = '';
        $discounts = '';
        $totalss = '';
        $parts = '';
        $addon_discount = '';
        $addon_notes = '';
        if ($request->product) {
            $products = [];
            $parts = [];
            $prices = [];
            $quantities = [];
            $darebas = [];
            $discounts = [];
            $totalss = [];
            $addon_discount = [];
            $addon_notes = [];
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
            $addon_discount = implode(',', $addon_discount);
            $addon_notes = implode(',', $addon_notes);
        }
        $offer_details = implode(',', $request->offer_details);
        $client_details = implode(',', $request->client_details);
        if (isset($request->status)) {
            $status = $request->status;
        } else {
            $status = $offer->status;
        }
        $supplier_name = $offer->supplier;
        $supplier_id = $offer->supplier_id;
        if ($request->supplier_id) {
            $supplier_name = Supplier::find($request->supplier_id)->name;
            $supplier_id = $request->supplier_id;
        }
        $offer->update([
            'user_id' => Auth::user()->id,
            'visit_id' => $request->visit_id,
            'customer_id' => $request->customer,
            'inv_type' => $request->inv_type,
            'products_id' => $products,
            'parts_id' => $parts,
            'quantities' => $quantities,
            'dreba' => $darebas,
            'prices' => $prices,
            'discounts' => $discounts,
            'type' => 0,
            'notes' => $request->notes,
            'totals' => $totalss,
            'date' => $request->date,
            'time' => $request->time,
            'offer_duration' => $request->offer_duration,
            'declaration' => $request->declaration,
            'offer_details' => $offer_details,
            'client_details' => $client_details,
            'status' => $status,
            'supplier' => $supplier_name,
            'supplier_id' => $supplier_id,
            'supplier_comp' => $request->supplier_comp,
            'addon_disc' => $request->addon_disc,
        ]);

        if (isset($request->inv_type) && $request->inv_type != "") {
            $productsarr = explode(',', $products);
            $prepare = Preparation::create([
                'price_id' => $offer->id,
                'customer_id' => $request->customer,
                'date' => date('Y-m-d'),
                'time' => date('H:i'),
            ]);
            foreach ($productsarr as $key => $product) {
                PrepareProduct::create([
                    'prepare_id' => $prepare->id,
                    'product_id' => $product,
                    'quantity' => $request->quantity[$key],
                    'prepared' => 0,
                    'remains' => $request->quantity[$key],
                    'status' => 0,
                ]);
            }
            if ($request->inv_type == 1) {
                $offer->update([
                    'type' => 1,
                    'inv_type' => 1,
                ]);
                Funds::create([
                    'price_id' => $offer->id,
                    'client_id' => $request->customer,
                    'inv_type' => 1,
                    'money' => $request->total_price,
                    'date_from' => date('Y-m-d'),
                    'date_to' => date('Y-m-d'),
                    'status' => 1,
                ]);
            } elseif ($request->inv_type == 2) {
                $startpayment = $request->total_price * $request->startpayment / 100;
                $offer->update([
                    'type' => 1,
                    'inv_type' => 2,
                    'down_payment_perc' => $request->startpayment,
                    'down_payment' => $startpayment,
                ]);
                Funds::create([
                    'price_id' => $offer->id,
                    'client_id' => $request->customer,
                    'money' => $startpayment,
                    'date_from' => date('Y-m-d'),
                    'date_to' => date('Y-m-d'),
                    'status' => 1,
                ]);
                $unit_prices = $request->unit_price;
                foreach ($unit_prices as $key => $unit_price) {
                    Funds::create([
                        'price_id' => $offer->id,
                        'client_id' => $request->customer,
                        'money' => $unit_price,
                        'date_from' => Carbon::parse($request->date_from[$key]),
                        'date_to' => Carbon::parse($request->date_to[$key]),
                        'type' => $request->unit_type[$key],
                        'bank' => $request->unit_bank[$key],
                        'bank_num' => $request->unit_bank_number[$key],
                        'note' => $request->unit_notes[$key],
                        'status' => 0,
                    ]);
                }
            } elseif ($request->inv_type == 3) {
                $offer->update([
                    'type' => 1,
                    'inv_type' => 3,
                ]);
                Funds::create([
                    'price_id' => $offer->id,
                    'client_id' => $request->customer,
                    'inv_type' => 1,
                    'money' => $request->total_price,
                    'date_from' => Carbon::parse($request->datefrom[$key]),
                    'date_to' => Carbon::parse($request->dateto[$key]),
                    'status' => 0,
                ]);
            }
        }

        if ($offer->status == 1 || $offer->status == 2) {

            $route = route('admin.po_purchase.index') . '?status=' . $offer->status . '&pur_type=' . $offer->pur_type;
            $message = "عرض سعر";
        } elseif ($offer->status == 3) {

            $route = route('purchases.index') . '?status=' . $offer->status . '&pur_type=' . $offer->pur_type;
            $message = "أمر شراء";
        } else {
            $route = route('priceoffer.index');
            $message = "عرض سعر";
        }
        return redirect($route)->withFlashMessage(trans('admin.updated', ['name' => $message]));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function index_verify()
    {
        return $this->getView($this->viewPath . 'mo_offer', $this->policy . 'index_verify');
    }

    public function AjaxLoad(PriceOffer $data)
    {
        $initProducts = PriceOffer::where('type', 0)->where('status', 0)->orderBy('created_at', 'desc')->currentYear();
        DB::statement(DB::raw('set @rownum=' . ($initProducts->count() + 1)));
        $products = $initProducts->select(['price_offers.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();

        return Datatables::of($products)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('num', function ($model) {
                return 'QUT-' . substr($model->created_at->format('Y'), -2) . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })
            ->editColumn('title', function ($model) {

                if ($model->visit_id != null) {
                    return $model->visit_id . '<br><a href="' . url("/") . '/visits/' . $model->visit_id . '/edit">الذهاب للزياره</a>';
                } else {
                    return '-';
                }
            })
            ->editColumn('customer', function ($model) {

                return $model->customer->name;
            })
            ->editColumn('customer_category', function ($model) {
                $customer_cat = CustomerCategory::find($model->customer->category_id);
                return $customer_cat->name;
            })

            // ->editColumn('status', function ($model) {
            //     return '<p class="notverified">غير معمد </p><a type="button" class="btn btn-success" href="' . route('admin.offer.show_verify', $model->id) . '">تعميد</a>';
            // })

            ->editColumn('copy', function ($model) {
                $linksoffer = '';
                if (count($model->offers) > 0) {
                    foreach ($model->offers as $key => $offer) {
                        $num = $key + 1;
                        $linksoffer .= '<a target="_blank" href="' . url('/') . '/priceoffer/' . $offer->id . '">' . $offer->code . ' </a> | <a  href="' . url('/') . '/priceoffer/' . $offer->id . '?type=image"  target="_blank"><i class="fa fa-image"></i></a><br>';
                    }
                }
                $linksoffer .= '<a href="' . url('/') . '/priceoffer/create?parent=' . $model->id . '&client=' . $model->customer->id . '">اضافه تحديث لعرض السعر </a>';
                return $linksoffer;
            })
            ->editColumn('verify', function ($model) {
                return '<a href="' . url('/') . '/priceoffer/' . $model->id . '/edit?q=verify">  تعميد عرض السعر </a>';
            })
            ->editColumn('total', function ($model) {

                $totals = explode(',', $model->totals);
                $sum = 0;
                if (count($totals) > 0) {
                    $sum = array_sum($totals);
                }
                if (isset($model->addon_disc) && $model->addon_disc != "" && $model->addon_disc != 0) {
                    return number_format($sum - $model->addon_disc, 2);
                }
                return '<p style="font-family:ge-dinar, serif">' . number_format($sum, 2) . '</p>';
            })
            ->editColumn('action', function ($model) {
                if (Auth::user()->id == 9 || Auth::user()->id == 1) {
                    $return = getAjaxAction($this->policy, $model, route('priceoffer.show', $model->id) . '?invoice_num=' . $model->rownum, route('priceoffer.edit', $model->id), route('priceoffer.destroy', $model->id));
                } else {
                    $return = getAjaxAction($this->policy, $model, route('priceoffer.show', $model->id) . '?invoice_num=' . $model->rownum, route('priceoffer.edit', $model->id), null);
                }
                $return .= '<a href="' . route('priceoffer.show', $model->id) . '?invoice_num=' . $model->rownum . '&type=image" class="btn btn-circle" target="_blank"><i class="fa fa-image"></i></a>';
                return $return;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function AjaxLoadmooffer(PriceOffer $data)
    {
        $initProducts = PriceOffer::with('invoice')->where('type', 1)->where('status', 0)->orderBy('created_at', 'desc')->currentYear();
        DB::statement(DB::raw('set @rownum=' . ($initProducts->count() + 1)));
        $products = $initProducts->select(['price_offers.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();

        return Datatables::of($products)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('customer', function ($model) {

                return $model->customer->name;
            })
            ->editColumn('customer_category', function ($model) {
                $customer_cat = CustomerCategory::find($model->customer->category_id);
                return $customer_cat->name;
            })
            ->editColumn('status', function ($model) {

                return '<p class="verified">معمد</p>';
            })
            ->editColumn('total', function ($model) {

                $totals = explode(',', $model->totals);
                $sum = 0;
                if (count($totals) > 0) {
                    $sum = array_sum($totals);
                }
                if (isset($model->addon_disc) && $model->addon_disc != "" && $model->addon_disc != 0) {
                    return number_format($sum - $model->addon_disc, 2);
                }
                return number_format($sum, 2);
            })
            ->editColumn('ceroc', function ($model) {

                return '<a href="' . url("/") . '/print-caroc-report/' . $model->visit_id . '" target="_blank">نموزج كروكيه</a>';
            })
            ->editColumn('sell', function ($model) {

                $return = '';
                if (count($model->invoice) > 0) {
                    foreach ($model->invoice as $inv) {
                        $return .= '<a style="color: #00a414;" href="' . url("/") . '/sells/' . $inv->id . '" target="_blank">عرض فاتوره رقم ' . $inv->id . '</a> <br>';
                    }
                    return $return . '<a href="' . url("/") . '/sells/' . $model->id . '/edit" target="_blank">انشاء فاتوره اخري</a>';
                } else {
                    return '<a href="' . url("/") . '/sells/' . $model->id . '/edit" target="_blank">انشاء فاتوره البيع</a>';
                }
            })
            ->editColumn('number', function ($model) {
               $num =  $this->number = 'APV-' . substr($model->created_at->format('Y'), -2) . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
                return  $num;
            })
            ->editColumn('date', function ($model) {

                return $model->date . ' ' . $model->time;
            })
            ->editColumn('offertype', function ($model) {
                if ($model->inv_type == 1) {
                    return "دفع نقدي";
                } elseif ($model->inv_type == 2) {
                    return 'دفع علي دفعات <br><a href="' . url("/") . '/funds?po=' . $model->id . '" target="_blank">' . count($model->funds) . ' دفعات </a>';
                } elseif ($model->inv_type == 3) {
                    return 'دفع اجل <br><a href="' . url("/") . '/funds?po=' . $model->id . '" target="_blank"> تفاصيل الدفع </a>';
                }
            })
            ->editColumn('action', function ($model) {
//                if ($model->inv_type == 2) {
//                $return = getAjaxAction($this->policy, $model, route('priceoffer.show', $model->id) . '?invoice_num=' . $model->rownum, null, null);
//                $return .= '<a href="' . route('priceoffer.show', $model->id) . '?invoice_num=' . $model->rownum . '&type=image" class="btn btn-circle" target="_blank"><i class="fa fa-image"></i></a>';
//                }
                $return ='';
                if ($model->inv_type == 2) {
                    $return .= '<a href="' . route('priceoffer.add_attach', $model->id) . '" class="btn btn-circle" target="_blank"><i class="icon-cloud-upload"></i></a>';
                    $return .= '<a href="' . route('priceoffer.contract', $model->id  ) . '" class="btn btn-circle" target="_blank"><i class="icon-file-text"></i></a>';
                }else{
                    $return = getAjaxAction($this->policy, $model, route('priceoffer.show', $model->id) . '?invoice_num=' . $model->rownum, null, null);
                    $return .= '<a href="' . route('priceoffer.show', $model->id) . '?invoice_num=' . $model->rownum . '&type=image" class="btn btn-circle" target="_blank"><i class="fa fa-image"></i></a>';
                }
//                $return .= '<a href="' . route('priceoffer.edit_verify', $model->id) . '" class="btn btn-circle" target="_blank"><i class="fa fa-edit"></i></a>';

                return $return;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function ajaxSearch(Request $request)
    {
        $products = null;
        $keyword = $request->get('keyword');
        if (!$request->get('flag') && $request->get('flag') != 1) {
            $products = Products::where('hidden', '!=', 1)->where(function ($query) use ($keyword) {
                $query->where('code', 'LIKE', '%' . $keyword . '%')->orwhere('name', 'LIKE', '%' . $keyword . '%');
            })->with(['addon' => function ($query) {
                $query->select(['product_id', 'prices']);
            }])->with(['supplies' => function ($query) {
                $query->select(['product_id', 'quantity', 'warehouse_id', 'price']);
            }])->get();
        }
        $parts = Parts::where('hidden', '!=', 1)->where(function ($query) use ($keyword) {
            $query->where('code', 'LIKE', '%' . $keyword . '%')->orwhere('name', 'LIKE', '%' . $keyword . '%');
        })->with(['addon' => function ($query) {
            $query->select(['part_id', 'prices']);
        }])->with(['supplies' => function ($query) {
            $query->select(['product_id', 'quantity', 'warehouse_id', 'price']);
        }])->get();

        if ($products != null && $parts != null) {
            $allproducts = $products->merge($parts);
        } elseif ($products != null && $parts == null) {
            $allproducts = $products;
        } elseif ($products == null && $parts != null) {
            $allproducts = $parts;
        } else {
            $allproducts = [];
        }
        $warehouses = Warehouse::all();

        foreach ($allproducts as $product) {
            if (isset($product->code_type)) {
                $code = $product->code_type;
                $delivered = DeliveryProduct::where('product_id', $product->id)->where('code_type', $code)->sum('delivered');
                $sold = SellProduct::where('part_id', $product->id)->where('type', 0)->sum('quantity');
                $reserved = DeliveryProduct::where('product_id', $product->id)->where('code_type', $code)->sum('remains');
                foreach ($warehouses as $ware) {
                    $delivered_ware = DeliveryProduct::where('product_id', $product->id)->where('warehouse_id', $ware->id)->where('code_type', $code)->sum('delivered');
                    $sold_ware = SellProduct::where('part_id', $product->id)->where('type', 0)->where('warehouse_id', $ware->id)->sum('quantity');
                    $sum = $delivered_ware + $sold_ware;
                    $str = 'ware_id_' . $ware->id;
                    $product->$str = $sum;
                }
            } else {
                $delivered = DeliveryProduct::where('product_id', $product->id)->wherenull('code_type')->sum('delivered');
                $sold = SellProduct::where('product_id', $product->id)->where('type', 0)->sum('quantity');
                $reserved = DeliveryProduct::where('product_id', $product->id)->wherenull('code_type')->sum('remains');
                foreach ($warehouses as $ware) {
                    $delivered_ware = DeliveryProduct::where('product_id', $product->id)->where('warehouse_id', $ware->id)->wherenull('code_type')->sum('delivered');
                    $sold_ware = SellProduct::where('product_id', $product->id)->where('type', 0)->where('warehouse_id', $ware->id)->sum('quantity');
                    $sum = $delivered_ware + $sold_ware;
                    $str = 'ware_id_' . $ware->id;
                    $product->$str = $sum;
                }
            }
            $product->delivered = $delivered;
            $product->sold = $sold;
            $product->reserved = $reserved;
        }
        // foreach ($allproducts as $product) {
        //     dd($product->supplies()->first()->warehouse()->first()->name);
        // }
        return response()->json($allproducts);
    }

    public function ajaxAdd(Request $request)
    {
        $product_ids = $request->get('product_ids');
        $part_ids = $request->get('part_ids');

        $products = Products::find($product_ids);
        $parts = Parts::find($part_ids);

        if ($products != null && $parts != null) {
            $allproducts = $products->merge($parts);
        } elseif ($products != null && $parts == null) {
            $allproducts = $products;
        } elseif ($products == null && $parts != null) {
            $allproducts = $parts;
        } else {
            $allproducts = [];
        }
        return response()->json($allproducts);
    }

    public function destroy($id, Request $request)
    {
        PriceOffer::where('parent', $id)->delete();
        PriceOffer::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'عرض سعر']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('priceoffer.index'))->withFlashMessage($delMessage);
    }

    public function edit_verify($id, Request $request)
    {
        $offer = PriceOffer::findOrFail($id);
//        $totals = $offer->totals;
//        if (count($totals) > 0) {
//            $sum = array_sum($totals);
//        }
//        if (isset($offer->addon_disc) && $offer->addon_disc != "" && $offer->addon_disc != 0) {
//            return number_format($sum - $offer->addon_disc,2);
//        }
////        return number_format($sum,2);

        return view('admin.priceoffer.edit_verify');
    }

    public function add_attach_form($id)
    {
        $offer = PriceOffer::find($id);
        return view('admin.priceoffer.add_attach_mo', compact('offer'));
    }

    public function upload_attach_mo(Request $request, $id)
    {
        $input = $request->all();
        $this->validate($request,[
            'attach' => 'required',
            'type' => 'required',

        ]);
        if ($request->has('attach'))
        {
            $file_path = 'public/attachments';
            $attach = $request->file('attach');
            $attach_name = $attach->getClientOriginalName();
            $path = $request->file('attach')->storeAs($file_path,$attach_name);
            $input['attachment'] = $attach_name;
        }
      $attach = Attachment::create([
         'type' => $request->type,
         'attach' => $attach_name,
          'offer_id' => $id
      ]);
        return redirect()->route('admin.mooffer')->with('message','تم اضافة المرفقات بنجاح ');
    }

    public function contract_sale($id)
    {
        $offer = PriceOffer::find($id);
        // get category name of customer
        $category = CustomerCategory::find($offer->customer->category_id);
        $category_name = $category->name;

        $this->number;
        $offer_number =  'APV-' . substr($offer->created_at->format('Y'), -2) . '-' . str_pad($offer->rownum, 4, '0', STR_PAD_LEFT);
        $totals = explode(',', $offer->totals);
        $sum = 0;
        if (count($totals) > 0) {
            $sum = array_sum($totals);
        }
        if (isset($offer->addon_disc) && $offer->addon_disc != "" && $offer->addon_disc != 0) {
            return number_format($sum - $offer->addon_disc, 2);
        }
        $total_price = number_format($sum, 2);

        $percent = $sum * 0.30;
        // رقميا
        $percent_format = number_format($percent, 2);
        // كتابيا
        $f = new \NumberFormatter( "ar", \NumberFormatter::SPELLOUT );
        $word_percent = $f->format($percent);



        $percent_remainder = $sum * 0.70;
        // كتابيا
        $f = new \NumberFormatter( "ar", \NumberFormatter::SPELLOUT );
        $word_remainder= $f->format($percent_remainder);

        $funds = Funds::where('price_id', $id)->get();
//      $num_of_funds =   $funds->code . '-' . str_pad($funds->rownum, 4, '0', STR_PAD_LEFT);

        //get date of fuds

        $fund_date_start   = Funds::where('price_id', $id)->first();
        $fund_date_end   = Funds::where('price_id', $id)->orderBy('created_at', 'desc')->first();



        // old invoice
        $offer = PriceOffer::find($id);
        $customer = Customers::find($offer->customer_id);
        $products = explode(',', $offer->products_id);
        $parts = explode(',', $offer->parts_id);
        $quantities = explode(',', $offer->quantities);
        $prices = explode(',', $offer->prices);
        $discounts = explode(',', $offer->discounts);
        $drebas = explode(',', $offer->dreba);

        // get previous
        $previous = PriceOffer::where('id', '<', $offer->id)->where('status', 0)->max('id');
        // get next
        $next = PriceOffer::where('id', '>', $offer->id)->where('status', 0)->min('id');

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


        return view('admin.priceoffer.contract_sale' , compact('offer','offer_number','total_price','percent_format','percent_remainder','word_percent','word_remainder','funds','previous','next','offer','allproducts','quantities','prices','discounts','drebas','customer','category_name','fund_date_start','fund_date_end'));
    }
}
