<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use App\Models\WarrantyNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Warranty;
use App\Models\Parts;
use Exception;

class WarrantyController extends MainController
{
    private $viewPath   = 'admin.warranties.';
    private $policy     = 'warranties.';

    public function __construct()
    {
        View::share('pageTitle', trans('admin.warranties'));
    }

    /**
     * Display A Listing Of The Resource.
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    /**
     * Display A Listing Of The Resource By Ajax.
     * @param Warranty $data
     * @return Factory|\Illuminate\View\View
     * @throws Exception
     */
    public function AjaxLoad(Warranty $data)
    {
        $initWarranties = $data->orderBy('created_at', 'desc')->currentYear();
        DB::statement(DB::raw('set @rownum=' . ($initWarranties->count() + 1)));
        $warranties = $initWarranties->select(['warranties.*', DB::raw('@rownum  := @rownum  - 1 AS rownum')])->get();

        return Datatables::of($warranties)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })
            ->editColumn('code', function ($model) {
                return 'WAR-' . substr($model->created_at->format('Y'), -2) . '-' . str_pad($model->rownum, 4, '0', STR_PAD_LEFT);
            })
            ->editColumn('date', function ($model) {
                return $model->date_create_warranty;
            })
            ->editColumn('type', function ($model) {
                return $model->type;
            })
            ->editColumn('product', function ($model) {
                if ($model->product_id !== null) {
                    if (isset($model->product)) {
                        return $model->product->name;
                    }
                    return '-';
                } else {
                    if (isset($model->part)) {
                        return $model->part->name;
                    }
                    return '-';
                }
            })
            ->editColumn('action', function ($model) {
                return getAjaxAction($this->policy, $model, route('warranties.show', $model->id) . "?invoice_num=" . $model->rownum, route('warranties.edit', $model->id), route('warranties.destroy', $model->id));
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show The Form For Creating A New Resource.
     * @param Request $request
     * @return Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        /**
        * When Redirect From Notification Of Warranties Update That Notification Is Read.
        **/
        if(isset($request['notify'])) {
            $warrantyNotification = WarrantyNotification::find($request['notify']);
            $warrantyNotification->update(['reading_status' => 1]);
        }

        $products   = Products::all();
        $parts      = Parts::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['products' => $products, 'parts' => $parts], 'create');
    }

    /**
     * Store A Newly Created Resource In Storage.
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $main_images    = $request->file('main_images');
        $filenames      = [];

        if (isset($main_images) && count($main_images) > 0) {
            foreach ($main_images as $key => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'warranty-' . $key . time() . '.' . $extension;
                    array_push($filenames, $filename);
                    $file->move('uploads/warranty-attachments', $filename);
                }
            }
        }

        $data = array_merge(
            $request->only(['date_create_warranty', 'tech_report', 'problem', 'recommend']),
            [
                'attachments'   => implode(',', $filenames),
                'user_id'       => auth()->id(),
                'notes'         => implode(',', $request['main_spec']),
                'type'          => $request['product_or_part'] == 1 ? 'منتج' : 'جزء'
            ]
        );

        if(isset($request['product_or_part']) && $request['product_or_part'] == 1) {
            $data['product_id'] = $request['product_id'];
        } else {
            $data['part_id'] = $request['part_id'];
        }

        Warranty::create($data);

        return redirect(route('warranties.index'))->withFlashMessage(trans('admin.created', ['name' => 'ضمان']));
    }

    /**
     * Display The Specified Resource.
     * @param int $id
     * @return Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $warranty = Warranty::find($id);

        $attachments    = explode(',', $warranty->attachments);
        $notes          = explode(',', $warranty->notes);

        return $this->getView($this->viewPath . 'show', $this->policy . 'show', [
                  'attachments'   => $attachments,
                  'warranty'      => $warranty,
                  'notes'         => $notes
               ], 'edit');
    }

    /**
     * Show The Form For Editing The Specified Resource.
     * @param int $id
     * @return Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $warranty = Warranty::find($id);

        $attachments    = explode(',', $warranty->attachments);
        $products       = Products::all();
        $notes          = explode(',', $warranty->notes);
        $parts          = Parts::all();

        return $this->getView($this->viewPath . 'edit', $this->policy . 'edit', [
                    'attachments'   => $attachments,
                    'warranty'      => $warranty,
                    'products'      => $products,
                    'notes'         => $notes,
                    'parts'         => $parts
                ], 'edit');
    }

    /**
     * Update The Specified Resource In Storage.
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $warranty = Warranty::find($id);

        $main_images    = $request->file('main_images');
        $filenames      = [];

        /**
        * Check If Found New Images By Notes And Add In Files And The Variable ( $filenames ) To Add To DB.
        **/
        if (isset($request['main_spec'])) {
            foreach ($request['main_spec'] as $key => $spec) {
                if (isset($main_images[$key])) {
                    $file = $main_images[$key];
                    if ($file && $file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'warranty-' . $key . time() . '.' . $extension;
                        array_push($filenames, $filename);
                        $file->move('uploads/warranty-attachments', $filename);
                    }
                } else {
                    if(isset($request['old_main_images'][$key])) {
                        array_push($filenames, $request['old_main_images'][$key]);
                    }
                }
            }
        }

        /**
        * Handle Data For Store In DB.
        * 1- All Data Except Attachments And Notes.
        * 2- Attachments Add File Names To Array And Implode It To String For Store In DB.
        * 3- Notes Like Attachments Add To Array Then Implode To String To Store In DB.
        **/
        $data = array_merge(
            $request->only(['date_create_warranty', 'tech_report', 'problem', 'recommend']),
            [
                'attachments'   => implode(',', $filenames),
                'notes'         => isset($request->main_spec) ? implode(',', $request['main_spec']) : '',
                'type'          => $request['product_or_part'] == 1 ? 'منتج' : 'جزء'
            ]
        );

        if(isset($request['product_or_part']) && $request['product_or_part'] == 1) {
            $data['product_id'] = $request['product_id'];
        } else {
            $data['part_id'] = $request['part_id'];
        }

        $warranty->update($data);

        /**
        * Remove Old Images.
        * Get Uploaded Images From Data Base.
        * Get Old Images That By Variable ( old_main_images ).
        * Check If Not In DB Remove From Files.
        **/
        if(isset($request['old_main_images'])) {
            foreach($request['old_main_images'] as $old_main_image) {
                $new_main_images = explode(',', $warranty->attachments);
                if(! in_array($old_main_image, $new_main_images)) {
                    File::delete('uploads/warranty-attachments/' . $old_main_image);
                }

            }
        }

        return redirect(route('warranties.index'))->withFlashMessage(trans('admin.updated', ['name' => 'الضمان']));
    }

    /**
     * Remove The Specified Resource From Storage.
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $warranty = Warranty::find($id);
        $warranty->delete();
        return redirect(route('warranties.index'))->withFlashMessage(trans('admin.deleted', ['name' => 'الضمان']));
    }
}
