<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\ProductSection;
use App\Models\Section;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class SectionController extends MainController
{
    private $viewPath = 'admin.sections.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.sections'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['section' => null], 'create');
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['section' => $section], 'edit');
    }

    public function store(Request $request)
    {
        Section::create([
            'name' => $request->name,
        ]);
        return redirect(route('sections.index'))->withFlashMessage(trans('admin.created', ['name' => trans('قسم مواصفات فنيه')]));
    }

    public function update(Request $request, $id)
    {

        $section = Section::find($id);
        $section->update([
            'name' => $request->name,
        ]);
        return redirect(route('sections.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('قسم مواصفات فنيه')]));
    }

    public function AjaxLoad(Section $data)
    {
        $sections = $data->currentYear()->get();
        return Datatables::of($sections)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('sections.edit', $model->id), route('sections.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function destroy($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.404'));
            }
            return view(important_pages('404'));
        }

        Section::findOrFail($id)->delete();
        ProductSection::where('section_id', $id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'قسم مواصفات فنيه']);
        if ($request->ajax()) {
            return Response::json($delMessage);

            return redirect(route('sections.index'))->withFlashMessage($delMessage);
        }
        return false;
    }
}
