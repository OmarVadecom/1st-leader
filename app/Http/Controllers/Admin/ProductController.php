<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use App\Imports\ProductImport;
use App\Models\AttachmentCat;
use App\Models\Brands;
use App\Models\Color;
use App\Models\Country;
use App\Models\Gifts;
use App\Models\Section;
use App\Models\ProductSection;
use App\Models\ProductAddons;
use App\Models\ProductCategory as cat;
use App\Models\ProductCategoryLang as category;
use App\Models\ProductMarket;
use App\Models\Products as Products;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Redirect;
use Response;
use View;

class ProductController extends MainController
{
    private $viewPath = 'admin.product.';
    private $policy = 'products.';
    public function __construct()
    {
        View::share('pageTitle', trans('admin.products'));
    }

    public function index(Request $req)
    {
        return $this->getView($this->viewPath . 'index', $this->policy . 'view');
    }

    public function create(category $cat, Request $request)
    {
        $product = null;
        $product_id = $request->get('product_id');
        if (isset($product_id) && $product_id != "") {
            $product = Products::findOrFail($product_id);
        }
        $cats = cat::where('status', 1)->get();
        $products = Products::all();
        $countries = Country::all();
        $brands = Brands::all();
        $colors = Color::all();
        $gifts = Gifts::all();
        $sections = Section::all();
        $attachcats = AttachmentCat::all();
        return $this->getView($this->viewPath . 'create', $this->policy . 'create', ['product' => $product, 'cats' => $cats, 'products' => $products, 'countries' => $countries, 'brands' => $brands, 'colors' => $colors, 'gifts' => $gifts, 'attachcats' => $attachcats, 'sections' => $sections], 'create');
    }

    public function edit($id, category $cat)
    {
        $product = Products::findOrFail($id);
        $cats = cat::where('status', 1)->get();
        $products = Products::all();
        $products = Products::all();
        $countries = Country::all();
        $brands = Brands::all();
        $colors = Color::all();
        $gifts = Gifts::all();
        $sections = Section::all();
        $attachcats = AttachmentCat::all();
        return $this->getView($this->viewPath . 'edit', $this->policy . 'update', ['product' => $product, 'cats' => $cats, 'products' => $products, 'countries' => $countries, 'brands' => $brands, 'colors' => $colors, 'gifts' => $gifts, 'attachcats' => $attachcats, 'sections' => $sections], 'edit');
    }

    public function show($id)
    {
        $product = products::findOrFail($id);
        $sections = Section::all();
        return $this->getView($this->viewPath . 'show', $this->policy . 'view', ['product' => $product, 'sections' => $sections], 'view');
    }

