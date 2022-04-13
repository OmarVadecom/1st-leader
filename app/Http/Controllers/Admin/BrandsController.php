<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Brands;
use App\Models\Country;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Response;
use View;

class BrandsController extends MainController
{
    private $viewPath = 'admin.brands.';
    private $policy = 'page-categories.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.brands'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $countries = Country::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['brand' => null, 'countries' => $countries], 'create');
    }

    public function edit($id)
    {
        $countries = Country::all();
        $brand = Brands::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['brand' => $brand, 'countries' => $countries], 'edit');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            return view(important_pages('403'));
        }
        $brandimage = $request->file('image');
        if ($brandimage && $brandimage->isValid()) {
            $extension = $brandimage->getClientOriginalExtension();
            $imagefile = 'product-' . time() . '.' . $extension;
            $brandimage->move('public/uploads/brands_images', $imagefile);
        }
        $brand = Brands::create([
            'name' => $request->name,
            'brandcode' => $request->brandcode,
            'image' => $imagefile,
            'sort' => $request->sort,
            'country_id' => $request->country_id,
        ]);

        return redirect(route('brands.index'))->withFlashMessage(trans('admin.created', ['name' => 'براند']));
    }

    public function update($id, Request $request)
    {

        $image = $request->file('image');
        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imagefile = 'brand-' . time() . '.' . $extension;
            $image->move('public/uploads/brands_images', $imagefile);
        } else {
            $imagefile = $request->oldimage;

        }

        $brand = Brands::findOrFail($id);
        $brand->update([
            'name' => $request->name,
            'brandcode' => $request->brandcode,
            'image' => $imagefile,
            'sort' => $request->sort,
            'country_id' => $request->country_id,
        ]);
        return redirect(route('brands.index'))->withFlashMessage(trans('admin.updated', ['name' => 'براند']));
    }

    public function destroy($id, Request $request)
    {
        Brands::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'براند']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('brands.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(Brands $data)
    {
        $parts = Brands::orderBy('sort', 'asc')->currentYear()->get();
        return Datatables::of($parts)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('image', function ($model) {
                return '<img src="' . url('/') . '/uploads/brands_images/' . $model->image . '" style="width:100px"> ';
            })
            ->editColumn('country', function ($model) {
                if ($model->country) {
                    return $model->country->name;
                } else {
                    return '-';
                }
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('brands.edit', $model->id), route('brands.destroy', $model->id));
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
