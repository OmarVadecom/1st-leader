<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Customers;
use App\Models\Parts;
use App\Models\PriceOffer;
use App\Models\Products;
use App\Models\Visits;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class OffersController extends MainController
{
    private $viewPath = 'admin.priceoffer.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.priceoffer'));
    }
    public function addoffer()
    {
        $type = Input::get('type');
        $visit_id = Input::get('visit');
        $customers = Customers::all();
        $products = Products::all();
        if (isset($visit_id)) {
            $visit = Visits::find($visit_id);
            $alproducts = explode(',', $visit->products_id);
            $quantities = explode(',', $visit->quantities);
            $allproducts = array();
            foreach ($alproducts as $product) {
                $single = Products::find($product);
                array_push($allproducts, $single);
            }
            return $this->getView($this->viewPath . 'add', $this->policy . 'update', ['visit' => $visit, 'allproducts' => $allproducts, 'quantities' => $quantities, 'type' => $type, 'customers' => $customers, 'products' => $products], 'edit');
        } else {
            return $this->getView($this->viewPath . 'add', $this->policy . 'update', ['customers' => $customers, 'products' => $products], 'edit');
        }
    }

    public function editOffer($id)
    {
        $offer = PriceOffer::findOrFail($id);
        $customers = Customers::all();
        $products = Products::all();
        if ($offer->products_id != '') {
            $offer_products_ids = explode(',', $offer->products_id);
        } else {
            $offer_products_ids = [];
        }

        if ($offer->products_id != '') {
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
        $offer_products = [];

        foreach ($offer_products_ids as $key => $pid) {
            array_push($offer_products, Products::find($pid));
        }

        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['offer_products_quantities' => $offer_products_quantities, 'offer_products_client_details' => $offer_products_client_details, 'offer_products_offer_details' => $offer_products_offer_details, 'offer_products_prices' => $offer_products_prices, 'offer_products_discounts' => $offer_products_discounts, 'offer_products_taxes' => $offer_products_taxes, 'offer_products_totals' => $offer_products_totals, 'offer_products' => $offer_products, 'offer' => $offer, 'customers' => $customers, 'products' => $products, 'edit' => true], 'edit');
    }

    public function showVerifyOffer($id)
    {
        $offer = PriceOffer::findOrFail($id);
        $customers = Customers::all();
        $products = Products::all();
        if ($offer->products_id != '') {
            $offer_products_ids = explode(',', $offer->products_id);
        } else {
            $offer_products_ids = [];
        }

        $offer_products_quantities = explode(',', $offer->quantities);
        $offer_products_prices = explode(',', $offer->prices);
        $offer_products_discounts = explode(',', $offer->discounts);
        $offer_products_taxes = explode(',', $offer->dreba);
        $offer_products_totals = explode(',', $offer->totals);
        $offer_products_client_details = explode(',', $offer->client_details);
        $offer_products_offer_details = explode(',', $offer->offer_details);
        $offer_products = [];

        foreach ($offer_products_ids as $key => $pid) {
            array_push($offer_products, Products::find($pid));
        }

        $total_price = 0;
        if (count($offer_products_totals) > 0) {
            $total_price = array_sum($offer_products_totals);
        }

        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['offer_products_quantities' => $offer_products_quantities, 'offer_products_client_details' => $offer_products_client_details, 'offer_products_offer_details' => $offer_products_offer_details, 'offer_products_prices' => $offer_products_prices, 'offer_products_discounts' => $offer_products_discounts, 'offer_products_taxes' => $offer_products_taxes, 'offer_products_totals' => $offer_products_totals, 'offer_products' => $offer_products, 'offer' => $offer, 'customers' => $customers, 'products' => $products, 'total_price' => $total_price, 'verify' => true], 'edit');
    }

    public function saveoffer(Request $request)
    {
        $products = '';
        $prices = '';
        $quantities = '';
        $darebas = '';
        $discounts = '';
        $totalss = '';
        if ($request->product) {
            $products = implode(',', $request->product);
            $prices = implode(',', $request->price);
            $quantities = implode(',', $request->quantity);
            $darebas = implode(',', $request->dareba);
            $discounts = implode(',', $request->discount);
            $totalss = implode(',', $request->totals);
        }
        $offer_details = implode(',', $request->offer_details);
        $client_details = implode(',', $request->client_details);

        $offer = PriceOffer::create([
            'parent' => $request->get('parent'),
            'user_id' => Auth::user()->id,
            'visit_id' => $request->visit_id,
            'customer_id' => $request->customer,
            'inv_type' => $request->inv_type,
            'products_id' => $products,
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
            'offer_number' => 0,
            'declaration' => $request->declaration,
            'offer_details' => $offer_details,
            'client_details' => $client_details,

        ]);

        if ($request->prstatus == 1) {
            return redirect(url('/') . "/offer/" . $offer->id)->withFlashMessage(trans('admin.created', ['name' => 'عرض سعر']));
        } else {
            return redirect(route('offers.index'))->withFlashMessage(trans('admin.created', ['name' => 'عرض سعر']));
        }
    }

    public function updateOffer($id, Request $request)
    {

        $offer = PriceOffer::findOrFail($id);
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
            $elements_type = $request->product_code_type;

            foreach ($request->product as $k => $element) {
                if ($elements_type[$k] == 'ES' || $elements_type[$k] == 'EA') {
                    array_push($parts, $element);
                } else {
                    array_push($products, $element);
                }
            }

            $products = implode(',', $products);
            $parts = implode(',', $parts);
            $prices = implode(',', $request->price);
            $quantities = implode(',', $request->quantity);
            $darebas = implode(',', $request->dareba);
            $discounts = implode(',', $request->discount);
            $totalss = implode(',', $request->totals);
        }
        $offer_details = implode(',', $request->offer_details);
        $client_details = implode(',', $request->client_details);

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
            'offer_number' => 0,
            'declaration' => $request->declaration,
            'offer_details' => $offer_details,
            'client_details' => $client_details,

        ]);

        return redirect(route('offers.index'))->withFlashMessage(trans('admin.updated', ['name' => 'عرض سعر']));
    }

    public function postoffer()
    {
        $customers = Customers::all();
        $products = Products::all();

        return $this->getView($this->viewPath . 'addnew', $this->policy . 'update', ['customers' => $customers, 'products' => $products], 'edit');
    }

    public function getoffers()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function getmooffers()
    {
        return $this->getView($this->viewPath . 'mo_offer', $this->policy . 'view');
    }

    public function AjaxLoad(PriceOffer $data)
    {
        $products = PriceOffer::where('type', 0)->where('parent', null)->get();
        return Datatables::of($products)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
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

            ->editColumn('status', function ($model) {
                return '<p class="notverified">غير معمد </p><a type="button" class="btn btn-success" href="' . route('admin.offer.show_verify', $model->id) . '">تعميد</a>';
            })

            ->editColumn('copy', function ($model) {
                $linksoffer = '';
                if (count($model->offers) > 0) {
                    foreach ($model->offers as $key => $offer) {
                        $num = $key + 1;
                        $linksoffer .= '<a href="' . url('/') . '/offer/' . $offer->id . '/edit">Offer ' . $num . 'A </a><br>';
                    }
                }
                $linksoffer .= '<a href="' . url('/') . '/add-offer?parent=' . $model->id . '">اضافه تحديث لعرض السعر </a>';
                return $linksoffer;
            })
            ->editColumn('total', function ($model) {

                $totals = explode(',', $model->totals);
                $sum = 0;
                if (count($totals) > 0) {
                    $sum = array_sum($totals);
                }
                return $sum;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('admin.offer.edit', $model->id), null);
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function AjaxLoadmooffer(PriceOffer $data)
    {
        $products = PriceOffer::with('invoice')->where('type', 1)->get();
        return Datatables::of($products)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
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

            ->editColumn('status', function ($model) {

                $offer = PriceOffer::where('status', $model->id)->first();
                if ($offer) {
                    return '<p class="verified">معمد</p><br><a href="' . url("/") . '/offer/' . $offer->id . '" target="_blank" style="margin-top:-25px;display: block;">عرض السعر الغير معمد </a>';
                } else {
                    return '<p class="verified">معمد</p>';
                }
            })

            ->editColumn('total', function ($model) {

                $totals = explode(',', $model->totals);
                $sum = 0;
                if (count($totals) > 0) {
                    $sum = array_sum($totals);
                }
                return $sum;
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
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('admin.offer', $model->id), null, null);
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function offer($id)
    {
        $offer = PriceOffer::find($id);
        $customer = Customers::find($offer->customer_id);
        $products = explode(',', $offer->products_id);
        $quantities = explode(',', $offer->quantities);
        $prices = explode(',', $offer->prices);
        $discounts = explode(',', $offer->discounts);
        $drebas = explode(',', $offer->dreba);

        // get previous
        $previous = PriceOffer::where('id', '<', $offer->id)->max('id');
        // get next
        $next = PriceOffer::where('id', '>', $offer->id)->min('id');

        $allproducts = array();
        foreach ($products as $product) {
            $single = Products::find($product);
            array_push($allproducts, $single);
        }
        return $this->getView($this->viewPath . 'show', $this->policy . 'create', ['previous' => $previous, 'next' => $next, 'offer' => $offer, 'allproducts' => $allproducts, 'quantities' => $quantities, 'prices' => $prices, 'discounts' => $discounts, 'drebas' => $drebas, 'customer' => $customer], 'create');
    }

    public function changestatus(Request $request)
    {
        $offer = PriceOffer::find($request->get('id'));
        $newoffer = $offer->replicate();
        $newoffer->type = 1;
        $newoffer->status = $offer->id;
        $newoffer->save();
        $offer->status = $newoffer->id;
        $offer->save();
    }

    public function printcaroc($id)
    {
        $visit = Visits::find($id);
        $customer = Customers::find($visit->customer_id);
        return $this->getView($this->viewPath . 'printcaroc', $this->policy . 'create', ['visit' => $visit, 'customer' => $customer], 'create');
    }

    public function ajaxSearch(Request $request)
    {

        $keyword = $request->get('keyword');

        $products = Products::where('code', 'LIKE', '%' . $keyword . '%')->with(['addon' => function ($query) {
            $query->select(['product_id', 'prices']);
        }])->get();

        $parts = Parts::where('code', 'LIKE', '%' . $keyword . '%')->with(['addon' => function ($query) {
            $query->select(['part_id', 'prices']);
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
}
