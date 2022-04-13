<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\PurchasePriceOffer;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Supplier;
use App\Models\Purchase;
use App\Models\Parts;
use DataTables;

class PurchasePriceOfferController extends MainController
{
    private $viewPath = 'admin.purchases_prices_offers.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.purchasesPricesOffers'));
    }

    public function index(Request $request)
    {
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $type = $request['type'];
        } else {
            $type = null;
        }
        return $this->getView($this->viewPath . 'index', $this->policy . 'view', ['type' => $type]);
    }

    public function AjaxLoad(Request $request)
    {
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $initPurchasesPricesOffers = PurchasePriceOffer::where([['status', 0], ['type', $request['type']]])->orderBy('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initPurchasesPricesOffers->count() + 1)));
            $purchasesPricesOffers = $initPurchasesPricesOffers->select(['purchases_prices_offers.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        } else {
            $initPurchasesPricesOffers = PurchasePriceOffer::where('status', 0)->orderBy('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initPurchasesPricesOffers->count() + 1)));
            $purchasesPricesOffers = $initPurchasesPricesOffers->select(['purchases_prices_offers.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        }

        return Datatables::of($purchasesPricesOffers)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('num', function ($model) {
                return $model->code . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })

            ->editColumn('supplier', function ($model) {
                return $model->supplier_name;
            })

            ->editColumn('total', function ($model) {
                return (float)$model->total_money + (float)$model->total_vat;
            })

            ->editColumn('action', function ($model) use ($request) {
                if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
                    return getAjaxAction($this->policy, $model, route('purchases-prices-offers.show', $model->id) . '?type=' . $request['type'] . '&invoice_num=' . $model->rownum, route('purchases-prices-offers.edit', $model->id) . '?type=' . $request['type'], route('purchases-prices-offers.destroy', $model->id) . '?type=' . $request['type']);
                }

                return getAjaxAction($this->policy, $model, route('purchases-prices-offers.show', $model->id) . '?invoice_num=' . $model->rownum, route('purchases-prices-offers.edit', $model->id), route('purchases-prices-offers.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $data['type'] = $request['type'];
            $data['suppliers']  = Supplier::where('type', $request['type'])->get();
        } else {
            $data['suppliers'] = Supplier::all();
        }

        return $this->getView($this->viewPath . 'create', $this->policy . 'view', $data);
    }

    public function store(Request $request)
    {
        $data = $request->only(['supplier_id', 'date', 'time', 'offer_duration', 'notes', 'declaration']);
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $supplier = Supplier::where([['type', $request['type']], ['id', $request['supplier_id']]])->first();
            $data['type'] = $request['type'];
        } else {
            $supplier = Supplier::find($request['supplier_id']);
        }

        $data['supplier_name']  = $supplier->name;
        $data['user_id']        = auth()->id();

        if ($request['product']) {
            $elements_type  = $request['product_code_type'];
            $quantities     = [];
            $discounts      = [];
            $products       = [];
            $darebas        = [];
            $totals         = [];
            $prices         = [];
            $parts          = [];

            foreach ($request['product'] as $k => $element) {
                if ($elements_type[$k] !== 'ES' && $elements_type[$k] !== 'EA') {
                    $quantities[]       = $request['quantity'][$k];
                    $discounts[]        = $request['discount'][$k];
                    $products[]         = $element;
                    $darebas[]          = $request['dareba'][$k];
                    $prices[]           = $request['price'][$k];
                    $totals[]           = $request['totals'][$k];
                    $parts[]            = $element;
                }
            }

            $data['addon_discount']     = $request['addon_disc'];
            $data['products_ids']       = implode(',', $products);
            $data['quantities']         = implode(',', $quantities);
            $data['discounts']          = implode(',', $discounts);
            $data['parts_ids']          = implode(',', $parts);
            $data['prices']             = implode(',', $prices);
            $data['totals']             = implode(',', $totals);
            $data['dreba']              = implode(',', $darebas);
        }

        $purchasePriceOffer = PurchasePriceOffer::create($data);
        if($purchasePriceOffer->prices !== null) {
            $total_before_vat   = 0;
            $quantities         = explode(',', $purchasePriceOffer->quantities);
            $total_vat          = 0;
            $prices             = explode(',', $purchasePriceOffer->prices);
            $total              = 0;

            foreach($prices as $key => $price) {
                $subtotal           = round((float)$quantities[$key] * (float)$price, 2);
                $discounts          = $subtotal * ((float)$quantities[$key] / 100);
                $totalBeforeVat     = $subtotal - $discounts;
                $total_before_vat   += $totalBeforeVat;
                $totalVatVal        = $totalBeforeVat * (getSettings('site_vat_value') / 100);
                $total_vat          += $totalVatVal;
                $totalVat           = round((float)$totalBeforeVat + (float)$totalVatVal, 2);
                $total              += $totalVat;
            }
            if (isset($purchasePriceOffer->addon_discount) && $purchasePriceOffer->addon_discount !== "" && $purchasePriceOffer->addon_discount !== 0) {
                $total_before_vat   -= (float)$purchasePriceOffer->addon_discount;
                $total_vat          = $total_before_vat * (getSettings('site_vat_value') / 100);
                $total              = $total_before_vat + $total_vat;
            }
            $purchasePriceOffer->update(['total_money' => $total, 'total_vat' => $total_vat]);
        }

        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            return redirect(route('purchases-prices-offers.index') . '?type=' . $request['type'])->withFlashMessage(trans('admin.created', ['name' => 'عرض سعر']));
        }

        return redirect(route('purchases-prices-offers.index'))->withFlashMessage(trans('admin.created', ['name' => 'عرض سعر']));
    }

    public function show($id)
    {
        $PurchasePriceOffer = PurchasePriceOffer::findOrFail($id);
        $quantities         = explode(',', $PurchasePriceOffer->quantities);
        $discounts          = explode(',', $PurchasePriceOffer->discounts);
        $products           = explode(',', $PurchasePriceOffer->products_ids);
        $prices             = explode(',', $PurchasePriceOffer->prices);
        $parts              = explode(',', $PurchasePriceOffer->parts_ids);

        $allProducts = [];
        if (count($products) > 0 && $products[0] !== null) {
            foreach ($products as $product) {
                $allProducts[] = Products::find($product);
            }
        }

        if (count($parts) > 0 && $parts[0] !== null) {
            foreach ($parts as $part) {
                $allProducts[] = Parts::find($part);
            }
        }

        $total_quantity_price   = 0;
        $total_before_vat       = 0;
        $total_discount         = 0;
        $total_vat              = 0;
        $total                  = 0;

        foreach ($allProducts as $key => $product) {
            if (isset($product)) {
                $subtotal               = round($quantities[$key] * $prices[$key], 2);
                $total_quantity_price   += $subtotal;
                $totalSecond            = $subtotal * ($discounts[$key] / 100);
                $total_discount         += $totalSecond;
                $totalBeforeVat         = $subtotal - $totalSecond;
                $total_before_vat       += $totalBeforeVat;
                $totalVatVal            = $totalBeforeVat * (getSettings('site_vat_value') / 100);
                $total_vat              += $totalVatVal;
                $totalVat               = round($totalBeforeVat + $totalVatVal, 2);
                $total                  += $totalVat;
            }
        }
        if (isset($PurchasePriceOffer->addon_discount) && $PurchasePriceOffer->addon_discount !== "" && $PurchasePriceOffer->addon_discount !== 0) {
            $total_before_vat   = $total_before_vat - $PurchasePriceOffer->addon_discount;
            $total_vat          = $total_before_vat * (getSettings('site_vat_value') / 100);
            $total              = $total_before_vat + $total_vat;
        }

        $data['PurchasePriceOffer'] = $PurchasePriceOffer;
        $data['allProducts']        = $allProducts;
        $data['quantities']         = $quantities;
        $data['timestamp']          = gmdate("Y-m-d\TH:i:s\Z", strtotime($PurchasePriceOffer->created_at));
        $data['discounts']          = $discounts;
        $data['total_vat']          = round($total_vat,2);
        $data['supplier']           = Supplier::find($PurchasePriceOffer->supplier_id);
        $data['company']            = "شركة القائد الاول";
        $data['vat_num']            = "300235684700003";
        $data['drebas']             = explode(',', $PurchasePriceOffer->dreba);
        $data['prices']             = $prices;
        $data['total']              = number_format(round($total,2));

        return $this->getView($this->viewPath . 'show', $this->policy . 'create', $data);
    }

    public function edit(Request $request,$id)
    {
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $data['type'] = $request['type'];
            $data['suppliers']  = Supplier::where('type', $request['type'])->get();
        } else {
            $data['suppliers'] = Supplier::all();
        }
        $PurchasePriceOffer = PurchasePriceOffer::findOrFail($id);

        if ($PurchasePriceOffer->prices !== '') {
            $data['purchase_price_offer_quantities']    = explode(',', $PurchasePriceOffer->quantities);
            $data['purchase_price_offer_discounts']     = explode(',', $PurchasePriceOffer->discounts);
            $data['purchase_price_offer_totals']        = $PurchasePriceOffer->total_money;
            $data['purchase_price_offer_prices']        = explode(',', $PurchasePriceOffer->prices);
            $data['purchase_price_offer_dreba']         = explode(',', $PurchasePriceOffer->dreba);
            $purchase_price_offer_products_ids          = explode(',', $PurchasePriceOffer->products_ids);
            $purchase_price_offer_parts_ids             = explode(',', $PurchasePriceOffer->parts_ids);

            $purchase_price_offer_products = [];
            foreach ($purchase_price_offer_products_ids as $pid) {
                $purchase_price_offer_products[] = Products::find($pid);
            }
            foreach ($purchase_price_offer_parts_ids as $pid) {
                $purchase_price_offer_products[] = Parts::find($pid);
            }

            $data['purchase_price_offer_products'] = $purchase_price_offer_products;
        }

        $data['PurchasePriceOffer'] = $PurchasePriceOffer;
        $data['edit'] = true;

        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', $data, 'edit');
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(['supplier_id', 'date', 'time', 'offer_duration', 'notes', 'declaration']);
        $purchasePriceOffer = PurchasePriceOffer::find($id);
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], true)) {
            $supplier = Supplier::where([['type', $request['type']], ['id', $request['supplier_id']]])->first();
            $data['type'] = $request['type'];
        } else {
            $supplier = Supplier::find($request['supplier_id']);
        }
        $data['supplier_name'] = $supplier->name;
        $data['status']        = $request['status'] ?? 0;

        if ($request['product']) {
            $elements_type  = $request['product_code_type'];
            $quantities     = [];
            $discounts      = [];
            $products       = [];
            $darebas        = [];
            $totals         = [];
            $prices         = [];
            $parts          = [];

            foreach ($request['product'] as $k => $element) {
                if ($elements_type[$k] !== 'ES' && $elements_type[$k] !== 'EA') {
                    $quantities[]       = $request['quantity'][$k];
                    $discounts[]        = $request['discount'][$k];
                    $products[]         = $element;
                    $darebas[]          = $request['dareba'][$k];
                    $prices[]           = $request['price'][$k];
                    $totals[]           = $request['totals'][$k];
                    $parts[]            = $element;
                }
            }

            $data['addon_discount']     = $request['addon_disc'];
            $data['products_ids']       = implode(',', $products);
            $data['quantities']         = implode(',', $quantities);
            $data['discounts']          = implode(',', $discounts);
            $data['parts_ids']          = implode(',', $parts);
            $data['prices']             = implode(',', $prices);
            $data['totals']             = implode(',', $totals);
            $data['dreba']              = implode(',', $darebas);
        } else {
            $data['addon_discount'] = 0;
            $data['products_ids']   = null;
            $data['total_money']    = 0.000;
            $data['quantities']     = null;
            $data['discounts']      = null;
            $data['total_vat']      = 0.000;
            $data['parts_ids']      = null;
            $data['prices']         = null;
            $data['dreba']          = null;
        }

        $purchasePriceOffer->update($data);
        if($purchasePriceOffer->prices !== null) {
            $total_before_vat   = 0;
            $quantities         = explode(',', $purchasePriceOffer->quantities);
            $total_vat          = 0;
            $prices             = explode(',', $purchasePriceOffer->prices);
            $total              = 0;

            foreach($prices as $key => $price) {
                $subtotal           = round((float)$quantities[$key] * (float)$price, 2);
                $discounts          = $subtotal * ((float)$quantities[$key] / 100);
                $totalBeforeVat     = $subtotal - $discounts;
                $total_before_vat   += $totalBeforeVat;
                $totalVatVal        = $totalBeforeVat * (getSettings('site_vat_value') / 100);
                $total_vat          += $totalVatVal;
                $totalVat           = round((float)$totalBeforeVat + (float)$totalVatVal, 2);
                $total              += $totalVat;
            }
            if (isset($purchasePriceOffer->addon_discount) && $purchasePriceOffer->addon_discount !== "" && $purchasePriceOffer->addon_discount !== 0) {
                $total_before_vat   -= (float)$purchasePriceOffer->addon_discount;
                $total_vat          = $total_before_vat * (getSettings('site_vat_value') / 100);
                $total              = $total_before_vat + $total_vat;
            }
            $purchasePriceOffer->update(['total_money' => $total, 'total_vat' => $total_vat]);
        }

        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            return redirect(route('purchases-prices-offers.index') . '?type=' . $request['type'])->withFlashMessage(trans('admin.updated', ['name' => 'عرض سعر']));
        }

        return redirect(route('purchases-prices-offers.index'))->withFlashMessage(trans('admin.updated', ['name' => 'عرض سعر']));
    }

    public function destroy($id)
    {
        PurchasePriceOffer::findOrFail($id)->delete();
        return redirect(route('purchases-prices-offers.index'))->withFlashMessage(trans('admin.deleted', ['name' => 'عرض سعر']));
    }
}
