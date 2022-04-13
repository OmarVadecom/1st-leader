<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Country;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class CountryController extends MainController
{
    private $viewPath = 'admin.country.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.country'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['country' => null], 'create');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['country' => $country], 'edit');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imagefile = 'country-' . time() . '.' . $extension;
            $image->move('public/uploads/countries', $imagefile);
        }
        Country::create([
            'name' => $request->name,
            'image' => $imagefile,
        ]);
        return redirect(route('country.index'))->withFlashMessage(trans('admin.created', ['name' => trans('دوله')]));
    }

    public function update(Request $request, $id)
    {

        $image = $request->file('image');
        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imagefile = 'country-' . time() . '.' . $extension;
            $image->move('public/uploads/countries', $imagefile);
        } else {
            $imagefile = $request->oldimage;
        }
        $country = Country::find($id);
        $country->update([
            'name' => $request->name,
            'image' => $imagefile,
        ]);
        return redirect(route('country.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('دوله')]));
    }

    public function AjaxLoad(Country $data)
    {
        $countries = $data->currentYear()->get();
        return Datatables::of($countries)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })
            ->editColumn('image', function ($model) {

                return "<img src='".url('/')."/uploads/countries/" . $model->image . "' style='width:50px'>";
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('country.edit', $model->id), route('country.destroy', $model->id));
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

        Country::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'دوله']);
        if ($request->ajax()) {
            return Response::json($delMessage);

            return redirect(route('country.index'))->withFlashMessage($delMessage);
        }
        return false;
    }
}
