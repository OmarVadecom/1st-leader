<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Gifts;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class GiftsController extends MainController
{
    private $viewPath = 'admin.gifts.';
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
        $gift = Gifts::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['gift' => $gift], 'edit');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imagefile = 'gift-' . time() . '.' . $extension;
            $image->move('public/uploads/gifts_images', $imagefile);
        }
        Gifts::create([
            'name' => $request->name,
            'image' => $imagefile,
        ]);
        return redirect(route('gifts.index'))->withFlashMessage(trans('admin.created', ['name' => trans('هديه')]));
    }

    public function update(Request $request, $id)
    {

        $image = $request->file('image');
        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imagefile = 'gift-' . time() . '.' . $extension;
            $image->move('public/uploads/gifts_images', $imagefile);
        } else {
            $imagefile = $request->oldimage;

        }
        $gift = Gifts::find($id);
        $gift->update([
            'name' => $request->name,
            'image' => $imagefile,
        ]);
        return redirect(route('gifts.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('هديه')]));
    }

    public function AjaxLoad(Gifts $data)
    {
        $gifts = $data->currentYear()->get();
        return Datatables::of($gifts)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('gifts.edit', $model->id), route('gifts.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function destroy($id, Request $request)
    {
        Gifts::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'هديه']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('gifts.index'))->withFlashMessage($delMessage);
    }

}
