<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchasePriceOffer;
use App\Models\PurchaseInvoice;
use Illuminate\Http\Request;
use App\Models\PriceOffer;
use App\Models\Products;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\MoneyBox;
use App\Models\Product;
use App\Models\Parts;
use Exception;

class PurchaseController extends MainController
{
    private $viewPath = 'admin.purchases.';
    private $policy = 'page-categories.';

    public function __construct()
    {
        View::share('pageTitle', trans('admin.purchaseinvoice'));
    }

    public function index(Request $request)
    {
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $type = $request['type'];
        } else {
            $type = 0;
        }
        return $this->getView($this->viewPath . 'index', $this->policy . 'view', ['type' => $type]);
    }

    /**
     * @throws Exception
     */
    public function AjaxLoad(Request $request)
    {
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $initPurchases = Purchase::where('type', $request['type'])->orderBy('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initPurchases->count() + 1)));
            $purchases = $initPurchases->select(['purchases.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        } else {
            $initPurchases = Purchase::orderBy('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initPurchases->count() + 1)));
            $purchases = $initPurchases->select(['purchases.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        }

        return Datatables::of($purchases)
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

            ->editColumn('date', function ($model) {
                return $model->date;
            })

            ->editColumn('total', function ($model) {
                return (float)$model->total_money + (float)$model->total_vat;
            })

            ->editColumn('action', function ($model) use ($request) {
                if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
                    return getAjaxAction($this->policy, $model, route('purchases.show', $model->id) . '?type=' . $request['type'] . '&invoice_num=' . $model->rownum, route('purchases.edit', $model->id) . '?type=' . $request['type'], route('purchases.destroy', $model->id) . '?type=' . $request['type']);
                }
                return getAjaxAction($this->policy, $model, route('purchases.show', $model->id) . '?invoice_num=' . $model->rownum, route('purchases.edit', $model->id), route('purchases.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function create(Request $request)
    {
        if($request->has('offer_id')) {
            $PurchasePriceOffer = PurchasePriceOffer::find($request['offer_id']);

            if ($PurchasePriceOffer->prices !== '') {
                $data['purchase_price_offer_totals']    = $PurchasePriceOffer->total_money;
                $purchase_price_offer_products_ids      = explode(',', $PurchasePriceOffer->products_ids);
                $purchase_price_offer_parts_ids         = explode(',', $PurchasePriceOffer->parts_ids);
                $data['purchase_quantities']            = explode(',', $PurchasePriceOffer->quantities);
                $data['purchase_discounts']             = explode(',', $PurchasePriceOffer->discounts);
                $data['purchase_prices']                = explode(',', $PurchasePriceOffer->prices);
                $data['purchase_dreba']                 = explode(',', $PurchasePriceOffer->dreba);

                $purchase_price_offer_products = [];
                foreach ($purchase_price_offer_products_ids as $pid) {
                    $purchase_price_offer_products[] = Products::find($pid);
                }
                foreach ($purchase_price_offer_parts_ids as $pid) {
                    $purchase_price_offer_products[] = Parts::find($pid);
                }

                $data['purchase_products'] = $purchase_price_offer_products;
            }

            $data['offer_id']   = $request['offer_id'];
            $data['purchase']   = $PurchasePriceOffer;
            $data['edit']       = true;
        }
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $data['type'] = $request['type'];
            $data['suppliers']  = Supplier::where('type', $request['type'])->get();
        } else {
            $data['type'] = 0;
            $data['suppliers']  = Supplier::where('type', 0)->get();
        }
        $data['boxes'] = MoneyBox::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'view', $data);
    }

    public function store(Request $request)
    {
        $data = $request->only(['box_id', 'supplier_id', 'date', 'time', 'notes', 'declaration']);
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $supplier = Supplier::where([['type', $request['type']], ['id', $request['supplier_id']]])->first();
            $lastRecord = Purchase::where('type', $request['type'])->latest()->first();
            if($lastRecord) {
                $val = substr($lastRecord->code, '7') + 1;
            } else {
                $val = 1;
            }
            $data['type'] = $request['type'];
        } else {
            $supplier = Supplier::find($request['supplier_id']);
        }

        $data['supplier_name']  = $supplier->name;
        $data['user_id']        = auth()->id();

        if ($request['product']) {
            $quantities     = [];
            $discounts      = [];
            $products       = [];
            $darebas        = [];
            $totals         = [];
            $prices         = [];
            $parts          = [];

            foreach ($request['product'] as $k => $element) {
                $quantities[]       = $request['quantity'][$k];
                $discounts[]        = $request['discount'][$k];
                $products[]         = $element;
                $darebas[]          = $request['dareba'][$k];
                $prices[]           = $request['price'][$k];
                $totals[]           = $request['totals'][$k];
                $parts[]            = $element;
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


        if($request->has('offer_id')) {
            $data['price_offer_id'] = $request['offer_id'];
        }

        $purchase = Purchase::create($data);

        if ($request['product']) {
            $products = [];
            foreach ($request['product'] as $element) {
                $products[] = $element;
            }
            $purchase->products()->attach($products);
        }

        if($purchase->prices !== null) {
            $total_before_vat   = 0;
            $quantities         = explode(',', $purchase->quantities);
            $total_vat          = 0;
            $prices             = explode(',', $purchase->prices);
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
            if (isset($purchase->addon_discount) && $purchase->addon_discount !== "" && $purchase->addon_discount !== 0) {
                $total_before_vat   -= (float)$purchase->addon_discount;
                $total_vat          = $total_before_vat * (getSettings('site_vat_value') / 100);
                $total              = $total_before_vat + $total_vat;
            }
            $purchase->update(['total_money' => $total, 'total_vat' => $total_vat]);

            $purchase->dailyTransaction()->create([
                'supplier_id'   => $request['supplier_id'],
                'total_money'   => $total,
                'total_vat'     => $total_vat,
                'user_id'       => auth()->id(),
                'box_id'        => $request['box_id']
            ]);
        }
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            return redirect(route('purchases.index') . '?type=' . $request['type'])->withFlashMessage(trans('admin.created', ['name' => 'فاتوره شراء ']));
        }
        return redirect(route('purchases.index') . '?type=0')->withFlashMessage(trans('admin.created', ['name' => 'فاتوره شراء ']));
    }

    public function show($id)
    {
        $purchase       = Purchase::find($id);
        $quantities     = explode(',', $purchase->quantities);
        $discounts      = explode(',', $purchase->discounts);
        $products       = explode(',', $purchase->products_ids);
        $prices         = explode(',', $purchase->prices);
        $total          = $purchase->total_money;

        $allProducts = array();
        foreach ($products as $product) {
            $allProducts[] = Products::find($product);
        }

        $data['allProducts']    = $allProducts;
        $data['quantities']     = $quantities;
        $data['discounts']       = $discounts;
        $data['purchase']       = $purchase;
        $data['supplier']       = $purchase->supplier;
        $data['prices']         = $prices;
        $data['total']          = $total;

        return $this->getView($this->viewPath . 'show', $this->policy . 'update', $data, 'show');
    }

    public function edit(Request $request, $id)
    {
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            $data['type'] = $request['type'];
            $data['suppliers']  = Supplier::where('type', $request['type'])->get();
        } else {
            $data['type'] = 0;
            $data['suppliers']  = Supplier::where('type', 0)->get();
        }
        $purchase           = Purchase::findOrFail($id);
        $data['boxes']      = MoneyBox::all();

        if ($purchase->prices !== '') {
            $data['purchase_quantities']    = explode(',', $purchase->quantities);
            $data['purchase_discounts']     = explode(',', $purchase->discounts);
            $data['purchase_totals']        = $purchase->total_money;
            $data['purchase_prices']        = explode(',', $purchase->prices);
            $data['purchase_dreba']         = explode(',', $purchase->dreba);
            $purchase_products_ids          = explode(',', $purchase->products_ids);
            $purchase_parts_ids             = explode(',', $purchase->parts_ids);

            $purchase_products = [];
            foreach ($purchase_products_ids as $pid) {
                $product = Products::find($pid);
                if($product) {
                    $purchase_products[] = $product;
                }
            }
            foreach ($purchase_parts_ids as $pid) {
                $part = Parts::find($pid);
                if($part) {
                    $purchase_products[] = $part;
                }
            }

            $data['purchase_products'] = $purchase_products;
        }

        $data['purchase'] = $purchase;
        $data['edit'] = true;

        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', $data, 'edit');
    }

    public function update($id, Request $request)
    {
        $purchase = Purchase::find($id);
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], true)) {
            $supplier = Supplier::where([['type', $request['type']], ['id', $request['supplier_id']]])->first();
        } else {
            $supplier = Supplier::where([['type', 0], ['id', $request['supplier_id']]])->first();
        }
        $data                   = $request->only(['box_id', 'supplier_id', 'date', 'time', 'notes', 'declaration']);
        $data['supplier_name']  = $supplier->name;

        if ($request['product']) {
            $quantities     = [];
            $discounts      = [];
            $products       = [];
            $darebas        = [];
            $totals         = [];
            $prices         = [];
            $parts          = [];

            foreach ($request['product'] as $k => $element) {
                $quantities[]       = $request['quantity'][$k];
                $discounts[]        = $request['discount'][$k];
                $products[]         = $element;
                $darebas[]          = $request['dareba'][$k];
                $prices[]           = $request['price'][$k];
                $totals[]           = $request['totals'][$k];
                $parts[]            = $element;
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

        $purchase->update($data);
        if($purchase->prices !== null) {
            $total_before_vat   = 0;
            $quantities         = explode(',', $purchase->quantities);
            $total_vat          = 0;
            $prices             = explode(',', $purchase->prices);
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
            if (isset($purchase->addon_discount) && $purchase->addon_discount !== "" && $purchase->addon_discount !== 0) {
                $total_before_vat   -= (float)$purchase->addon_discount;
                $total_vat          = $total_before_vat * (getSettings('site_vat_value') / 100);
                $total              = $total_before_vat + $total_vat;
            }
            $purchase->update(['total_money' => $total, 'total_vat' => $total_vat]);

            $purchase->dailyTransaction()->update([
                'supplier_id'   => $request['supplier_id'],
                'total_money'   => $total,
                'total_vat'     => $total_vat,
                'user_id'       => auth()->id(),
                'box_id'        => $request['box_id']
            ]);
        }
        if($request->has('type') && $request['type'] !== null && in_array($request['type'], [0, 1], false)) {
            return redirect(route('purchases.index') . '?type=' . $request['type'])->withFlashMessage(trans('admin.updated', ['name' => 'فاتوره شراء ']));
        }
        return redirect(route('purchases.index') . '?type=0')->withFlashMessage(trans('admin.updated', ['name' => 'فاتوره شراء ']));
    }

    public function destroy($id, Request $request)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->dailyTransaction()->delete();
        $purchase->delete();
        return redirect(route('purchases.index'))->withFlashMessage(trans('admin.deleted', ['name' => 'فاتوره شراء ']));
    }
}
