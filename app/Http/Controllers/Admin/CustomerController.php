<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\City;
use App\Models\Country;
use App\Models\Customers;
use App\Models\CustomerCategory;
use App\Models\Region;
use DataTables;
use Illuminate\Http\Request;
use View;

class CustomerController extends MainController
{
    private $viewPath = 'admin.customers.';
    private $policy = 'users.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.users'));
    }

    public function create()
    {
        $cities = City::all();
        $regions = Region::all();
        $countries = Country::all();
        $categories = CustomerCategory::all();
        $customers = Customers::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['countries' => $countries, 'cities' => $cities, 'regions' => $regions, 'categories' => $categories, 'customers' => $customers]);
    }
    public function edit($id)
    {
        $cities = City::all();
        $regions = Region::all();
        $countries = Country::all();
        $customer = Customers::find($id);
        $categories = CustomerCategory::all();
        $customers = Customers::all();
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['customer' => $customer, 'countries' => $countries, 'cities' => $cities, 'regions' => $regions, 'categories' => $categories, 'customers' => $customers], 'edit');
    }

    public function index(Request $req)
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }
    public function store(Request $request)
    {
        if ($request->selectregion != "") {
            $region = $request->selectregion;
        } else {
            $region = $request->region;
        }

        if ($request->selectcity != "") {
            $regcity = $request->selectcity;
        } else {
            $regcity = $request->reg_city;
        }

        $files = $request->file('files');
        $filenames = [];

        if (isset($files) && count($files) > 0) {
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc-' . time() . '.' . $extension;
                    array_push($filenames, $filename);
                    $file->move('public/uploads/documents', $filename);
                }
            }
        }

        $imfilenames = implode(',', $filenames);
        $resp_name = implode(',', $request->resp_name);
        $work = implode(',', $request->work);
        $resp_tele = implode(',', $request->resp_tele);
        $resp_phone = implode(',', $request->resp_phone);
        $resp_email = implode(',', $request->resp_email);
        $resp_tele_red = implode(',', $request->resp_tele_red);
        $locate = implode(',', $request->locate);
        $phonenumber = implode(',', $request->phonenumber);
        $fax = implode(',', $request->fax);
        $telephone = implode(',', $request->telephone);
        $city = implode(',', $request->city);
        $phonenumbertwo = implode(',', $request->phonenumbertwo);
        $email_add = implode(',', $request->email_add);
        $telephone_red = implode(',', $request->telephone_red);
        //Sponser add
        $resp_name_sponsor = implode(',', $request->resp_name_sponsor);
        $work_sponsor = implode(',', $request->work_sponsor);
        $resp_tele_sponsor = implode(',', $request->resp_tele_sponsor);
        $resp_phone_sponsor = implode(',', $request->resp_phone_sponsor);
        $resp_email_sponsor = implode(',', $request->resp_email_sponsor);
        $resp_tele_red_sponsor = implode(',', $request->resp_tele_red_sponsor);


        $name = $request->name;
        $name_en = $request->name_en;
        $org_name = $request->org_name;
        $org_number = $request->org_number;
        $segl_number = $request->segl_number;
        $dreb_number = $request->dreb_number;
        $lic_number = $request->lic_number;
        $country = $request->country;
        $street = $request->street;

        //---------------save------------------------
        $customer = new Customers();
        $customer->files = $imfilenames;
        $customer->resp_name = $resp_name;
        $customer->work = $work;
        $customer->resp_tele = $resp_tele;
        $customer->resp_phone = $resp_phone;
        $customer->resp_email = $resp_email;
        $customer->resp_tele_red = $resp_tele_red;
        $customer->locate = $locate;
        $customer->phonenumber = $phonenumber;
        $customer->fax = $fax;
        $customer->telephone = $telephone;
        $customer->city = $city;
        $customer->phonenumbertwo = $phonenumbertwo;
        $customer->email_add = $email_add;
        $customer->telephone_red = $telephone_red;
        $customer->name = $name;
        $customer->name_en = $name_en;
        $customer->org_name = $org_name;
        $customer->org_number = $org_number;
        $customer->segl_number = $segl_number;
        $customer->dreb_number = $dreb_number;
        $customer->lic_number = $lic_number;
        $customer->country = $country;
        $customer->street = $street;
        $customer->region = $region;
        $customer->reg_city = $regcity;
        $customer->lat = $request->lat;
        $customer->lng = $request->lng;
        $customer->parent_id = $request->parent_id;
        $customer->category_id = $request->category_id;
        $customer->resp_name_sponsor = $resp_name_sponsor;
        $customer->work_sponsor = $work_sponsor;
        $customer->resp_tele_sponsor = $resp_tele_sponsor;
        $customer->resp_phone_sponsor = $resp_phone_sponsor;
        $customer->resp_email_sponsor = $resp_email_sponsor;
        $customer->resp_tele_red_sponsor = $resp_tele_red_sponsor;

        $customer->save();
        return redirect(route('customers.index'))->withFlashMessage('تم انشاء العميل بنجاح');
    }

    public function update($id, Request $request)
    {
        $filesedit = $request->editfiles;
        if ($filesedit && $filesedit != '') {
            $filenames = $request->editfiles;
        } else {
            $filenames = [];
        }
        $files = $request->file('files');
        $mapimg = $request->file('map_img');

        if (isset($files) && count($files) > 0) {
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'doc-' . time() . '.' . $extension;
                    array_push($filenames, $filename);
                    $file->move('public/uploads/documents', $filename);
                }
            }
        }
        if ($mapimg && $mapimg->isValid()) {
            $extension = $mapimg->getClientOriginalExtension();
            $mapimgfile = 'map-images' . time() . '.' . $extension;
            $mapimg->move('public/uploads/map_images', $mapimgfile);
        } else {
            $mapimgfile = $request->map_img_data;
        }
        $imfilenames = implode(',', $filenames);
        $resp_name = implode(',', $request->resp_name);
        $work = implode(',', $request->work);
        $resp_tele = implode(',', $request->resp_tele);
        $resp_phone = implode(',', $request->resp_phone);
        $resp_email = implode(',', $request->resp_email);
        $resp_tele_red = implode(',', $request->resp_tele_red);
        $locate = implode(',', $request->locate);
        $phonenumber = implode(',', $request->phonenumber);
        $fax = implode(',', $request->fax);
        $telephone = implode(',', $request->telephone);
        $city = implode(',', $request->city);
        $phonenumbertwo = implode(',', $request->phonenumbertwo);
        $email_add = implode(',', $request->email_add);
        $telephone_red = implode(',', $request->telephone_red);
        $name = $request->name;
        $name_en = $request->name_en;
        $org_name = $request->org_name;
        $org_number = $request->org_number;
        $segl_number = $request->segl_number;
        $dreb_number = $request->dreb_number;
        $lic_number = $request->lic_number;
        $country = $request->country;
        $street = $request->street;
        $region = $request->region;
        //Sponser edit
        $resp_name_sponsor = implode(',', $request->resp_name_sponsor);
        $work_sponsor = implode(',', $request->work_sponsor);
        $resp_tele_sponsor = implode(',', $request->resp_tele_sponsor);
        $resp_phone_sponsor = implode(',', $request->resp_phone_sponsor);
        $resp_email_sponsor = implode(',', $request->resp_email_sponsor);
        $resp_tele_red_sponsor = implode(',', $request->resp_tele_red_sponsor);


        if ($request->selectregion != "") {
            $region = $request->selectregion;
        } else {
            $region = $request->region;
        }

        if ($request->selectcity != "") {
            $regcity = $request->selectcity;
        } else {
            $regcity = $request->reg_city;
        }
        $customer = Customers::find($id);
        $customer->files = $imfilenames;
        // $customer->map_img = $mapimgfile;
        $customer->resp_name = $resp_name;
        $customer->work = $work;
        $customer->resp_tele = $resp_tele;
        $customer->resp_phone = $resp_phone;
        $customer->resp_email = $resp_email;
        $customer->resp_tele_red = $resp_tele_red;
        $customer->locate = $locate;
        $customer->phonenumber = $phonenumber;
        $customer->fax = $fax;
        $customer->telephone = $telephone;
        $customer->city = $city;
        $customer->phonenumbertwo = $phonenumbertwo;
        $customer->email_add = $email_add;
        $customer->telephone_red = $telephone_red;
        $customer->name = $name;
        $customer->name_en = $name_en;
        $customer->org_name = $org_name;
        $customer->org_number = $org_number;
        $customer->segl_number = $segl_number;
        $customer->dreb_number = $dreb_number;
        $customer->lic_number = $lic_number;
        $customer->country = $country;
        $customer->street = $street;
        $customer->region = $region;
        $customer->reg_city = $regcity;
        $customer->lat = $request->lat;
        $customer->lng = $request->lng;
        $customer->parent_id = $request->parent_id;
        $customer->category_id = $request->category_id;
        $customer->resp_name_sponsor = $resp_name_sponsor;
        $customer->work_sponsor = $work_sponsor;
        $customer->resp_tele_sponsor = $resp_tele_sponsor;
        $customer->resp_phone_sponsor = $resp_phone_sponsor;
        $customer->resp_email_sponsor = $resp_email_sponsor;
        $customer->resp_tele_red_sponsor = $resp_tele_red_sponsor;
        $customer->save();

        return redirect(route('customers.index'))->withFlashMessage('تم تعديل العميل بنجاح');
    }

    public function show($id)
    {
        $customer = Customers::find($id);
        return $this->getView($this->viewPath . 'show', $this->policy . 'create', ['customer' => $customer], 'create');
    }

    public function AjaxLoad(Customers $data)
    {
        if (\Request::get('category_id') != "") {
            $cat_id = \Request::get('category_id');
            $products = Customers::where('category_id', $cat_id)->get();
        } elseif (\Request::get('parent_id') != "") {
            $parent_id = \Request::get('parent_id');
            $products = Customers::where('parent_id', $parent_id)->get();
        } else {
            $products = $data->whereNull('parent_id')->get();
        }
        return Datatables::of($products)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('code', function ($model) {
                return $model->code;
            })
            ->editColumn('customers', function ($model) {
                return "<a href='" . route('customers.index') . "?parent_id=" . $model->id . "' target='_blank'>" . count($model->customers) . " عميل </a>";
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, '', route('customers.edit', $model->id), null);
            })
            ->escapeColumns([])
            ->make(true);
    }
}