    public function store(Request $request)
    {
        //---------------------------------------------------
        // $prodgroup = array();
        // $prodquant = array();
        // $prodstate = array();
        // foreach ($request->product as $key => $prodgr) {
        //     if ($prodgr !== null) {
        //         array_push($prodgroup, $prodgr);
        //         array_push($prodquant, $request->quantity[$key]);
        //         if ($request->group_status[$key] == null) {
        //             array_push($prodstate, 0);

        //         } else {
        //             array_push($prodstate, 1);
        //         }
        //     }
        // }
        // $products = implode(',', $prodgroup);
        // $quantities = implode(',', $prodquant);
        // $status = implode(',', $prodstate);
        //--------------files--------------------
        if ($request->copyproduct == 1) {

            $spec_image = $request->file('main_desc_img');
            if ($spec_image && $spec_image->isValid()) {
                $extension = $spec_image->getClientOriginalExtension();
                $spec_image_name = 'specimg-' . time() . '.' . $extension;
                $spec_image->move('public/uploads/spec_images', $spec_image_name);
            } else {
                $spec_image_name = $request->old_main_desc_img;
            }


            $productimage = $request->file('image');
            if ($productimage && $productimage->isValid()) {
                $extension = $productimage->getClientOriginalExtension();
                $imagefile = 'product-' . time() . '.' . $extension;
                $productimage->move('public/uploads/products-attachments', $imagefile);
            } else {
                $imagefile = $request->oldimage;
            }

            $filenames = [];
            $img_desc = [];
            $attachment_names = $request->attachment_names;
            $attachment_links = $request->attachment_links;
            $attachment_status = $request->attachment_status;
            $title_description = $request->title_description;
            $old_img_description = $request->old_img_description;
            $descimages = $request->file('img_description');

            $files = $request->file('attachments');
            if (isset($request->counter) && count($request->counter) > 0) {
                foreach ($request->counter as $key => $count) {
                    if (!isset($request->file('attachments')[$key]) && $attachment_names[$key] == null  && $attachment_links[$key] == null) {
                        unset($attachment_links[$key]);
                        unset($attachment_names[$key]);
                        unset($attachment_status[$key]);
                    }
                    if (isset($files[$key])) {
                        $file = $files[$key];
                        if ($file && $file->isValid()) {
                            $extension = $file->getClientOriginalExtension();
                            $filename = 'product-' . $key . time() . '.' . $extension;
                            array_push($filenames, $filename);
                            $file->move('public/uploads/products-attachments', $filename);
                        }
                    } else {
                        if ($request->attachment_names[$key] != '' || $request->attachment_links[$key] != '') {
                            array_push($filenames, '');
                        }
                    }
                }
            }
            $filesedit = $request->attachments_edit;
            if ($filesedit && $filesedit != '') {
                $filenames = array_merge($filenames, $filesedit);
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
                        $chart->move('public/uploads/products-charts', $filename);
                    }
                }
            }
            foreach ($title_description as $key => $title_desc) {
                if (isset($descimages[$key]) && $descimages[$key]->isValid()) {
                    $dsimg = $descimages[$key];
                    $extension = $dsimg->getClientOriginalExtension();
                    $filename = 'dsimg-' . $key . time() . '.' . $extension;
                    array_push($img_desc, $filename);
                    $dsimg->move('public/uploads/products-desc-imgs', $filename);
                } else {
                    if (isset($old_img_description[$key])) {
                        array_push($img_desc, $old_img_description[$key]);
                    } else {
                        array_push($img_desc, '');
                    }
                }
            }
            $img_description = implode(',', $img_desc);
            $attachments = implode(',', $filenames);
            $charts = implode(',', $chartsnames);
        } else {
            $filename = '';
            $files = $request->file('attachments');
            $productimage = $request->file('image');
            $chartimages = $request->file('charts');
            $descimages = $request->file('img_description');
            $filenames = [];
            $charts = [];
            $img_desc = [];
            $spec_image_name = '';
            $spec_image = $request->file('main_desc_img');
            if ($spec_image && $spec_image->isValid()) {
                $extension = $spec_image->getClientOriginalExtension();
                $spec_image_name = 'specimg-' . time() . '.' . $extension;
                $spec_image->move('public/uploads/spec_images', $spec_image_name);
            }


            $imagefile = '';
            if ($productimage && $productimage->isValid()) {
                $extension = $productimage->getClientOriginalExtension();
                $imagefile = 'product-' . time() . '.' . $extension;
                $productimage->move('public/uploads/products-attachments', $imagefile);
            }
            $attachment_names = $request->attachment_names;
            $attachment_links = $request->attachment_links;
            $attachment_status = $request->attachment_status;

            $title_description = $request->title_description;

            if (isset($request->counter) && count($request->counter) > 0) {
                foreach ($request->counter as $key => $count) {
                    if (!isset($request->file('attachments')[$key]) && $attachment_names[$key] == null  && $attachment_links[$key] == null) {
                        unset($attachment_links[$key]);
                        unset($attachment_names[$key]);
                        unset($attachment_status[$key]);
                    }
                    if (isset($files[$key])) {
                        $file = $files[$key];
                        if ($file && $file->isValid()) {
                            $extension = $file->getClientOriginalExtension();
                            $filename = 'product-' . $key . time() . '.' . $extension;
                            array_push($filenames, $filename);
                            $file->move('public/uploads/products-attachments', $filename);
                        }
                    } else {
                        if ($request->attachment_names[$key] != '' || $request->attachment_links[$key] != '') {
                            array_push($filenames, '');
                        }
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
                        $chart->move('public/uploads/products-charts', $filename);
                    }
                }
            }
            $charts = implode(',', $charts);


            foreach ($title_description as $key => $title_desc) {
                if (isset($descimages[$key]) && $descimages[$key]->isValid()) {
                    $dsimg = $descimages[$key];
                    $extension = $dsimg->getClientOriginalExtension();
                    $filename = 'dsimg-' . $key . time() . '.' . $extension;
                    array_push($img_desc, $filename);
                    $dsimg->move('public/uploads/products-desc-imgs', $filename);
                } else {
                    array_push($img_desc, '');
                }
            }
            $img_description = implode(',', $img_desc);
        }

        //--------arrays----------
        $description = implode('%,%', $request->description);
        $title_description = implode('%,%', $title_description);

        $specs_names = implode(',', $request->specs_names);
        $specs_desc = implode(',', $request->specs_desc);
        $attachment_names = implode(',', $attachment_names);
        $attachment_links = implode(',', $attachment_links);
        $attachment_status = implode(',', $attachment_status);

        $prices = implode(',', $request->prices);
        $prices_discounts = implode(',', $request->prices_discounts);
        $prices_targets = implode(',', $request->prices_targets);
        $gifts_ids = implode(',', $request->gifts_ids);
        $gifts_quantities = implode(',', $request->gifts_quantities);
        $gifts_for = implode(',', $request->gifts_for);
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




        //-----------General Tab-------------------
        $product = new Products;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->secret_num = $request->secret_num;
        $product->name_en = $request->name_en;
        $product->insurance = $request->insurance;
        $product->type = $request->type;
        $product->product_type = $request->product_type;
        $product->category_id = $request->category_id;
        $product->image = $imagefile;
        $product->origin_id = $request->origin_id;
        $product->country_id = $request->country_id;
        $product->brand_id = $request->brand_id;
        $product->description = $description;
        $product->title_description = $title_description;
        $product->img_description = $img_description;
        $product->color = $request->color;
        $product->maintenance = $request->maintenance;
        $product->hidden = (bool) $request->hidden;

        //-------------specification tab---------------------
        $product->specs_names = $specs_names;
        $product->specs_desc = $specs_desc;
        $product->spec_main_img = $spec_image_name;

        //---------------attachments---------------------------
        $product->attachments = $attachments;
        $product->attachment_names = $attachment_names;
        $product->attachment_links = $attachment_links;
        $product->attachment_status = $attachment_status;

        //----------------prices----------------------------------
        $product->discount = $request->discount;
        $product->discountquantity = $request->discountquantity;
        //------------charts------------------
        $product->charts_description = $charts_description;
        $product->charts_names = $charts_names;
        $product->charts = $charts;
        $product->save();
        //-------------------------------------------------------------------------------------------------------

        $addon = new ProductAddons;
        $addon->product_id = $product->id;
        //-------------units-----------------------------------
        $addon->units = $units;
        $addon->units_barcode = $units_barcode;
        $addon->units_cons = $units_cons;
        $addon->unit_default = $unit_default;
        //----------------prices----------------------------------
        $addon->prices = $prices;
        $addon->prices_discounts = $prices_discounts;
        $addon->prices_targets = $prices_targets;
        //---------------gifts-------------------------------------
        $addon->gifts_ids = $gifts_ids;
        $addon->gifts_quantities = $gifts_quantities;
        $addon->gifts_for = $gifts_for;
        $addon->save();
        //-------------------------------------------------------------------------------------------------------
        if ($request->copyproduct == 1) {
            ProductSection::Where('product_id', $product->id)->delete();
        }
        foreach ($request->specs_names as $key => $specnm) {
            $productsection = new ProductSection;
            $productsection->product_id = $product->id;
            $productsection->section_id = $request->specs_sections[$key];
            $productsection->name = $specnm;
            $productsection->description = $request->specs_desc[$key];
            $productsection->save();
        }
        //----------------------------------------------
        $market = new ProductMarket;
        $market->product_id = $product->id;
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
            return redirect::back()->withFlashMessage(trans('admin.updated', ['name' => trans('admin.product')]));
        } else if ($request->submit_status == 2) {
            return redirect(route('product.show', $product->id))->withFlashMessage(trans('admin.updated', ['name' => trans('admin.product')]));
        } else {
            return redirect(route('product.index'))->withFlashMessage(trans('admin.created', ['name' => trans('admin.product')]));
        }
    }

    public function update($id, Request $request)
    {
        $spec_image = $request->file('main_desc_img');
        if ($spec_image && $spec_image->isValid()) {
            $extension = $spec_image->getClientOriginalExtension();
            $spec_image_name = 'specimg-' . time() . '.' . $extension;
            $spec_image->move('public/uploads/spec_images', $spec_image_name);
        } else {
            $spec_image_name = $request->old_main_desc_img;
        }

        $productimage = $request->file('image');
        if ($productimage && $productimage->isValid()) {
            $extension = $productimage->getClientOriginalExtension();
            $imagefile = 'product-' . time() . '.' . $extension;
            $productimage->move('public/uploads/products-attachments', $imagefile);
        } else {
            $imagefile = $request->oldimage;
        }

        $filenames = [];
        $img_desc = [];
        $title_description = $request->title_description;
        $attachment_names = $request->attachment_names;
        $attachment_links = $request->attachment_links;
        $attachment_status = $request->attachment_status;
        $descimages = $request->file('img_description');
        $old_img_description = $request->old_img_description;

        $files = $request->file('attachments');
        foreach ($request->counter as $key => $count) {
            if (!isset($request->file('attachments')[$key]) && $attachment_names[$key] == null  && $attachment_links[$key] == null) {
                unset($attachment_links[$key]);
                unset($attachment_names[$key]);
                unset($attachment_status[$key]);
            }
            if (isset($files[$key])) {
                $file = $files[$key];
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'product-' . $key . time() . '.' . $extension;
                    array_push($filenames, $filename);
                    $file->move('public/uploads/products-attachments', $filename);
                }
            } else {
                if ($request->attachment_names[$key] != '' || $request->attachment_links[$key] != '') {
                    array_push($filenames, '');
                }
            }
        }


        $filesedit = $request->attachments_edit;
        if ($filesedit && $filesedit != '') {
            $filenames = array_merge($filenames, $filesedit);
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
                    $chart->move('public/uploads/products-charts', $filename);
                }
            }
        }

        foreach ($title_description as $key => $title_desc) {
            if (isset($descimages[$key]) && $descimages[$key]->isValid()) {
                $dsimg = $descimages[$key];
                $extension = $dsimg->getClientOriginalExtension();
                $filename = 'dsimg-' . $key . time() . '.' . $extension;
                array_push($img_desc, $filename);
                $dsimg->move('public/uploads/products-desc-imgs', $filename);
            } else {
                if (isset($old_img_description[$key])) {
                    array_push($img_desc, $old_img_description[$key]);
                } else {
                    array_push($img_desc, '');
                }
            }
        }
        $img_description = implode(',', $img_desc);


        $attachments = implode(',', $filenames);

        $charts = implode(',', $chartsnames);
        //--------arrays----------
        $description = implode('%,%', $request->description);
        $title_description = implode('%,%', $title_description);
        $specs_names = '';
        $specs_desc = '';
        if (isset($request->specs_names)) {
            $specs_names = implode(',', $request->specs_names);
        }
        if (isset($request->specs_desc)) {
            $specs_desc = implode(',', $request->specs_desc);
        }
        $attachment_names = implode(',', $attachment_names);
        $attachment_links = implode(',', $attachment_links);
        $attachment_status = implode(',', $attachment_status);

        // dd(explode(',', $attachments));
        $prices = implode(',', $request->prices);
        $prices_discounts = implode(',', $request->prices_discounts);
        $prices_targets = implode(',', $request->prices_targets);
        $gifts_ids = implode(',', $request->gifts_ids);
        $gifts_quantities = implode(',', $request->gifts_quantities);
        $gifts_for = implode(',', $request->gifts_for);
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

        //-----------General Tab-------------------
        $product = Products::findOrFail($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->secret_num = $request->secret_num;
        $product->name_en = $request->name_en;
        $product->insurance = $request->insurance;
        $product->type = $request->type;
        $product->product_type = $request->product_type;
        $product->category_id = $request->category_id;
        $product->image = $imagefile;
        $product->origin_id = $request->origin_id;
        $product->country_id = $request->country_id;
        $product->brand_id = $request->brand_id;
        $product->description = $description;
        $product->title_description = $title_description;
        $product->img_description = $img_description;
        $product->color = $request->color;
        $product->maintenance = $request->maintenance;
        $product->hidden = (bool) $request->hidden;
        //-------------specification tab---------------------
        $product->specs_names = $specs_names;
        $product->specs_desc = $specs_desc;
        $product->spec_main_img = $spec_image_name;
        //---------------attachments---------------------------
        $product->attachments = $attachments;
        $product->attachment_names = $attachment_names;
        $product->attachment_links = $attachment_links;
        $product->attachment_status = $attachment_status;

        //----------------prices----------------------------------
        $product->discount = $request->discount;
        $product->discountquantity = $request->discountquantity;
        //------------charts------------------
        $product->charts_description = $charts_description;
        $product->charts_names = $charts_names;
        $product->charts = $charts;
        $product->save();
        //-------------------------------------------------------------------------------------------------------
        ProductSection::Where('product_id', $product->id)->delete();
        if (isset($request->specs_names)) {
            foreach ($request->specs_names as $key => $specnm) {
                $productsection = new ProductSection;
                $productsection->product_id = $product->id;
                $productsection->section_id = $request->specs_sections[$key];
                $productsection->name = $specnm;
                $productsection->description = $request->specs_desc[$key];
                $productsection->save();
            }
        }
        $addon = ProductAddons::where('product_id', $id)->first();
        if (!$addon) {
            $addon = new ProductAddons;
        }
        $addon->product_id = $product->id;
        //-------------units-----------------------------------
        $addon->units = $units;
        $addon->units_barcode = $units_barcode;
        $addon->units_cons = $units_cons;
        $addon->unit_default = $unit_default;
        //----------------prices----------------------------------
        $addon->prices = $prices;
        $addon->prices_discounts = $prices_discounts;
        $addon->prices_targets = $prices_targets;
        //---------------gifts-------------------------------------
        $addon->gifts_ids = $gifts_ids;
        $addon->gifts_quantities = $gifts_quantities;
        $addon->gifts_for = $gifts_for;
        $addon->save();
        //-------------------------------------------------------------------------------------------------------

        $market = ProductMarket::where('product_id', $id)->first();
        if (!$market) {
            $market = new ProductMarket;
        }
        $market->product_id = $product->id;
        //----------market details-------------------------
        $market->supplier = $supplier;
        $market->date = $date;
        $market->sales_man = $sales_man;
        $market->phone = $phone;
        $market->price = $price;
        $market->employee = $employee;
        $market->save();
        if ($request->submit_status == 1) {
            return redirect::back()->withFlashMessage(trans('admin.updated', ['name' => trans('admin.product')]));
        } else if ($request->submit_status == 2) {
            return redirect(route('product.show', $product->id))->withFlashMessage(trans('admin.updated', ['name' => trans('admin.product')]));
        } else {
            return redirect(route('product.index'))->withFlashMessage(trans('admin.created', ['name' => trans('admin.product')]));
        }
    }

    public function destroy($id, Request $request)
    {
        if (!Auth::user()->can($this->policy . 'create')) {
            if ($request->ajax()) {
                return Response::json(important_pages('ajax.403'));
            }
            return view(important_pages('403'));
        }

        Products::findOrFail($id)->delete();
        $delMessage = trans('admin.deleted', ['name' => trans('admin.product')]);
        if ($request->ajax()) {
            return Response::json($delMessage);
        }
        return redirect(route('product.index'))->withFlashMessage($delMessage);
    }

    /*
     * Ajax
     */
    public function AjaxLoad(Products $data)
    {
        $products = $data->all();
        return Datatables::of($products)
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

                return '<img style="width:150px" src="' . url('/') . '/uploads/products-attachments/' . $model->image . '" alt="' . $model->name . '">';
            })
            ->editColumn('company', function ($model) {
                if (isset($model->brand)) {
                    return '<img style="width:50px" src="'.url('/').'/uploads/brands_images/' . $model->brand->image . '" alt="' . $model->brand->name . '">';
                } else {
                    return "-";
                }
            })

            ->editColumn('action', function ($model) {
                $return = getAjaxAction($this->policy, $model, route('product.show', $model->id), route('product.edit', $model->id), route('product.destroy', $model->id));
                $return .= '  <a href="' . route('product.create') . '?product_id=' . $model->id . '" class="btn btn-primary btn-circle" target="_blank"><i class="fa fa-copy"></i></a> ';
                return $return;
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function multiDelete(Request $request, Products $data)
    {
        // if (!Auth::user()->can($this->policy . 'create')) {
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
        return view('errors.404');
    }

    public function getpurchase()
    {
        $products = Products::all();
        foreach ($products as $pro) {
            $quantity = DB::table('purchases')->where('product_id', $pro->id)->first();
            if (isset($quantity)) {
                $pro->purchase = $quantity->quantity;
            } else {
                $pro->purchase = null;
            }
        }
        return $this->getView($this->viewPath . 'purchases', $this->policy . 'view', ['products' => $products], 'view');
    }

    public function postpurchase(Request $request)
    {
        if ($request->qunatityrad == 'default') {
            $product = Products::findOrFail($request->product);
            $product->quantity = $request->quantity;
            $product->save();
        } else {
            DB::table('purchases')->insert([
                ['product_id' => $request->product, 'quantity' => $request->quantity],
            ]);
        }
        return Redirect::back()->withFlashMessage('تم اضافه الكميه بنجاح');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('excel');
        $request->validate([
            'excel' => 'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp',
        ]);
        Excel::import(new ProductImport, $file);
        session()->flash('msg', 'تم رفع الملف بنجاح');
        return Redirect::back();
    }

    public function imgproducts(Request $request)
    {
        $ids = explode(',', $request->ids);
        $productimage = $request->file('image');
        if ($productimage && $productimage->isValid()) {
            $extension = $productimage->getClientOriginalExtension();
            $imagefile = 'product-' . time() . '.' . $extension;
            $productimage->move('public/uploads/products-attachments', $imagefile);
        }
        foreach ($ids as $id) {
            Products::find($id)->update([
                'image' => $imagefile,
            ]);
        }
    }
}
