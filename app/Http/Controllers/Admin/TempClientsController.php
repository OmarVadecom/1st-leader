<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Imports\ClientsImport;
use App\Models\City;
use App\Models\Products;
use App\Models\Region;
use App\Models\TempClients;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class TempClientsController extends MainController
{
    private $viewPath = 'admin.temp_clients.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.stock'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $products = Products::where('code', 'like', 'EE/%')->get()->pluck('full_name', 'id');
        $cities = City::all();
        $regions = Region::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['client' => null, 'products' => $products, 'cities' => $cities, 'regions' => $regions], 'create');
    }

    public function edit($id)
    {
        $products = Products::where('code', 'like', 'EE/%')->get()->pluck('full_name', 'id');
        $client = TempClients::find($id);
        $cities = City::all();
        $regions = Region::all();
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['client' => $client, 'products' => $products, 'cities' => $cities, 'regions' => $regions], 'edit');
    }

    public function show($id)
    {
        $client = TempClients::find($id);
        return $this->getView($this->viewPath . 'show', $this->policy . 'update', ['client' => $client], 'edit');
    }

    public function store(Request $request)
    {
        $status = (bool) $request->status;
        if ($status) {
            $status = 1;
        } else {
            $status = 0;
        }
        $image = $request->file('image');

        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imgfile = 'image' . time() . '.' . $extension;
            $image->move('public/uploads/tmp_clients_images', $imgfile);
        } else {
            $imgfile = '';
        }

        if ($request->file('excel')) {
            $file = $request->file('excel');
            $request->validate([
                'excel' => 'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp',
            ]);
            Excel::import(new ClientsImport, $file);
            return redirect(route('tmpclients.index') . '?status=0')->withFlashMessage(trans('admin.created', ['name' => 'عميل']));
        }

        $client = TempClients::create([
            'product_id' => $request->product_id,
            'code' => $request->code,
            'type' => $request->type,
            'year' => $request->year,
            'image' => $imgfile,
            'bui_name' => $request->bui_name,

            'segl_name' => $request->segl_name,
            'old_segl_num' => $request->segl_name,

            'center_name' => $request->center_name,
            'old_center' => $request->center_name,

            'postal_code' => $request->postal_code,

            'region' => $request->region,
            'old_region' => $request->region,

            'city' => $request->city,
            'old_city' => $request->city,

            'maintainace_cat' => $request->maintainace_cat,
            'worker_num' => $request->worker_num,

            'phone' => $request->phone,
            'old_phone' => $request->phone,

            'fax' => $request->fax,
            'supervisor' => $request->supervisor,

            'email' => $request->email,
            'old_email' => $request->email,

            'website' => $request->website,
            // 'old_bui' => $request->old_bui,

            'responsable' => $request->responsable,
            'old_responsable' => $request->responsable,
            'mobile' => $request->mobile,
            'old_mobile' => $request->mobile,

            'greeting' => $request->greeting,
            'title' => $request->title,

            'address' => $request->address,
            'old_address' => $request->address,

            'password' => $request->password,
            'truecaller_id' => $request->truecaller_id,
            'truecaller_pass' => $request->truecaller_pass,
            'anydesk_id' => $request->anydesk_id,

            'technical' => $request->technical,
            'technical_num' => $request->technical_num,
            'old_technical' => $request->technical,
            'old_technical_num' => $request->technical_num,
            'lat' => $request->lat,
            'lng' => $request->lng,

            'status' => (bool) $request->status,
        ]);

        return redirect(route('tmpclients.edit', $client->id) . '?status=' . $status);

        // return redirect(route('tmpclients.index'))->withFlashMessage(trans('admin.created', ['name' => 'عميل']));
    }

    public function update($id, Request $request)
    {
        $imgfile = $request->oldimage;
        $image = $request->file('image');

        if ($image && $image->isValid()) {
            $extension = $image->getClientOriginalExtension();
            $imgfile = 'image' . time() . '.' . $extension;
            $image->move('public/uploads/tmp_clients_images', $imgfile);
        }

        TempClients::where('id', $id)->update([
            'product_id' => $request->product_id,
            'type' => $request->type,
            'year' => $request->year,
            'image' => $imgfile,
            'bui_name' => $request->bui_name,
            'segl_name' => $request->segl_name,
            'center_name' => $request->center_name,
            'postal_code' => $request->postal_code,
            'region' => $request->region,
            'city' => $request->city,
            'maintainace_cat' => $request->maintainace_cat,
            'worker_num' => $request->worker_num,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'supervisor' => $request->supervisor,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'website' => $request->website,
            'responsable' => $request->responsable,
            'greeting' => $request->greeting,
            'title' => $request->title,
            'address' => $request->address,
            'password' => $request->password,
            'truecaller_id' => $request->truecaller_id,
            'truecaller_pass' => $request->truecaller_pass,
            'anydesk_id' => $request->anydesk_id,
            'technical' => $request->technical,
            'technical_num' => $request->technical_num,
            'status' => (bool) $request->status,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);
        if (!isset($request->status) || $request->status == 0) {
            TempClients::where('id', $id)->update([
                'old_segl_num' => $request->segl_name,
                'old_center' => $request->center_name,
                'old_city' => $request->city,
                'old_phone' => $request->phone,
                'old_email' => $request->email,
                'old_responsable' => $request->responsable,
                'old_mobile' => $request->mobile,
                'old_address' => $request->address,
                'old_technical' => $request->technical,
                'old_technical_num' => $request->technical_num,
                'code' => $request->code,
                'old_region' => $request->region,
            ]);
        }

        if ($request->status == 1) {
            return redirect(route('tmpclients.edit', $id) . '?status=' . $request->status);
        }
        return redirect()->back()->withFlashMessage(trans('admin.updated', ['name' => 'عميل']));
    }
    public function AjaxLoad(Request $request)
    {
        $tmpclients = TempClients::where('status', $request->get('status'))->orderBy('created_at', 'desc')->currentYear()->get();
        return Datatables::of($tmpclients)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('centername', function ($model) {

                return $model->center_name;
            })
            ->editColumn('year', function ($model) {

                return $model->year;
            })
            ->editColumn('city', function ($model) {

                return $model->city;
            })
            ->editColumn('region', function ($model) {

                return $model->city;
            })
            ->editColumn('product', function ($model) {
                if ($model->product) {
                    return $model->product->code;
                } else {
                    return "-";
                }
            })

            ->editColumn('segl_num', function ($model) {

                return $model->segl_name;
            })
            ->editColumn('phone', function ($model) {

                return $model->phone;
            })

            ->editColumn('image', function ($model) {

                return "<img style='width: 150px;' src='" . url('/') . "/uploads/tmp_clients_images/" . $model->image . "'>";
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('tmpclients.show', $model->id), route('tmpclients.edit', $model->id) . '?status=' . \Request::get('status'), route('tmpclients.destroy', $model->id));
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

        TempClients::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'عميل']);
        if ($request->ajax()) {
            return Response::json($delMessage);

            return redirect(route('tmpclients.index'))->withFlashMessage($delMessage);
        }
        return false;
    }
}
