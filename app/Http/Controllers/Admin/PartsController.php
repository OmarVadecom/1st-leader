<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Models\Brands;
use App\Models\Color;
use App\Models\Country;
use App\Models\Gifts;
use App\Models\Parts;
use App\Models\PartsAddons;
use App\Models\PartsMarket;
use App\Models\PartsProducts;
use App\Models\PartsProductsOut;
use App\Models\Products;
use DataTables;
use Illuminate\Http\Request;
use Redirect;
use Response;
use View;

class PartsController extends MainController
{
    private $viewPath = 'admin.parts.';
    private $policy = 'page-categories.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.parts'));
    }

    public function index(Request $req)
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create(Request $request)
    {
        $product = null;
        $productin = null;
        $productsout = null;
        $partsin = null;

        $part_id = $request->get('part_id');
        if (isset($part_id) && $part_id != "") {
            $product = Parts::findOrFail($part_id);
            $productsin = $product->productsin;
            $partsin = explode(',', $product->parts_id);
            $productin = array();
            $productsout = $product->productsout;
            foreach ($productsin as $productid) {
                $pro = Products::find($productid->product_id);
                array_push($productin, $pro);
            }
        }

        $products = Products::all();
        $countries = Country::all();
        $brands = Brands::all();
        $colors = Color::all();
        $parts = Parts::all();
        $gifts = Gifts::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['product' => $product, 'part' => null, 'parts' => $parts, 'products' => $products, 'countries' => $countries, 'brands' => $brands, 'colors' => $colors, 'gifts' => $gifts, 'productsin' => $productin, 'productsout' => $productsout, 'partsin' => $partsin], 'create');
    }

    public function edit($id)
    {
        $product = Parts::findOrFail($id);
        $products = Products::all();
        $countries = Country::all();
        $brands = Brands::all();
        $colors = Color::all();
        $parts = Parts::all();
        $productsin = $product->productsin;
        $partsin = explode(',', $product->parts_id);
        $productin = array();
        $productsout = $product->productsout;
        foreach ($productsin as $productid) {
            $pro = Products::find($productid->product_id);
            array_push($productin, $pro);
        }
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['product' => $product, 'products' => $products, 'countries' => $countries, 'brands' => $brands, 'colors' => $colors, 'parts' => $parts, 'productsin' => $productin, 'productsout' => $productsout, 'partsin' => $partsin], 'edit');
    }

    public function store(Request $request)
    {
        //  dd($request);
        if ($request->copyproduct == 1) {
            $productimage = $request->file('image');
            if ($productimage && $productimage->isValid()) {
                $extension = $productimage->getClientOriginalExtension();
                $imagefile = 'product-' . time() . '.' . $extension;
                $productimage->move('public/uploads/parts-attachments', $imagefile);
            } else {
                $imagefile = $request->oldimage;
            }

            $filesedit = $request->attachments_edit;
            if ($filesedit && $filesedit != '') {
                $filenames = $request->attachments_edit;
            } else {
                $filenames = [];
            }

            $files = $request->file('attachments');
            if (isset($files) && count($files)) {
                foreach ($files as $key => $file) {
                    if ($file && $file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'product-' . $key . time() . '.' . $extension;
                        array_push($filenames, $filename);
                        $file->move('public/uploads/parts-attachments', $filename);
                    }
                }
            }

            $old_outimage = $request->old_outimage;
            if ($old_outimage && $old_outimage != '') {
                $old_outimages = $request->old_outimage;
            } else {
                $old_outimages = [];
            }

            $files = $request->file('product_out-files');
            if (isset($files) && count($files)) {
                foreach ($files as $key => $file) {
                    if ($file && $file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'product-' . $key . time() . '.' . $extension;
                        array_push($old_outimages, $filename);
                        $file->move('public/uploads/products-parts-out', $filename);
                    }
                }
            }

            $chartsedit = $request->charts_edit;
            if ($chartsedit && $chartsedit != '') {
                $chartsnames = $request->charts_edit;
            } else {
                $chartsnames = [];
            }
            $chartimages = $request->file('charts');
            if (isset($chartimages) && count($chartimages)) {
                foreach ($chartimages as $key => $chart) {
                    if ($chart && $chart->isValid()) {
                        $extension = $chart->getClientOriginalExtension();
                        $filename = 'chart-' . $key . time() . '.' . $extension;
                        array_push($chartsnames, $filename);
                        $chart->move('parts-charts', $filename);
                    }
                }
            }
            $attachments = implode(',', $filenames);
            $charts = implode(',', $chartsnames);
        } else {
            $filename = '';
            $imagefile = '';
            $files = $request->file('attachments');
            $productimage = $request->file('image');
            $chartimages = $request->file('charts');
            $product_out_files = $request->file('product_out-files');
            $filenames = [];
            $charts = [];
            $product_out_images = [];

            if ($productimage && $productimage->isValid()) {
                $extension = $productimage->getClientOriginalExtension();
                $imagefile = 'product-' . time() . '.' . $extension;
                $productimage->move('public/uploads/parts-attachments', $imagefile);
            }

            if (isset($files) && count($files)) {
                foreach ($files as $key => $file) {
                    if ($file && $file->isValid()) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = 'product-' . $key . time() . '.' . $extension;
                        array_push($filenames, $filename);
                        $file->move('public/uploads/parts-attachments', $filename);
                    }
                }
            }
            $attachments = implode(',', $filenames);

            if (isset($chartimages) && count($chartimages)) {
                foreach ($chartimages as $key => $chart) {
                    if ($chart && $chart->isValid()) {
                        $extension = $chart->getClientOriginalExtension();
                        $filename = 'chart-' . $key . time() . '.' . $extension;
                        array_push($charts, $filename);
                        $chart->move('parts-charts', $filename);
                    }
                }
            }
            $charts = implode(',', $charts);

            //addon part
            if (isset($product_out_files) && count($product_out_files)) {
                foreach ($product_out_files as $key => $product_out_file) {
                    if ($product_out_file && $product_out_file->isValid()) {
                        $extension = $product_out_file->getClientOriginalExtension();
                        $filename = 'products-out-' . $key . time() . '.' . $extension;
                        array_push($product_out_images, $filename);
                        $product_out_file->move('public/uploads/products-parts-out', $filename);
                    }
                }
            }
        }
        //--------arrays----------
        $specs_names = implode(',', $request->specs_names);
        $specs_name = implode(',', $request->specs_name);
        $specs_desc = implode(',', $request->specs_desc);
        $attachment_names = implode(',', $request->attachment_names);
        $prices = implode(',', $request->prices);
        $prices_discounts = implode(',', $request->prices_discounts);
        $prices_targets = implode(',', $request->prices_targets);
        $units = implode(',', $request->units);
        $units_barcode = implode(',', $request->units_barcode);
        $units_cons = '';
        if (isset($request->units_cons)) {
            $units_cons = implode(',', $request->units_cons);
        }
        $unit_default = isset($request->unit_default[0]) ? $request->unit_default[0] : null;
        $charts_names = implode(',', $request->charts_names);
        $charts_description = implode(',', $request->charts_description);
        $supplier = implode(',', $request->supplier);
        $date = implode(',', $request->date);
        $sales_man = implode(',', $request->sales_man);
        $phone = implode(',', $request->phone);
        $price = implode(',', $request->price);
        $employee = implode(',', $request->employee);

        //partsadds

        if (isset($request->products_in)) {
            $products_in = implode(',', $request->products_in);
        } else {
            $products_in = null;
        }

        if (isset($request->parts_in)) {
            $parts_in = implode(',', $request->parts_in);
        } else {
            $parts_in = null;
        }

        $products_award = implode(',', $request->products_award);

        //-----------General Tab-------------------
        $product = new Parts;
        $product->products_id = $products_in;
        $product->parts_id = $parts_in;
        $product->code = $request->code;
        $product->secret_num = $request->secret_num;
        $product->code_type = $request->code_type;
        $product->name = $request->name;
        $product->name_en = $request->name_en;
        $product->insurance = $request->insurance;
        $product->type = $request->type;
        $product->product_type = $request->product_type;
        $product->image = $imagefile;
        $product->origin_id = $request->origin_id;
        $product->country_id = $request->country_id;
        $product->brand_id = $request->brand_id;
        $product->color = $request->color;
        //-------------specification tab---------------------
        $product->specs_names = $specs_names;
        $product->specs_name = $specs_name;
        $product->specs_desc = $specs_desc;
        //---------------attachments---------------------------
        $product->attachments = $attachments;
        $product->attachment_names = $attachment_names;
        //----------------prices----------------------------------
        $product->discount = $request->discount;
        $product->discountquantity = $request->discountquantity;
        //------------charts------------------
        $product->charts_description = $charts_description;
        $product->charts_names = $charts_names;
        $product->charts = $charts;
        $product->related_ids = $products_award;
        $product->maintenance = $request->maintenance;
        $product->hidden = (bool) $request->hidden;
        $product->save();
        //-------------------------------------------------------------------------------------------------------
        if ($request->products_in[0] !== null) {
            foreach ($request->products_in as $prod) {
                if ($prod != "") {
                    $partsproducts = new PartsProducts;
                    $partsproducts->part_id = $product->id;
                    $partsproducts->product_id = $prod;
                    $partsproducts->save();
                }
            }
        }

        if (isset($request->product_out_code)) {
            for ($i = 0; $i < count($request->product_out_code); $i++) {
                $product_out_code = $request->product_out_code[$i];
                $product_out_company = $request->product_out_company[$i];
                $product_out_wakel = $request->product_out_wakel[$i];

                $partsproductsout = new PartsProductsOut;
                $partsproductsout->part_id = $product->id;
                $partsproductsout->code = $product_out_code;
                $partsproductsout->company = $product_out_company;
                $partsproductsout->wakel = $product_out_wakel;

                if (isset($product_out_images[$i])) {
                    $partsproductsout->image = $product_out_images[$i];
                } else {
                    $partsproductsout->image = '';
                }

                $partsproductsout->save();
            }
        }

        //----------------------------------------------------------------------

        $addon = new PartsAddons;
        $addon->part_id = $product->id;
        //-------------units-----------------------------------
        $addon->units = $units;
        $addon->units_barcode = $units_barcode;
        $addon->units_cons = $units_cons;
        $addon->unit_default = $unit_default;
        //----------------prices----------------------------------
        $addon->prices = $prices;
        $addon->prices_discounts = $prices_discounts;
        $addon->prices_targets = $prices_targets;
        $addon->save();
        //-------------------------------------------------------------------------------------------------------

        $market = new PartsMarket;
        $market->part_id = $product->id;
        //----------market details-------------------------
        $market->supplier = $supplier;
        $market->date = $date;
        $market->sales_man = $sales_man;
        $market->phone = $phone;
        $market->price = $price;
        $market->employee = $employee;

        $market->save();
        //-------------------------------------------------------------------------------------------------------
        if ($request->submit_status == 1) {
            return redirect::back()->withFlashMessage(trans('admin.updated', ['name' => 'قطعه غيار']));
        } else {
            return redirect(route('parts.index'))->withFlashMessage(trans('admin.updated', ['name' => 'قطعه غيار']));
        }
    }

    public function update($id, Request $request)
    {
        $productimage = $request->file('image');
        if ($productimage && $productimage->isValid()) {
            $extension = $productimage->getClientOriginalExtension();
            $imagefile = 'product-' . time() . '.' . $extension;
            $productimage->move('public/uploads/parts-attachments', $imagefile);
        } else {
            $imagefile = $request->oldimage;
        }

        $filesedit = $request->attachments_edit;
        if ($filesedit && $filesedit != '') {
            $filenames = $request->attachments_edit;
        } else {
            $filenames = [];
        }

        $files = $request->file('attachments');
        if (isset($files) && count($files)) {
            foreach ($files as $key => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'product-' . $key . time() . '.' . $extension;
                    array_push($filenames, $filename);
                    $file->move('public/uploads/parts-attachments', $filename);
                }
            }
        }

        $old_outimage = $request->old_outimage;
        if ($old_outimage && $old_outimage != '') {
            $old_outimages = $request->old_outimage;
        } else {
            $old_outimages = [];
        }

        $files = $request->file('product_out-files');
        if (isset($files) && count($files)) {
            foreach ($files as $key => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'product-' . $key . time() . '.' . $extension;
                    array_push($old_outimages, $filename);
                    $file->move('public/uploads/products-parts-out', $filename);
                }
            }
        }

        $chartsedit = $request->charts_edit;
        if ($chartsedit && $chartsedit != '') {
            $chartsnames = $request->charts_edit;
        } else {
            $chartsnames = [];
        }
        $chartimages = $request->file('charts');
        if (isset($chartimages) && count($chartimages)) {
            foreach ($chartimages as $key => $chart) {
                if ($chart && $chart->isValid()) {
                    $extension = $chart->getClientOriginalExtension();
                    $filename = 'chart-' . $key . time() . '.' . $extension;
                    array_push($chartsnames, $filename);
                    $chart->move('parts-charts', $filename);
                }
            }
        }

        $attachments = implode(',', $filenames);
        $charts = implode(',', $chartsnames);

        //--------arrays----------
        $specs_names = implode(',', $request->specs_names);
        $specs_name = implode(',', $request->specs_name);
        $specs_desc = implode(',', $request->specs_desc);
        $attachment_names = implode(',', $request->attachment_names);
        $prices = implode(',', $request->prices);
        $prices_discounts = implode(',', $request->prices_discounts);
        $prices_targets = implode(',', $request->prices_targets);
        $units = implode(',', $request->units);
        $units_barcode = implode(',', $request->units_barcode);
        $units_cons = '';
        if (isset($request->units_cons)) {
            $units_cons = implode(',', $request->units_cons);
        }

        $unit_default = isset($request->unit_default[0]) ? $request->unit_default[0] : null;
        $charts_names = implode(',', $request->charts_names);
        $charts_description = implode(',', $request->charts_description);
        $supplier = implode(',', $request->supplier);
        $date = implode(',', $request->date);
        $sales_man = implode(',', $request->sales_man);
        $phone = implode(',', $request->phone);
        $price = implode(',', $request->price);
        $employee = implode(',', $request->employee);

        //partsadds
        if (isset($request->products_in)) {
            $products_in = implode(',', $request->products_in);
        } else {
            $products_in = null;
        }

        if (isset($request->parts_in)) {
            $parts_in = implode(',', $request->parts_in);
        } else {
            $parts_in = null;
        }

        $products_award = implode(',', $request->products_award);

        //-----------General Tab-------------------
        $product = Parts::findOrFail($id);
        $product->products_id = $products_in;
        $product->parts_id = $parts_in;
        $product->code = $request->code;
        $product->secret_num = $request->secret_num;

        $product->code_type = $request->code_type;
        $product->name = $request->name;
        $product->name_en = $request->name_en;
        $product->insurance = $request->insurance;
        $product->type = $request->type;
        $product->product_type = $request->product_type;
        $product->image = $imagefile;
        $product->origin_id = $request->origin_id;
        $product->country_id = $request->country_id;
        $product->brand_id = $request->brand_id;
        $product->color = $request->color;
        //-------------specification tab---------------------
        $product->specs_names = $specs_names;
        $product->specs_name = $specs_name;
        $product->specs_desc = $specs_desc;
        //---------------attachments---------------------------
        $product->attachments = $attachments;
        $product->attachment_names = $attachment_names;
        //----------------prices----------------------------------
        $product->discount = $request->discount;
        $product->discountquantity = $request->discountquantity;
        //------------charts------------------
        $product->charts_description = $charts_description;
        $product->charts_names = $charts_names;
        $product->charts = $charts;
        $product->related_ids = $products_award;
        $product->maintenance = $request->maintenance;
        $product->hidden = (bool) $request->hidden;
        $product->save();
        //-------------------------------------------------------------------------------------------------------

        $addon = PartsAddons::where('part_id', $id)->first();
        if (!$addon) {
            $addon = new PartsAddons;
        }
        $addon->part_id = $product->id;
        //-------------units-----------------------------------
        $addon->units = $units;
        $addon->units_barcode = $units_barcode;
        $addon->units_cons = $units_cons;
        $addon->unit_default = $unit_default;
        //----------------prices----------------------------------
        $addon->prices = $prices;
        $addon->prices_discounts = $prices_discounts;
        $addon->prices_targets = $prices_targets;
        $addon->save();
        //-------------------------------------------------------------------------------------------------------

        PartsProducts::where('part_id', $id)->delete();
        if ($request->products_in[0] !== null) {

            foreach ($request->products_in as $prod) {
                if ($prod != "") {
                    $partsproducts = new PartsProducts;
                    $partsproducts->part_id = $product->id;
                    $partsproducts->product_id = $prod;
                    $partsproducts->save();
                }
            }
        }

        $product_out_files = $request->file('product_out-files');
        $product_out_images = [];
        if (isset($product_out_files) && count($product_out_files)) {
            foreach ($product_out_files as $key => $product_out_file) {
                if ($product_out_file && $product_out_file->isValid()) {
                    $extension = $product_out_file->getClientOriginalExtension();
                    $filename = 'products-out-' . $key . time() . '.' . $extension;
                    array_push($product_out_images, $filename);
                    $product_out_file->move('public/uploads/products-parts-out', $filename);
                }
            }
        }

        PartsProductsOut::where('part_id', $id)->delete();
        if (isset($request->product_out_code)) {
            for ($i = 0; $i < count($request->product_out_code); $i++) {
                $product_out_code = $request->product_out_code[$i];
                $product_out_company = $request->product_out_company[$i];
                $product_out_wakel = $request->product_out_wakel[$i];

                $partsproductsout = new PartsProductsOut;
                $partsproductsout->part_id = $product->id;
                $partsproductsout->code = $product_out_code;
                $partsproductsout->company = $product_out_company;
                $partsproductsout->wakel = $product_out_wakel;

                if (isset($product_out_images[$i])) {
                    $partsproductsout->image = $product_out_images[$i];
                } else {
                    $partsproductsout->image = '';
                }

                $partsproductsout->save();
            }
        }

        //-----------------------------------

        $market = PartsMarket::where('part_id', $id)->first();
        if (!$market) {
            $market = new PartsMarket;
        }
        $market->part_id = $product->id;
        //----------market details-------------------------
        $market->supplier = $supplier;
        $market->date = $date;
        $market->sales_man = $sales_man;
        $market->phone = $phone;
        $market->price = $price;
        $market->employee = $employee;
        $market->save();
        if ($request->submit_status == 1) {
            return redirect::back()->withFlashMessage(trans('admin.updated', ['name' => 'قطعه غيار']));
        } else {
            return redirect(route('parts.index'))->withFlashMessage(trans('admin.created', ['name' => 'قطعه غيار']));
        }
    }

    public function destroy($id, Request $request)
    {

        Parts::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => 'قطعه غيار']);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('parts.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(Parts $data)
    {
        $parts = $data->all();
        return Datatables::of($parts)
            ->rawColumns(['action', 'select', 'status'])
            ->editColumn('select', function ($model) {
                return getSelectAjax($model);
            })

            ->editColumn('title', function ($model) {

                if (\Auth::user()->id == 9) {
                    return $model->code . '<br><span style="display:none">' . $model->secret_num . '</span>';
                } else {
                    return $model->code;
                }
            })
            ->editColumn('title_ar', function ($model) {

                return $model->name;
            })
            ->editColumn('title_en', function ($model) {

                return $model->name_en;
            })
            ->editColumn('image', function ($model) {

                return '<img style="width:150px" src="'.url('/').'/uploads/parts-attachments/' . $model->image . '" alt="' . $model->name . '">';
            })
            ->editColumn('company', function ($model) {
                if (isset($model->brand)) {
                    return '<img style="width:50px" src="'.url('/').'/uploads/brands_images/' . $model->brand->image . '" alt="' . $model->brand->name . '">';
                } else {
                    return "-";
                }
            })

            ->editColumn('action', function ($model) {
                $return = getAjaxAction($this->policy, $model, null, route('parts.edit', $model->id), route('parts.destroy', $model->id));
                $return .= '  <a href="' . route('parts.create') . '?part_id=' . $model->id . '" class="btn btn-primary btn-circle" target="_blank"><i class="fa fa-copy"></i></a> ';
                return $return;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function multiDelete(Request $request, Parts $data)
    {
        // if (!Auth::user()->can($this->policy . 'delete')) {
        //     if ($request->ajax()) {
        //         return Response::json(important_pages('ajax.403'));
        //     }
        //     return view(important_pages('403'));
        // }

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

    public function brands()
    {
        $brands = Brands::all();
        return $this->getView($this->viewPath . 'brands', $this->policy . 'create', ['brands' => $brands], 'create');
    }

    public function products($id)
    {
        $products = Products::where('brand_id', $id)->get();
        return $this->getView($this->viewPath . 'products', $this->policy . 'create', ['products' => $products], 'create');
    }

    public function showproduct($id)
    {
        $product = Products::find($id);
        return $this->getView($this->viewPath . 'showproduct', $this->policy . 'create', ['product' => $product], 'create');
    }

    public function imgproducts(Request $request)
    {
        $ids = explode(',', $request->ids);
        $productimage = $request->file('image');
        if ($productimage && $productimage->isValid()) {
            $extension = $productimage->getClientOriginalExtension();
            $imagefile = 'product-' . time() . '.' . $extension;
            $productimage->move('public/uploads/parts-attachments', $imagefile);
        }
        foreach ($ids as $id) {
            Parts::find($id)->update([
                'image' => $imagefile,
            ]);
        }
    }
}
