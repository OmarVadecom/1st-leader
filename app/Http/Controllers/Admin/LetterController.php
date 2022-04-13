<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Letter;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use MPDF as PDF;
use Response;

class LetterController extends MainController
{
    private $viewPath = 'admin.letter.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.letter'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['letter' => null], 'create');
    }

    public function edit($id)
    {
        $letter = Letter::findOrFail($id);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['letter' => $letter], 'edit');
    }

    public function show($id)
    {
        $letter = Letter::findOrFail($id);
        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHTML(file_get_contents(route('letter.show', $letter->id)));
        $pdf = PDF::loadView($this->viewPath . 'show', [
            'letter' => $letter,
        ]);

        return $pdf->stream($letter->center_name . '.pdf');
        // return $this->getView($this->viewPath . 'show', $this->policy . 'update', ['letter' => $letter], 'edit');
    }
    public function AjaxLoad(Letter $data)
    {
        $letters = $data->all();
        return Datatables::of($letters)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('id', function ($model) {

                return $model->id;
            })
            ->editColumn('name', function ($model) {

                return $model->center_name;
            })
            ->editColumn('code', function ($model) {

                return $model->code;
            })
            ->editColumn('segl_num', function ($model) {

                return $model->segl_num;
            })
            ->editColumn('letter', function ($model) {

                return "<a target='_blank' href='" . url('/') . "/uploads/letters/" . $model->filename . "'>عرض الملف</a>";

            })

            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('letter.show', $model->id), route('letter.edit', $model->id), route('letter.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function store(Request $request)
    {
        $letter = Letter::create([
            'center_name' => $request->center_name,
            'code' => $request->code,
            'segl_num' => $request->segl_num,
        ]);

        return redirect(route('letter.show', $letter->id))->withFlashMessage(trans('admin.created', ['name' => 'خطاب']));
    }

    public function update($id, Request $request)
    {
        $file = '';
        $image = $request->file('file');
        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $file = 'file' . time() . '.' . $extension;
            $image->move('public/uploads/letters', $file);
        }
        Letter::where('id', $id)->update([
            'center_name' => $request->center_name,
            'code' => $request->code,
            'segl_num' => $request->segl_num,
            'filename' => $file,
        ]);
        return redirect()->back()->withFlashMessage(trans('admin.updated', ['name' => 'خطاب']));
    }

    public function destroy($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.404'));
            }
            return view(important_pages('404'));
        }

        Letter::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'خطاب']);
        if ($request->ajax()) {
            return Response::json($delMessage);

            return redirect(route('letter.index'))->withFlashMessage($delMessage);
        }
        return false;
    }

}
