<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Brands;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use View;

class ExpenseController extends MainController
{
    private $viewPath = 'admin.expense.';
    private $policy = 'page-categories.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.expense'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $categories = ExpenseCategory::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['expense' => null, 'categories' => $categories], 'create');
    }

    public function edit($id)
    {
        $categories = ExpenseCategory::all();
        $expense = Expense::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['expense' => $expense, 'categories' => $categories], 'edit');
    }

    public function store(Request $request)
    {

        $expense = Expense::create([
            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id,
        ]);

        return redirect(route('expense.index'))->withFlashMessage(trans('admin.created', ['name' => 'بند للمصاريف']));
    }

    public function update($id, Request $request)
    {
        $expense = Expense::findOrFail($id);
        $expense->update([
            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id,
        ]);
        return redirect(route('expense.index'))->withFlashMessage(trans('admin.updated', ['name' => 'بند للمصاريف']));
    }

    public function destroy($id, Request $request)
    {
        Expense::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'بند']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('expense.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(Brands $data)
    {
        $initParts = Expense::orderBy('created_at', 'desc')->currentYear();
        DB::statement(DB::raw('set @rownum=' . ($initParts->count() + 1)));
        $parts = $initParts->select(['expense.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();

        return Datatables::of($parts)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('code', function ($model) {
                return $model->code . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })
            ->editColumn('category', function ($model) {
                if ($model->category) {
                    return $model->category->name;
                } else {
                    return '-';
                }
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('expense.edit', $model->id), route('expense.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
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
}
