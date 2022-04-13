<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\DailyTransaction;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\MoneyBox;
use App\Models\Sanadat;
use App\Models\Customers;
use App\Models\Supplier;
use DataTables;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;
use Response;
use View;

class SanadatController extends MainController
{
    private $viewPath = 'admin.sanadat.';
    private $policy = 'page-categories.';

    public function __construct()
    {
        View::share('pageTitle', trans('admin.sanadat'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $categories = ExpenseCategory::all();
        $expenses = Expense::all();
        $boxs = MoneyBox::all();
        $local_suppliers = Supplier::where('type', 0)->get();
        $int_suppliers = Supplier::where('type', 1)->get();
        $clients = Customers::whereNull('parent_id')->get();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['sanad' => null, 'categories' => $categories, 'expenses' => $expenses, 'boxs' => $boxs, 'local_suppliers' => $local_suppliers, 'int_suppliers' => $int_suppliers, 'clients' => $clients], 'create');
    }

    public function edit($id)
    {
        $categories = ExpenseCategory::all();
        $expenses = Expense::all();
        $boxs = MoneyBox::all();
        $sanad = Sanadat::findOrFail($id);
        $local_suppliers = Supplier::where('type', 0)->get();
        $int_suppliers = Supplier::where('type', 1)->get();
        $clients = Customers::whereNull('parent_id')->get();
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['sanad' => $sanad, 'categories' => $categories, 'expenses' => $expenses, 'boxs' => $boxs, 'local_suppliers' => $local_suppliers, 'int_suppliers' => $int_suppliers, 'clients' => $clients], 'edit');
    }

    public function store(Request $request)
    {
        $sanad = Sanadat::create([
            'type' => $request->type,
            'ex_type' => $request->ex_type,
            'p_type' => $request->p_type,
            'box_id' => $request->box_id,
            'sell_id' => $request['sell_id'],
            'expense_id' => $request->expense_id,
            'acc_type' => $request->acc_type,
            'cl_sup_id' => $request->cl_sup_id,
            'cost' => $request->cost,
            'date' => $request->date,
            'notes' => $request->notes,
            'time' => $request->time,
        ]);

        if(isset($sanad->cost)) {
            $data = [
                'total_money'   => $sanad->cost,
                'total_vat'     => $sanad->cost * 0.15,
                'user_id'       => auth()->id(),
                'box_id'        => $sanad->box_id
            ];

            if($sanad->acc_type === 'supplier' && $sanad->cl_sup_id !== null) {
                $data['supplier_id'] = $sanad->cl_sup_id;
            }

            if($sanad->acc_type === 'client' && $sanad->cl_sup_id !== null) {
                $data['customer_id'] = $sanad->cl_sup_id;
            }

            $sanad->dailyTransaction()->create($data);
        }


        return redirect(route('sanadat.index') . '?type=' . $request->type)->withFlashMessage(trans('admin.created', ['name' => 'سند']));
    }

    public function update($id, Request $request)
    {
        $sanad = Sanadat::findOrFail($id);
        $sanad->update([
            'ex_type' => $request->ex_type,
            'p_type' => $request->p_type,
            'box_id' => $request->box_id,
            'expense_id' => $request->expense_id,
            'acc_type' => $request->acc_type,
            'cl_sup_id' => $request->cl_sup_id,
            'cost' => $request->cost,
            'date' => $request->date,
            'notes' => $request->notes,
            'time' => $request->time,
        ]);

        if(isset($sanad->cost)) {
            $data = [
                'total_money'   => $sanad->cost,
                'total_vat'     => $sanad->cost * 0.15,
                'user_id'       => auth()->id(),
                'box_id'        => $sanad->box_id
            ];

            if($sanad->acc_type === 'supplier' && $sanad->cl_sup_id !== null) {
                $data['supplier_id'] = $sanad->cl_sup_id;
            }

            if($sanad->acc_type === 'client' && $sanad->cl_sup_id !== null) {
                $data['customer_id'] = $sanad->cl_sup_id;
            }

            $sanad->dailyTransaction()->update($data);
        }

        return redirect(route('sanadat.index') . '?type=' . $request->type)->withFlashMessage(trans('admin.updated', ['name' => 'سند']));
    }

    public function destroy($id, Request $request)
    {
        $sand = Sanadat::findOrFail($id);
        $sand->dailyTransaction()->delete();
        $sand->delete();
        $delMessage = trans('admin.deleted', ['name' => 'سند']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('sanadat.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(Sanadat $data)
    {
        $sanadat = Sanadat::where('type', \Request::get('type'))->orderBy('created_at', 'desc')->currentYear()->get();
        return Datatables::of($sanadat)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('type', function ($model) {
                return $model->gettype();
            })
            ->editColumn('sanad', function ($model) {
                return $model->get_sanad_name();
            })
            ->editColumn('cost', function ($model) {
                return $model->cost;
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('sanadat.show', $model->id) . '?type=' . $model->type, route('sanadat.edit', $model->id) . '?type=' . $model->type, route('sanadat.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function show($id)
    {
        $sanad = Sanadat::find($id);
        return $this->getView($this->viewPath . 'show', $this->policy . 'create', ['sanad' => $sanad], 'create');
    }
}
