<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Funds;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class FundsController extends MainController
{
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.priceoffer'));
    }
    public function index()
    {
        return view('admin.funds.index');
    }
    public function AjaxLoad(Funds $data, Request $request)
    {
        if ($request->get('po') != "") {
            $initFunds = Funds::where('price_id', $request->get('po'))->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initFunds->count() + 1)));
            $funds = $initFunds->select(['funds.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        } elseif ($request->get('client') != "") {
            $initFunds = Funds::where('customer_id', $request->get('client'))->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initFunds->count() + 1)));
            $funds = $initFunds->select(['funds.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        } else {
            $initFunds = Funds::currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initFunds->count() + 1)));
            $funds = $initFunds->select(['funds.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        }
        return Datatables::of($funds)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('num', function ($model) {
                return $model->code . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })
            ->editColumn('customer', function ($model) {
                return $model->customer->name;
            })
            ->editColumn('priceoffer', function ($model) {
                return '<a target="_blank" href="' . url('/') . '/offer/' . $model->price_id . '">' . $model->price->code . '</a>';
            })
            ->editColumn('money', function ($model) {
                return $model->money;
            })
            ->editColumn('date_from', function ($model) {
                return $model->date_from;
            })
            ->editColumn('date_to', function ($model) {
                return $model->date_to;
            })
            ->editColumn('status', function ($model) {
                if ($model->status == 1) {
                    return '<p class="verified">مدفوعه</p>';
                } else {
                    return '<p class="unverified">غير مدفوعه</p>';
                }
                return $model->customer->name;
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('funds.edit', $model->id), null);
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function edit(Request $request,$id)
    {
        $fund = Funds::find($id);

        if($request['notify']) {
            $fund->update(['reading_status' => 1]);
        }

        return view('admin.funds.edit', compact('fund'));
    }

    public function store(Request $request)
    {
        Funds::find($request->fund_id)->update([
            'status' => (bool) $request->status,
        ]);

        return redirect()->back();
    }
}
