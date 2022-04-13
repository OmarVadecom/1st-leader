<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Brands;
use App\Models\MoneyBox;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Response;
use View;

class MoneyBoxController extends MainController
{
    private $viewPath = 'admin.moneybox.';
    private $policy = 'page-categories.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.moneybox'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', [], 'create');
    }

    public function edit($id)
    {
        $box = MoneyBox::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['box' => $box], 'edit');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            return view(important_pages('403'));
        }
        $box = MoneyBox::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect(route('moneybox.index'))->withFlashMessage(trans('admin.created', ['name' => 'حساب تفصيلي']));
    }

    public function update($id, Request $request)
    {
        $box = MoneyBox::findOrFail($id);
        $box->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        return redirect(route('moneybox.index'))->withFlashMessage(trans('admin.updated', ['name' => 'حساب تفصيلي']));
    }

    public function destroy($id, Request $request)
    {
        MoneyBox::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'حساب تفصيلي']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('moneybox.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(Brands $data)
    {
        $sanadat = MoneyBox::orderBy('created_at', 'desc')->currentYear()->get();
        return Datatables::of($sanadat)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('code', function ($model) {
                return $model->code;
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('moneybox.edit', $model->id), route('moneybox.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }
}
