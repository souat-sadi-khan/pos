<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Products\Box;
use App\Models\Products\Brand;
use App\Models\Products\Category;
use App\Models\Products\Product;
use App\Models\Products\TaxRate;
use App\Models\Products\Unit;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\ProductVariation;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['show'])) {
            if($_GET['show'] == 'list') {
                $product_sidebar = 'list';
            } elseif($_GET['show'] == 'create') {
                $product_sidebar = 'create';
            } else {
                $product_sidebar = 'list';
            }
        } else {
            $product_sidebar = 'list';
        }
        return view('admin.product.product.index', compact('product_sidebar'));
    }

    // add_category
    public function add_category() {
        return view('admin.product.product.add_category');
    }

    // save_category
    public function save_category(Request $request) {
        $request->validate([
            'category_image' => 'mimes:jpeg,bmp,png,jpg|max:500',
            'category_name' => 'required',
        ]);

        $slug = $this->slug(make_slug($request->category_name));

        $model = new Category;
        $model->category_name = $request->category_name;
        $model->category_slug = $slug;
        $model->parent_id = $request->parent_id;
        $model->status = $request->status;
        $model->category_details = $request->category_details;

        if($request->hasFile('category_image')) {

            $data = getimagesize($request->file('category_image'));
            $width = $data[0];
            $height = $data[0];

            if($width > 110 && $height > 110) {
                return response()->json(['status' => 'danger', 'message' => 'Category Image Width and height is wrong']);
            }

            $storagepath = $request->file('category_image')->store('public/images/product/category');
            $fileName = basename($storagepath);

            $model->category_image = $fileName;
        }

        $model->save();

        \SadikLog::addToLog('Created a Category - ' . $request->category_name .'.');

        return response()->json(['status' => 'success', 'id' => $model->id, 'text' => $model->category_name, 'message' => 'New Category is stored successfully']);

    }

    // make_slug
    public function slug($old_slug, $row = Null)
    {
        if(!$row){
            $slug = $old_slug;
            $row = 0;
        }else{
            $slug = $old_slug . '-'.$row;
        }

        $check_res = Category::where('category_slug', $slug)->first();
        if($check_res) {
            $slug = $this->slug($old_slug, $row+1);
        }

        return $slug;
    }

    // add_supplier
    public function add_supplier() {
        return view('admin.product.product.add_supplier');
    }

    // save_supplier
    public function save_supplier(Request $request) {
        $request->validate([
            'sup_name' => 'required',
            'code_name' => 'required',
            'sup_mobile' => 'required',
            'status' => 'required',
        ]);

        $model = new Supplier;
        $model->sup_name = $request->sup_name;
        $model->code_name = $request->code_name;
        $model->sup_mobile = $request->sup_mobile;
        $model->sup_email = $request->sup_email;
        $model->sup_address = $request->sup_address;
        $model->sup_city = $request->sup_city;
        $model->sup_state = $request->sup_state;
        $model->sup_country = $request->sup_country;
        $model->sup_details = $request->sup_details;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Created a Suppler - ' . $request->sup_name .'.');

        return response()->json(['status' => 'success', 'id' => $model->id, 'text' => $model->sup_name, 'message' => 'New Supplier is stored successfully']);

    }

    // add_brand
    public function add_brand() {
        return view('admin.product.product.add_brand');
    }

    // save_brand
    public function save_brand(Request $request) {
        $request->validate([
            'brand_name' => 'required',
            'status' => 'required',
        ]);

        $slug = $this->slug(make_slug($request->brand_name));

        $model = new Brand;
        $model->brand_name = $request->brand_name;
        $model->brand_slug = $slug;
        $model->brand_code_name = $request->brand_code_name;
        $model->brand_details = $request->brand_details;
        $model->status = $request->status;

        if($request->hasFile('brand_image')) {

            $data = getimagesize($request->file('brand_image'));
            $width = $data[0];
            $height = $data[0];

            if($width > 110 && $height > 110) {
                return response()->json(['success' => true, 'status' => 'danger', 'message' => 'Brand Image Width and height is wrong']);
            }

            $storagepath = $request->file('brand_image')->store('public/images/product/brand');
            $fileName = basename($storagepath);

            $model->brand_image = $fileName;
        }

        $model->save();

        \SadikLog::addToLog('Created a Category - ' . $request->brand_name .'.');

        return response()->json(['status' => 'success', 'id' => $model->id, 'text' => $model->brand_name, 'message' => 'New Brand is stored successfully']);

    }

    // add_box
    public function add_box() {
        return view('admin.product.product.add_box');
    }

    // save_box
    public function save_box(Request $request) {
        $request->validate([
            'box_name' => 'required',
            'status' => 'required',
        ]);

        $model = new Box;
        $model->box_name = $request->box_name;
        $model->box_code_name = $request->box_code_name;
        $model->status = $request->status;
        $model->box_details = $request->box_details;
        $model->save();

        \SadikLog::addToLog('Created a Product Box - ' . $request->box_name .'.');

        return response()->json(['status' => 'success', 'id' => $model->id, 'text' => $model->box_name, 'message' => 'New Box is stored successfully']);

    }

    // add_unit
    public function add_unit() {
        return view('admin.product.product.add_unit');
    }

    // save_unit
    public function save_unit(Request $request) {
        $request->validate([
            'unit_name' => 'required',
            'status' => 'required',
        ]);

        $model = new Unit;
        $model->unit_name = $request->unit_name;
        $model->unit_code_name = $request->unit_code_name;
        $model->unit_details = $request->unit_details;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Created a Unit - ' . $request->unit_name .'.');

        return response()->json(['status' => 'success', 'id' => $model->id, 'text' => $model->unit_name, 'message' => 'New Unit is stored successfully']);
    }

    // add_tax
    public function add_tax() {
        return view('admin.product.product.add_tax');
    }

    // tax_id
    public function save_tax(Request $request) {
        $request->validate([
            'tax_name' => 'required',
            'tax_rate' => 'required|numeric',
            'tax_rules' => 'required',
            'status' => 'required',
        ]);

        $model = new TaxRate;
        $model->tax_name = strtoupper($request->tax_name);
        $model->tax_code_name = $request->tax_code_name;
        $model->tax_rate = $request->tax_rate;
        $model->tax_rules = $request->tax_rules;
        $model->status = $request->status;
        $model->save();

        \SadikLog::addToLog('Created a Tax - ' . $request->tax_name .'.');
        
        $icon = ($request->tax_rules == 'mod' ? '%' : '+');
        $tax = $request->tax_name . '('.$request->tax_rate.' '.$icon.' )';

        return response()->json(['status' => 'success', 'id' => $model->id, 'text' => $tax, 'message' => 'New Tax is stored successfully']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable() {
        if (request()->ajax()) {
            $ips = Product::all();

			return DataTables::of($ips)
                ->addIndexColumn()
                ->editColumn('image', function($model){
                    return ($model->product_image != '' ? '<img src="'. asset('storage/images/product/product'. '/'. $model->product_image) .'" alter="Product Image" style="width:50px;">' :  '<img src="'. asset("images/product.jpg").'" alter="Product Image" style="width:50px;">');
                })
                ->editColumn('supplier', function($model){
                    return ($model->supplier_id != 0 ? $model->supplier->sup_name : 'No Supplier');
                })
                ->editColumn('status', function($model){
                    if($model->status == 1) {
                        return '<span class="badge badge-primary">Active</span>';
                    } else {
                        return '<span class="badge badge-warning">Inactive</span>';
                    }
                })
                ->addColumn('action', function($model){
                    return view('admin.product.product.action', compact('model'));
                })
                ->addColumn('delete', function($model){
                    return view('admin.product.product.delete', compact('model'));
                })
				->rawColumns(['supplier', 'image', 'status', 'action', 'delete'])->make(true);
		}
    }

    // product_slug
    public function product_slug($old_slug, $row = Null)
    {
        if(!$row){
            $slug = $old_slug;
            $row = 0;
        }else{
            $slug = $old_slug . '-'.$row;
        }

        $check_res = Product::where('product_slug', $slug)->first();
        if($check_res) {
            $slug = $this->slug($old_slug, $row+1);
        }

        return $slug;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_image' => 'mimes:jpeg,bmp,png,jpg|max:500',
            'status' => 'required',
            'product_type' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'product_cost' => 'required',
            'product_price' => 'required',
            'product_alert' => 'required',
            'product_variations' => 'required',
        ]);

        $slug = $this->slug(make_slug($request->product_name));

        $model = new Product;
        $model->status = $request->status;
        $model->product_type = $request->product_type;
        $model->product_name = $request->product_name;
        $model->product_slug = $slug;
        $model->product_code = $request->product_code;
        if(intval($request->product_category_id) != 0) {
            $model->category_id = intval($request->product_category_id);
        }

        if(intval($request->supplier_id) != 0) {
            $model->supplier_id = $request->supplier_id;
        }

        if(intval($request->brand_id) != 0) {
            $model->brand_id = $request->brand_id;
        }

        $model->barcode_symbiology = $request->barcode_symbiology;

        if(intval($request->box_id) != 0) {
            $model->box_id = $request->box_id;
        }

        if(intval($request->unit_id) != 0) {
            $model->unit_id = $request->unit_id;
        }

        // check product_variations
        if($request->product_variations == 0) {
            $model->product_cost = $request->product_cost;
            $model->product_price = $request->product_price;

            $product_main_price = $request->product_price;
            if($request->tax_id != '0') {
                $tax = TaxRate::where('id', $request->tax_id)->first();
                $tax_rules = $tax->tax_rules;
                $tax_price = $tax->tax_rate;

                if($tax_rules == 'plus') {
                    $product_sell_price = $product_main_price + $tax_price;
                } else {
                    $product_vat = ($product_main_price * $tax_price) / 100;
                    $product_sell_price = $product_main_price + $product_vat;
                }
            } else {
                $product_sell_price = $product_main_price;
            }

            $model->product_price_inc_tax = $product_sell_price;

        } else {
            $color_array = $request->color;
            $size_array = $request->size;
            $product_cost_array = $request->product_cost;
            $product_price_array = $request->product_price;
        }

        $model->product_variations = $request->product_variations;
        
        if(intval($request->tax_id) != 0) {
            $model->tax_id = $request->tax_id;
        }

        $model->tax_method = $request->tax_method;
        $model->product_alert = $request->product_alert;
        $model->hsn_code = $request->hsn_code;
        $model->product_details = $request->product_details;

        if($request->hasFile('product_image')) {

            $data = getimagesize($request->file('product_image'));
            $width = $data[0];
            $height = $data[0];

            if($width > 1900 && $height > 1900) {
                return response()->json(['success' => true, 'status' => 'danger', 'message' => 'Category Image Width and height is wrong']);
            }

            $storagepath = $request->file('product_image')->store('public/images/product/product');
            $fileName = basename($storagepath);

            $model->product_image = $fileName;
        }

        $model->save();

        if($request->product_variations == 1) {
            for($i = 0; $i < count($color_array); $i++) {
                
                $color = $color_array[$i];
                $size = $size_array[$i];
                $product_cost = $product_cost_array[$i];
                $product_price = $product_price_array[$i];
    
                $item = new ProductVariation;
                $item->product_id = $model->id;
                if($color != 0) {
                    $item->color_id = $color;
                }
                if($size != 0) {
                    $item->size_id = $size;
                }
                $item->product_cost = $product_cost;
                $item->product_price = $product_price;

                $product_main_price = $product_price;
                if($request->tax_id != '0') {
                    $tax = TaxRate::where('id', $request->tax_id)->first();
                    $tax_rules = $tax->tax_rules;
                    $tax_price = $tax->tax_rate;

                    if($tax_rules == 'plus') {
                        $product_sell_price = $product_main_price + $tax_price;
                    } else {
                        $product_vat = ($product_main_price * $tax_price) / 100;
                        $product_sell_price = $product_main_price + $product_vat;
                    }
                } else {
                    $product_sell_price = $product_main_price;
                }

                $item->product_price_inc_tax = $product_sell_price;

                $item->save();
    
            }
        } else {
            $item = new ProductVariation;
            $item->product_id = $model->id;
            $item->product_cost = $request->product_cost;
            $item->product_price = $request->product_price;

            $product_main_price = $request->product_price;
            if($request->tax_id != '0') {
                $tax = TaxRate::where('id', $request->tax_id)->first();
                $tax_rules = $tax->tax_rules;
                $tax_price = $tax->tax_rate;

                if($tax_rules == 'plus') {
                    $product_sell_price = $product_main_price + $tax_price;
                } else {
                    $product_vat = ($product_main_price * $tax_price) / 100;
                    $product_sell_price = $product_main_price + $product_vat;
                }
            } else {
                $product_sell_price = $product_main_price;
            }

            $item->product_price_inc_tax = $product_sell_price;

            $item->save();
        }


        \SadikLog::addToLog('Created a Product - ' . $request->product_name .'.');

        return response()->json(['status' => 'success', 'product' => true, 'message' => 'New Product is stored successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Product::findOrFail($id);
        $product_sidebar = 'list';
        return view('admin.product.product.show', compact('model', 'product_sidebar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Product::findOrFail($id);
        return view('admin.product.product.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Product::findOrFail($id);
        $model->delete();

        $query = ProductVariation::where('product_id', $model->id)->get();
        if(count($query)) {
            foreach($query as $item) {
                $item->delete();
            }
        }

        \SadikLog::addToLog('Deleted a Product - ' . $model->product_name .'.');

        return response()->json(['status' => 'success', 'message' => 'Product is deleted successfully']);
    }

    // import_product_show
    public function import_product_show() {
        return view('admin.product.product.import');
    }

    // import_product_upload
    public function import_product_upload(Request $request) {
        if($request->hasFile('import_file')) {

            $data = getimagesize($request->file('import_file'));

            $storagepath = $request->file('import_file')->store('public/files');
            $fileName = basename($storagepath);

            // Excel::import(new ProductsImport, file_get_contents(asset('storage/files'.'/'.$fileName)) );

        } else {
            dd('world');
        }
    }

    // add_variations
    public function add_variations() {
        return view('admin.product.product.variation.add_variation');
    }

    // add_one_more_row
    public function add_one_more_row(Request $request) {
        $row = $request->row;
        return view('admin.product.product.variation.add_one_more_row', compact('row'));
    }

    // delete_multiple_item
    public function delete_multiple_item(Request $request) {
        $data = $request->data;
        if(count($data) > 0) {
            for($i = 0; $i < count($data); $i++) {
                $id = $data[$i];
                $model = Product::where('id', $id)->first();
                if($model) {
                    $model->delete();
                    $query = ProductVariation::where('product_id', $id)->get();
                    if($query) {
                        foreach($query as $item) {
                            $item->delete();
                        }
                    }
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Sorry. Product Not Found']);
                }                
            }

            return response()->json(['status' => 'success', 'message' => 'Products is deleted Successfully']);

        } else {
            return response()->json(['status' => 'error', 'message' => 'Sorry. None of the Item is Selected']);
        }
    }

    // stock_alert 
    public function stock_alert () {
        return view('admin.product.stock-alert');
    }

    // stock_datatable
    public function stock_datatable() {
        if (request()->ajax()) {
            $models = Product::where('product_variations', 0)->where('product_alert', '>=', 'stock')->get() ;
            dd($models);
			return DataTables::of($models)
                ->addIndexColumn()
                ->editColumn('product_name', function($model){
                    return substr($model->product_name, 0, 20) . ''. (strlen($model->product_name) > 20 ? '...' : '');
                })
                ->editColumn('supplier_name', function($model){
                    return ($model->supplier_id != 0 || $model->supplier_id != null ? $model->supplier->sup_name : 'No Supplier');
                })
                ->editColumn('supplier_phone', function($model){
                    return ($model->supplier_id != 0 || $model->supplier_id != null ? $model->supplier->sup_mobile : '-');
                })
                ->editColumn('price', function($model){
                    return get_option('currency_symbol') . ' '. $model->product_cost;
                })
                ->editColumn('action', function($model){
                    return 0;
                })
				->rawColumns(['product_name', 'supplier_name', 'supplier_phone', 'price', 'action'])->make(true);
		}
    }
}
