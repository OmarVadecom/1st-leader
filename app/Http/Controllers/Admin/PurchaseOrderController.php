<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\PurchasePriceOffer;
use App\Models\Purchase;
use DataTables;

class PurchaseOrderController extends MainController
{
    private $viewPath = 'admin.purchases_orders.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.purchasesOrders'));
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
            $initPurchasesPricesOffers = PurchasePriceOffer::where([['status', 1], ['type', $request['type']]])->orderBy('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initPurchasesPricesOffers->count() + 1)));
            $purchasesPricesOffers = $initPurchasesPricesOffers->select(['purchases_prices_offers.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        } else {
            $initPurchasesPricesOffers = PurchasePriceOffer::where('status', 1)->orderBy('created_at', 'desc')->currentYear();
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

            ->editColumn('purchase', function ($model) {
                $purchase = Purchase::whereNotNull('price_offer_id')->where('price_offer_id', $model->id)->first();
                if($purchase) {
                    return "<a href='" . route('purchases.show', $purchase->id) . "' target='_blank'> فاتورة الشراء </a>";
                } else {
                    return "<a href='" . route('purchases.create') . "?offer_id=" . $model->id . "' target='_blank'> انشاء فاتورة الشراء </a>";
                }
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
}
