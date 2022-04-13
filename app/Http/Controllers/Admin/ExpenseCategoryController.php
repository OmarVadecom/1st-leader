<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Brands;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Response;
use View;

class ExpenseCategoryController extends MainController
{
    private $viewPath = 'admin.expensecategory.';
    private $policy = 'page-categories.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.expensecategory'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['category' => null], 'create');
    }

    public function edit($id)
    {
        $category = ExpenseCategory::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['category' => $category], 'edit');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            return view(important_pages('403'));
        }
        $category = ExpenseCategory::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect(route('expensecategory.index'))->withFlashMessage(trans('admin.created', ['name' => 'قسم مصروفات']));
    }

    public function update($id, Request $request)
    {

        $category = ExpenseCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        return redirect(route('expensecategory.index'))->withFlashMessage(trans('admin.updated', ['name' => 'قسم مصروفات']));
    }

    public function destroy($id, Request $request)
    {
        ExpenseCategory::findOrFail($id)->delete();
        Expense::where('category_id', $id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'قسم للمصروفات']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('expensecategory.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(Brands $data)
    {
        $parts = ExpenseCategory::orderBy('created_at', 'desc')->currentYear()->get();
        return Datatables::of($parts)
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
                return getAjaxAction($this->policy, $model, null, route('expensecategory.edit', $model->id), route('expensecategory.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }
}
