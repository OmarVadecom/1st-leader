<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\AttachmentCat;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Response;

class AttachmentCatController extends MainController
{
    private $viewPath = 'admin.attachments.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.attachments'));

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
        $attachcat = AttachmentCat::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['attachcat' => $attachcat], 'edit');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imagefile = 'attachcat-' . time() . '.' . $extension;
            $image->move('public/uploads/attachcat', $imagefile);
        }
        AttachmentCat::create([
            'name' => $request->name,
            'image' => $imagefile,
        ]);
        return redirect(route('attachmentcat.index'))->withFlashMessage(trans('admin.created', ['name' => trans('تصنيف مرفقات')]));
    }

    public function update(Request $request, $id)
    {
        $image = $request->file('image');
        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imagefile = 'attachcat-' . time() . '.' . $extension;
            $image->move('public/uploads/attachcat', $imagefile);
        } else {
            $imagefile = $request->oldimage;

        }
        $attachcat = AttachmentCat::find($id);
        $attachcat->update([
            'name' => $request->name,
            'image' => $imagefile,
        ]);
        return redirect(route('attachmentcat.index'))->withFlashMessage(trans('admin.updated', ['name' => trans('تصنيف مرفقات')]));
    }

    public function AjaxLoad(AttachmentCat $data)
    {
        $attachcats = $data->currentYear()->get();
        return Datatables::of($attachcats)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('name', function ($model) {

                return $model->name;
            })
            ->editColumn('image', function ($model) {

                return "<img src=" . url('/') . "/uploads/attachcat/" . $model->image . " style='width:50px'>";
            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, null, route('attachmentcat.edit', $model->id), route('attachmentcat.destroy', $model->id));
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

        AttachmentCat::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'تصنيف مرفقات']);
        if ($request->ajax()) {
            return Response::json($delMessage);

            return redirect(route('country.index'))->withFlashMessage($delMessage);
        }
        return false;
    }

}
