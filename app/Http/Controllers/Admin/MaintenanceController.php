<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Customers;
use App\Models\Maintenance;
use App\Models\Parts;
use App\Models\Products;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use View;

class MaintenanceController extends MainController
{
    private $viewPath = 'admin.maintenance.';
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
        $customers = Customers::all();
        $products = Products::where('maintenance', 1)->get();
        $parts = Parts::where('maintenance', 1)->get();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['customers' => $customers, 'products' => $products, 'maintenance' => null, 'parts' => $parts], 'create');
    }

    public function edit($id)
    {
        $customers = Customers::all();
        $maintenance = Maintenance::findOrFail($id);
        $products = Products::where('maintenance', 1)->get();
        $parts = Parts::where('maintenance', 1)->get();

        if ($maintenance->parts_id != '') {
            $maintenance_parts_ids = explode(',', $maintenance->parts_id);
        } else {
            $maintenance_parts_ids = [];
        }
        $maintenance_parts = [];
        foreach ($maintenance_parts_ids as $key => $pid) {
            array_push($maintenance_parts, Parts::find($pid));
        }
        $parts_num = explode(',', $maintenance->parts_num);
        $parts_status = explode(',', $maintenance->parts_status);
        $parts_op_status = explode(',', $maintenance->parts_op_status);
        $parts_cleaning = explode(',', $maintenance->parts_cleaning);
        $attachments = explode(',', $maintenance->attachments);
        $notes = explode(',', $maintenance->notes);

        $delattachments = explode(',', $maintenance->del_attachments);
        $delnotes = explode(',', $maintenance->del_notes);
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['maintenance' => $maintenance, 'customers' => $customers, 'products' => $products, 'maintenance_parts' => $maintenance_parts, 'parts_num' => $parts_num, 'parts_status' => $parts_status, 'attachments' => $attachments, 'notes' => $notes, 'parts_op_status' => $parts_op_status, 'parts_cleaning' => $parts_cleaning, 'delattachments' => $delattachments, 'delnotes' => $delnotes, 'parts' => $parts], 'edit');
    }

    public function store(Request $request)
    {
        $filenames = [];
        $delfilenames = [];
        $main_imgs = $request->file('main_imgs');
        $del_main_imgs = $request->file('del_main_imgs');

        if (isset($main_imgs) && count($main_imgs) > 0) {
            foreach ($main_imgs as $key => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'main_img-' . $key . time() . '.' . $extension;
                    array_push($filenames, $filename);
                    $file->move('public/uploads/main-attachments', $filename);
                }
            }
        }
        $attachments = implode(',', $filenames);
        foreach ($request->del_main_spec as $key => $del) {
            if (isset($del_main_imgs[$key]) && $del_main_imgs[$key]->isValid()) {
                $file = $del_main_imgs[$key];
                $extension = $file->getClientOriginalExtension();
                $filename = 'main_img-' . $key . time() . '.' . $extension;
                array_push($delfilenames, $filename);
                $file->move('public/uploads/main-attachments', $filename);
            } else {
                array_push($delfilenames, '');
            }
        }
        $delattachments = implode(',', $delfilenames);

        $product = [];
        $part_num = [];
        $part_status = [];
        $main_spec = [];
        $parts_op_status = [];
        $parts_cleaning = [];
        if (isset($request->product)) {
            $product = $request->product;
        }
        if (isset($request->part_num)) {
            $part_num = $request->part_num;
        }
        if (isset($request->part_status)) {
            $part_status = $request->part_status;
        }
        if (isset($request->main_spec)) {
            $main_spec = $request->main_spec;
        }
        if (isset($request->del_main_spec)) {
            $del_main_spec = $request->del_main_spec;
        }
        if (isset($request->parts_op_status)) {
            $parts_op_status = $request->parts_op_status;
        }
        if (isset($request->parts_cleaning)) {
            $parts_cleaning = $request->parts_cleaning;
        }
        $lastcode = 1;
        if ($request->main_type == 2) {
            $lastcode = Maintenance::where('main_type', 2)->max('main_code') + 1;
        }
        $maintenance = Maintenance::create([
            "client_id" => $request->client,
            "date" => $request->date,
            "time" => $request->time,
            "name" => $request->name,
            "product_id" => $request->main_product_id,
            "part_id" => $request->main_part_id,

            'parts_id' => implode(',', $product),
            'parts_num' => implode(',', $part_num),
            'parts_status' => implode(',', $part_status),
            'parts_op_status' => implode(',', $parts_op_status),
            'parts_cleaning' => implode(',', $parts_cleaning),
            'notes' => implode(',', $main_spec),
            'del_notes' => implode(',', $del_main_spec),
            "serial_num" => $request->serial_num,
            "type" => $request->type,
            "quantity" => $request->quantity,
            "status" => $request->status,
            "op_status" => $request->op_status,
            "cleaning" => $request->cleaning,
            'attachments' => $attachments,
            'del_attachments' => $delattachments,

            "problem_rate" => $request->problem_rate,
            "problem_description" => $request->problem_description,
            "delivery_rate" => $request->delivery_rate,
            "delivery_description" => $request->delivery_description,
            "cost" => $request->cost,
            'main_type' => $request->main_type,
            'main_code' => $lastcode,
        ]);

        if ($request['main_type'] === '2') {
            return redirect(route('maintenance.index') . '?main_type=2')->withFlashMessage(trans('admin.created', ['name' => 'طلب صيانه']));
        } elseif ($request['main_type'] === '4') {
            return redirect(route('maintenance.index') . '?main_type=4')->withFlashMessage(trans('admin.created', ['name' => 'طلب زيارة ميدانيه']));
        } elseif ($request['main_type'] === '5') {
            return redirect(route('maintenance.index') . '?main_type=5')->withFlashMessage(trans('admin.created', ['name' => 'طلب الاتصالات']));
        } else {
            return redirect(route('maintenance.index'))->withFlashMessage(trans('admin.created', ['name' => 'طلب ورشه']));
        }
    }

    public function update($id, Request $request)
    {

        if (isset($request->old_main_imgs)) {
            $filenames = $request->old_main_imgs;
        } else {
            $filenames = [];
        }


        $delfilenames = [];

        $main_imgs = $request->file('main_imgs');
        $del_main_imgs = $request->file('del_main_imgs');

        if (isset($main_imgs) && count($main_imgs) > 0) {
            foreach ($main_imgs as $key => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'main_img-' . $key . time() . '.' . $extension;
                    array_push($filenames, $filename);
                    $file->move('public/uploads/main-attachments', $filename);
                }
            }
        }

        $attachments = implode(',', $filenames);

        if (isset($request->del_main_spec, $request['old_del_main_imgs']) && $del_main_imgs !== null) {
            foreach ($request->del_main_spec as $key => $del) {
                if (isset($del_main_imgs[$key]) && $del_main_imgs[$key]->isValid()) {
                    $file = $del_main_imgs[$key];
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'main_img-' . $key . time() . '.' . $extension;
                    array_push($delfilenames, $filename);
                    $file->move('public/uploads/main-attachments', $filename);
                } else {
                    $delfilenames[] = $request->old_del_main_imgs[$key];
                }
            }
        }
        $delattachments = implode(',', $delfilenames);

        $product = [];
        $part_num = [];
        $part_status = [];
        $main_spec = [];
        $del_main_spec = [];
        $parts_op_status = [];
        $parts_cleaning = [];
        if (isset($request->product)) {
            $product = $request->product;
        }
        if (isset($request->part_num)) {
            $part_num = $request->part_num;
        }
        if (isset($request->part_status)) {
            $part_status = $request->part_status;
        }
        if (isset($request->main_spec)) {
            $main_spec = $request->main_spec;
        }
        if (isset($request->del_main_spec)) {
            $del_main_spec = $request->del_main_spec;
        }
        if (isset($request->parts_op_status)) {
            $parts_op_status = $request->parts_op_status;
        }
        if (isset($request->parts_cleaning)) {
            $parts_cleaning = $request->parts_cleaning;
        }

        $maintenance = Maintenance::findOrFail($id);
        $maintenance->update([
            "client_id" => $request->client,
            "date" => $request->date,
            "time" => $request->time,
            "name" => $request->name,
            "product_id" => $request->main_product_id,
            "part_id" => $request->main_part_id,
            'parts_id' => implode(',', $product),
            'parts_num' => implode(',', $part_num),
            'parts_status' => implode(',', $part_status),
            'parts_op_status' => implode(',', $parts_op_status),
            'parts_cleaning' => implode(',', $parts_cleaning),
            'notes' => implode(',', $main_spec),
            'del_notes' => implode(',', $del_main_spec),
            "serial_num" => $request->serial_num,
            "type" => $request->type,
            "quantity" => $request->quantity,
            "status" => $request->status,
            "op_status" => $request->op_status,
            "cleaning" => $request->cleaning,
            "problem_rate" => $request->problem_rate,
            'attachments' => $attachments,
            'del_attachments' => $delattachments,
            "problem_description" => $request->problem_description,
            "delivery_rate" => $request->delivery_rate,
            "delivery_description" => $request->delivery_description,
            "cost" => $request->cost,
            'main_type' => $request->main_type,

        ]);
        if ($request['main_type'] === '2') {
            return redirect(route('maintenance.index') . '?main_type=2')->withFlashMessage(trans('admin.updated', ['name' => 'طلب صيانه']));
        } elseif ($request['main_type'] === '4') {
            return redirect(route('maintenance.index') . '?main_type=4')->withFlashMessage(trans('admin.updated', ['name' => 'طلب زيارة ميدانيه']));
        } elseif ($request['main_type'] === '5') {
            return redirect(route('maintenance.index') . '?main_type=5')->withFlashMessage(trans('admin.updated', ['name' => 'طلب مركز الاتصالات']));
        } else {
            return redirect(route('maintenance.index'))->withFlashMessage(trans('admin.updated', ['name' => 'طلب ورشه']));
        }
    }

    public function show($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        if ($maintenance->parts_id != '') {
            $maintenance_parts_ids = explode(',', $maintenance->parts_id);
        } else {
            $maintenance_parts_ids = [];
        }
        $maintenance_parts = [];
        foreach ($maintenance_parts_ids as $key => $pid) {
            array_push($maintenance_parts, Parts::find($pid));
        }
        $parts_num = explode(',', $maintenance->parts_num);
        $parts_status = explode(',', $maintenance->parts_status);
        $parts_op_status = explode(',', $maintenance->parts_op_status);
        $parts_cleaning = explode(',', $maintenance->parts_cleaning);
        $attachments = explode(',', $maintenance->del_attachments);
        $notes = explode(',', $maintenance->del_notes);

        return $this->getView($this->viewPath . 'show', $this->policy . 'update', ['maintenance' => $maintenance, 'parts' => $maintenance_parts, 'parts_num' => $parts_num, 'parts_status' => $parts_status, 'parts_op_status' => $parts_op_status, 'parts_cleaning' => $parts_cleaning, 'attachments' => $attachments, 'notes' => $notes], 'edit');
    }
    public function destroy($id, Request $request)
    {
        Maintenance::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'طلب صيانه']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('maintenance.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(Maintenance $data)
    {
        if (request('main_type')) {
            $initMaintenance = $data->where('main_type', request('main_type'))->orderBy('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initMaintenance->count() + 1)));
            $maintenance = $initMaintenance->select(['maintenance.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        } else {
            $initMaintenance = $data->where('main_type', null)->orWhere('main_type', 1)->orderBy('created_at', 'desc')->currentYear();
            DB::statement(DB::raw('set @rownum=' . ($initMaintenance->count() + 1)));
            $maintenance = $initMaintenance->select(['maintenance.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();
        }
        return Datatables::of($maintenance)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('code', function ($model) {

                return $model->code . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })
            ->editColumn('date', function ($model) {

                return $model->date . ' ' . $model->time;
            })
            ->editColumn('product', function ($model) {
                if ($model->product) {
                    return $model->product->name;
                } else {
                    return '-';
                }
            })
            ->editColumn('serial_num', function ($model) {

                return $model->serial_num;
            })
            ->editColumn('quantity', function ($model) {

                return $model->quantity ?? 0;
            })
            ->editColumn('client', function ($model) {
                if ($model->client) {
                    return $model->client->name;
                } else {
                    return '-';
                }
            })
            ->editColumn('status', function ($model) {
                $text = '';
                if (isset($model->report)) {
                    $text .= '<a href="' . url('/') . '/maintenance_report/' . $model->report->id . '?main_type=' . $model->main_type . '&invoice_num=' . $model->rownum . '" target="_blank">تقرير الصيانه </a><i style="color:green" class="fa fa-check"></i><br>';
                    if (isset($model->report->sell)) {
                        $text .= '<a href="' . url('/') . '/sells/' . $model->report->sell->id . '?invoice_num=' . $model->rownum . '" target="_blank"> فاتوره البيع </a><i style="color:green" class="fa fa-check"></i><br>';
                    } else {
                        $text .= '<a href="' . url('/') . '/sells/create?m=' . $model->report->id . '&main_type=' . (\Request::get("main_type") ?? 1) . '" target="_blank">انشاء فاتوره بيع </a><br>';
                    }
                    if (isset($model->report->delivery)) {
                        $text .= '<a href="' . url('/') . '/delivery/' . $model->report->delivery->id . '" target="_blank"> أمر التسليم </a><i style="color:green" class="fa fa-check"></i><br>';
                    } else {
                        $text .= '<a href="' . url('/') . '/delivery/create?m=' . $model->report->id . '" target="_blank">انشاء أمر تسليم </a><br>';
                    }
                } else {
                    $text .= '<a href="' . url('/') . '/maintenance_report/create?m=' . $model->id . '&main_type=' . $model->main_type . '&invoice_num=' . $model->rownum . '" target="_blank">انشاء تقرير صيانه </a><br>';
                }

                return $text;
            })
            ->editColumn('status_report', function ($model) {
                if (isset($model->report)) {
                    if ($model->report->status_report === 1) {
                        return 'تحت التنفيذ';
                    } elseif ($model->report->status_report === 2) {
                        return 'مكتمل';
                    } else {
                        return 'مرفوض';
                    }
                } else {
                    return 'لم يتم انشاء تقرير';
                }
            })
            ->editColumn('status_warranty', function ($model) {
                if (isset($model->report) && $model->report->status_warranty == 2) {
                    return 'داخل الضمان';
                } else {
                    return 'خارج الضمان';
                }
            })

            ->editColumn('action', function ($model) {
                if (in_array($model->main_type, [2, 4, 5])) {
                    if( auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
                        return getAjaxAction($this->policy, $model, route('maintenance.show', $model->id) . '?main_type=' . $model->main_type . '&invoice_num=' . $model->rownum, route('maintenance.edit', $model->id) . '?main_type=' . $model->main_type, route('maintenance.destroy', $model->id));
                    }
                    return getAjaxAction($this->policy, $model, route('maintenance.show', $model->id));
                }

                if( auth()->id() === 1 || auth()->id() === 7 || auth()->id() === 9) {
                    return getAjaxAction($this->policy, $model, route('maintenance.show', $model->id) . '?main_type=' . $model->main_type . '&invoice_num=' . $model->rownum, route('maintenance.edit', $model->id) . '?main_type=' . $model->main_type, route('maintenance.destroy', $model->id));
                }
                return getAjaxAction($this->policy, $model, route('maintenance.show', $model->id) . '?invoice_num=' . $model->rownum);
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
