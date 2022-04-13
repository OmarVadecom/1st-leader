<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Maintenance;
use App\Models\MaintenanceReport;
use App\Models\Parts;
use App\Models\Products;
use App\Models\WarrantyNotification;
use Illuminate\Http\Request;
use View;

class MaintenanceReportController extends MainController
{
    private $viewPath = 'admin.maintenance_report.';
    private $policy = 'page-categories.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.maintenance'));
    }

    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create()
    {
        $m = \Request::get('m');
        $maint = Maintenance::find($m);

        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['maint' => $maint], 'create');
    }

    public function edit($id)
    {

        $maintenance = MaintenanceReport::findOrFail($id);
        $maint = Maintenance::find($maintenance->maintenance_id);
        $notes = explode(',', $maint->notes);
        $attachments = explode(',', $maint->attachments);


        if ($maintenance->products_id != '') {
            $offer_products_ids = explode(',', $maintenance->products_id);
        } else {
            $offer_products_ids = [];
        }

        if ($maintenance->parts_id != '') {
            $offer_parts_ids = explode(',', $maintenance->parts_id);
        } else {
            $offer_parts_ids = [];
        }

        $offer_products_quantities = explode(',', $maintenance->quantities);
        $offer_products_prices = explode(',', $maintenance->prices);
        $offer_products_discounts = explode(',', $maintenance->discounts);
        $offer_products_taxes = explode(',', $maintenance->dreba);
        $offer_products_totals = explode(',', $maintenance->totals);
        $offer_products = [];

        foreach ($offer_products_ids as $key => $pid) {
            array_push($offer_products, Products::find($pid));
        }
        foreach ($offer_parts_ids as $key => $pid) {
            array_push($offer_products, Parts::find($pid));
        }

        $total_price = 0;
        if (count($offer_products_totals) > 0) {
            $total_price = array_sum($offer_products_totals);
        }

        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['offer_products_quantities' => $offer_products_quantities, 'offer_products_prices' => $offer_products_prices, 'offer_products_discounts' => $offer_products_discounts, 'offer_products_taxes' => $offer_products_taxes, 'offer_products_totals' => $offer_products_totals, 'offer_products' => $offer_products, 'total_price' => $total_price, 'maintenance' => $maintenance, 'edit' => true, 'notes' => $notes, 'attachments' => $attachments], 'edit');
    }

    public function store(Request $request)
    {
        $products = '';
        $prices = '';
        $quantities = '';
        $darebas = '';
        $parts = '';
        $discounts = '';
        $totalss = '';

        $filenames = [];
        $main_images = $request->file('main_images');

        if (isset($main_images) && count($main_images) > 0) {
            foreach ($main_images as $key => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'main_img-' . $key . time() . '.' . $extension;
                    array_push($filenames, $filename);
                    $file->move('uploads/main-attachments', $filename);
                }
            }
        }

        $attachments = implode(',', $filenames);
        if (isset($request->main_spec) && isset($main_images)) {
            $maint = Maintenance::where('id', $request->maintenance_id)->update([
                'notes' => implode(',', $request->main_spec),
                'attachments' => $attachments,
            ]);
        }

        if ($request->product) {
            $products = [];
            $parts = [];
            $prices = [];
            $quantities = [];
            $darebas = [];
            $discounts = [];
            $totalss = [];
            $elements_type = $request->product_code_type;
            foreach ($request->product as $k => $element) {
                if ($elements_type[$k] != 'ES' && $elements_type[$k] != 'EA') {
                    array_push($products, $element);
                    array_push($prices, $request->price[$k]);
                    array_push($quantities, $request->quantity[$k]);
                    array_push($darebas, $request->dareba[$k]);
                    array_push($discounts, $request->discount[$k]);
                    array_push($totalss, $request->totals[$k]);
                }
            }
            foreach ($request->product as $k => $element) {
                if ($elements_type[$k] == 'ES' || $elements_type[$k] == 'EA') {
                    array_push($parts, $element);
                    array_push($prices, $request->price[$k]);
                    array_push($quantities, $request->quantity[$k]);
                    array_push($darebas, $request->dareba[$k]);
                    array_push($discounts, $request->discount[$k]);
                    array_push($totalss, $request->totals[$k]);
                }
            }
            $products = implode(',', $products);
            $parts = implode(',', $parts);
            $prices = implode(',', $prices);
            $quantities = implode(',', $quantities);
            $darebas = implode(',', $darebas);
            $discounts = implode(',', $discounts);
            $totalss = implode(',', $totalss);
        }

        $maintenanceReport = MaintenanceReport::create([
            "customer_id" => $request->customer_id,
            "maintenance_id" => $request->maintenance_id,
            "status" => (bool) $request->status,
            "start" => $request->start,
            "end" => $request->end,
            "type" => $request->type,
            "tech_rate" => $request->tech_rate,
            "tech_report" => $request->tech_report,
            "recommends" => $request->recommends,
            "recommends_rate" => $request->recommends_rate,
            'products_id' => $products,
            'parts_id' => $parts,
            'quantities' => $quantities,
            'dreba' => $darebas,
            'prices' => $prices,
            'discounts' => $discounts,
            'totals' => $totalss,
            'addon_disc' => $request->addon_disc,
            'status_report' => $request->status_report,
            'status_warranty' => $request->status_warranty,
        ]);

        if(isset($request['status_warranty']) && $request['status_warranty'] == 2) {

            $model_type = "";

            if($request['main_type'] == 2) {
                $model_type = "طلبات الصيانه الخارجيه";
            }

            if($request['main_type'] == 4) {
                $model_type = "طلبات الزيارة الميدانيه";
            }

            if($request['main_type'] == 5) {
                $model_type = "طلبات الاتصالات";
            }

            if($request['main_type'] == null) {
                $model_type = "طلبات الورشه";
            }

            if(isset($parts) && $parts != "" && $parts != null) {
                $parts = explode(',', $parts);
                foreach ($parts as $part) {
                    if(count($parts) > 0) {
                        WarrantyNotification::create([
                            'model_type'    => $model_type,
                            'part_id'       => $part,
                            'code'          => $request['code']
                        ]);
                    }
                }
            }

            if(isset($products) && $products != "" && $products != null) {
                $products = explode(',', $products);
                foreach ($products as $product) {
                    if(count($products) > 0) {
                        WarrantyNotification::create([
                            'model_type'    => $model_type,
                            'product_id'    => $product,
                            'code'          => $request['code']
                        ]);
                    }
                }
            }
        }

        if($request['main_type']) {
            return redirect(route('maintenance.index') . '?main_type=' . $request['main_type'])->withFlashMessage(trans('admin.created', ['name' => 'تقرير صيانه']));
        }
        return redirect(route('maintenance.index'))->withFlashMessage(trans('admin.created', ['name' => 'تقرير صيانه']));
    }

    public function update($id, Request $request)
    {
        $maintenance = MaintenanceReport::findOrFail($id);
        $products = '';
        $prices = '';
        $quantities = '';
        $darebas = '';
        $discounts = '';
        $totalss = '';
        $parts = '';
        $filenames = [];


        $main_imgs = $request->file('main_images');
        if (isset($request->main_spec)) {
            foreach ($request->main_spec as $key => $spec) {
                if (isset($main_imgs[$key])) {
                    $file = $main_imgs[$key];
                    if ($file && $file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'main_img-' . $key . time() . '.' . $extension;
                        array_push($filenames, $filename);
                        $file->move('uploads/main-attachments', $filename);
                    }
                } else {
                    if(isset($request['old_main_images'][$key])) {
                        array_push($filenames, $request['old_main_images'][$key]);
                    }
                }
            }
        }



        $attachments = implode(',', $filenames);
        if (isset($request->main_spec)) {
            $main_spec_var = implode(',', $request->main_spec);
        } else {
            $main_spec_var = '';
        }
        $maint = Maintenance::where('id', $maintenance->maintenance_id)->update([
            'notes' => $main_spec_var,
            'attachments' => $attachments,
        ]);

        if ($request->product) {
            $products = [];
            $parts = [];
            $prices = [];
            $quantities = [];
            $darebas = [];
            $discounts = [];
            $totalss = [];
            $elements_type = $request->product_code_type;

            foreach ($request->product as $k => $element) {
                if ($elements_type[$k] != 'ES' && $elements_type[$k] != 'EA') {
                    array_push($products, $element);
                    array_push($prices, $request->price[$k]);
                    array_push($quantities, $request->quantity[$k]);
                    array_push($darebas, $request->dareba[$k]);
                    array_push($discounts, $request->discount[$k]);
                    array_push($totalss, $request->totals[$k]);
                }
            }
            foreach ($request->product as $k => $element) {
                if ($elements_type[$k] == 'ES' || $elements_type[$k] == 'EA') {
                    array_push($parts, $element);
                    array_push($prices, $request->price[$k]);
                    array_push($quantities, $request->quantity[$k]);
                    array_push($darebas, $request->dareba[$k]);
                    array_push($discounts, $request->discount[$k]);
                    array_push($totalss, $request->totals[$k]);
                }
            }
            $products = implode(',', $products);
            $parts = implode(',', $parts);
            $prices = implode(',', $prices);
            $quantities = implode(',', $quantities);
            $darebas = implode(',', $darebas);
            $discounts = implode(',', $discounts);
            $totalss = implode(',', $totalss);
        }

        $maintenance->update([
            "status" => (bool) $request->status,
            "start" => $request->start,
            "end" => $request->end,
            "type" => $request->type,
            "tech_rate" => $request->tech_rate,
            "tech_report" => $request->tech_report,
            "recommends" => $request->recommends,
            "recommends_rate" => $request->recommends_rate,
            'products_id' => $products,
            'parts_id' => $parts,
            'quantities' => $quantities,
            'dreba' => $darebas,
            'prices' => $prices,
            'discounts' => $discounts,
            'totals' => $totalss,
            'addon_disc' => $request->addon_disc,
            'status_report' => $request->status_report,
            'status_warranty' => $request->status_warranty,

        ]);

        if(isset($request['status_warranty']) && $request['status_warranty'] == 2) {

            $model_type = "";

            if($request['main_type'] == 2) {
                $model_type = "طلبات الصيانه الخارجيه";
            }

            if($request['main_type'] == 4) {
                $model_type = "طلبات الزيارة الميدانيه";
            }

            if($request['main_type'] == 5) {
                $model_type = "طلبات الاتصالات";
            }

            if($request['main_type'] == null) {
                $model_type = "طلبات الورشه";
            }

            if(isset($parts) && $parts != "" && $parts != null) {
                $parts = explode(',', $parts);
                foreach ($parts as $part) {
                    if(count($parts) > 0) {
                        WarrantyNotification::create([
                            'model_type'    => $model_type,
                            'part_id'       => $part,
                            'code'          => $request['code']
                        ]);
                    }
                }
            }

            if(isset($products) && $products != "" && $products != null) {
                $products = explode(',', $products);
                foreach ($products as $product) {
                    if(count($products) > 0) {
                        WarrantyNotification::create([
                            'model_type'    => $model_type,
                            'product_id'    => $product,
                            'code'          => $request['code']
                        ]);
                    }
                }
            }
        }

        return redirect(route('maintenance.index'))->withFlashMessage(trans('admin.updated', ['name' => 'تقرير صيانه']));
    }

    public function show($id)
    {
        $maintenance_report = MaintenanceReport::findOrFail($id);
        $maintenance = Maintenance::where('id', $maintenance_report->maintenance_id)->first();
        if ($maintenance->parts_id != '') {
            $maintenance_parts_ids = explode(',', $maintenance->parts_id);
        } else {
            $maintenance_parts_ids = [];
        }
        $maintenance_parts = [];
        foreach ($maintenance_parts_ids as $key => $pid) {
            array_push($maintenance_parts, Parts::find($pid));
        }
        $allproducts = array();
        $parts = explode(',', $maintenance_report->parts_id);
        $quantities = explode(',', $maintenance_report->quantities);
        $prices = explode(',', $maintenance_report->prices);
        $discounts = explode(',', $maintenance_report->discounts);
        $drebas = explode(',', $maintenance_report->dreba);
        if (count($parts) > 0 && $parts[0] != null) {
            foreach ($parts as $part) {
                $single = Parts::find($part);
                array_push($allproducts, $single);
            }
        }

        $parts_num = explode(',', $maintenance->parts_num);
        $parts_status = explode(',', $maintenance->parts_status);
        $parts_op_status = explode(',', $maintenance->parts_op_status);
        $parts_cleaning = explode(',', $maintenance->parts_cleaning);
        $attachments = explode(',', $maintenance->attachments);
        $notes = explode(',', $maintenance->notes);

        return $this->getView($this->viewPath . 'show', $this->policy . 'update', ['maintenance' => $maintenance, 'parts' => $maintenance_parts, 'parts_num' => $parts_num, 'parts_status' => $parts_status, 'parts_op_status' => $parts_op_status, 'parts_cleaning' => $parts_cleaning, 'attachments' => $attachments, 'notes' => $notes, 'maintenance_report' => $maintenance_report, 'quantities' => $quantities, 'prices' => $prices, 'discounts' => $discounts, 'drebas' => $drebas, 'allproducts' => $allproducts], 'edit');
    }

    // public function destroy($id, Request $request)
    // {
    //     Maintenance::findOrFail($id)->delete();
    //     $delMessage = trans('admin.deleted', ['name' => 'طلب صيانه']);
    //     if ($request->ajax()) {
    //         return Response::json($delMessage);
    //     }
    //     return redirect(route('maintenance.index'))->withFlashMessage($delMessage);
    // }

    // /*
    //  * Ajax
    //  */
    // public function AjaxLoad(Maintenance $data)
    // {
    //     $parts = $data->all();
    //     return Datatables::of($parts)
    //         ->rawColumns(['action', 'select', 'status'])
    //         ->editColumn('select', function ($model) {
    //             return getSelectAjax($model);
    //         })

    //         ->editColumn('name', function ($model) {

    //             return $model->product->name;
    //         })

    //         ->editColumn('title', function ($model) {

    //             if ($model->type == 0) {
    //                 return $model->title;
    //             } else {
    //                 return $model->complaint->title;
    //             }
    //         })
    //         ->editColumn('action', function ($model) {
    //             return getAjaxAction($this->policy, $model, null, route('maintenance.edit', $model->id), route('maintenance.destroy', $model->id));
    //         })
    //         ->escapeColumns([])
    //         ->make(true);
    // }

    // public function multiDelete(Request $request, page $data)
    // {
    //     if (!Auth::user()->can($this->policy . 'delete')) {
    //         if ($request->ajax()) {
    //             return Response::json(important_pages('ajax.403'));
    //         }
    //         return view(important_pages('403'));
    //     }

    //     if ($request->ajax()) {
    //         $ids = $request->id;
    //         foreach ($ids as $id) {
    //             $find = $data->find($id);
    //             if ($find == null) {
    //                 continue;
    //             }
    //             $find->delete();
    //         }
    //         return Response::json('done');
    //     }
    //     return abort(404);

    // }
}
