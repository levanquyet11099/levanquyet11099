<?php

namespace App\Http\Controllers\Backend;

use App\Model\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Unit;
use App\Model\Product;
use App\Http\Requests\ProductRequest;
use App\Helpers\HelpersFun;

class ProductController extends Controller
{
    public function __construct()
    {
        $categories = Category::where('c_active', Category::STATUS_ACTIVE)->get();
        $units = Unit::all();

        view()->share([
            'categories' => $categories,
            'units' => $units,
            'pro_menu' => 'active'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::with(['category', 'user', 'unit']);

        if ($request->p_code) {
            $products = $products->where('p_code', $request->p_code);
        }

        if ($request->p_name) {
            $products = $products->where('p_name','like','%'.$request->p_name.'%');
        }

        if ($request->p_category_id) {
            $products = $products->where('p_category_id', $request->p_category_id);
        }

        if ($request->p_unit_id) {
            $products = $products->where('p_unit_id', $request->p_unit_id);
        }

        if ($request->p_status) {
            $products = $products->where('p_status', $request->p_status);
        }

        $products = $products->orderBy('id', 'DESC')->paginate(20);
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        if ($this->processCreateOrUpdate($request)) {
            return redirect()->route('get.list.products')->with('success','[Success] Thêm mới thành công.');
        }

        return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể lưu dữ liệu.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('get.list.suppliers')->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }
        return view('backend.products.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //
        if ($this->processCreateOrUpdate($request, $id)) {
            return redirect()->route('get.list.products')->with('success','[Success] Chỉnh sửa thành công.');
        }
        return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể lưu dữ liệu.');
    }

    /**
     * Remove the specified resource from storage.s
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $product = Product::findOrFail($id);
        if (!$product) {
            return redirect()->route('get.list.suppliers')->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }
        try {
            $this->deleteImageProduct($product);
            $product->delete();

            return redirect()->back()->with('success','[Success] Xóa thành công.');
        } catch (\Exception $exception) {
            \Log::error($exception);
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }
    }

    /**
     * @param $request
     * @param null $id
     * @return bool
     */
    public function processCreateOrUpdate($request, $id = NULL)
    {
        $data = $request->except('_token', 'images');

        if ($id !== NULL ) {
            $product = Product::find($id);
        }

        if($request->hasFile('images')) {
            if (isset($product)) {
                $this->deleteImageProduct($product);
            }
            $image = $request->file('images');
            $nameimg = HelpersFun::getNameImage($image, 'products');
            $data['p_images'] = $nameimg;
        }
        $data['p_user_id'] = \Auth::user()->id;
        $data['updated_at'] = now();

        \DB::beginTransaction();
        try {
            if ($id === NULL) {
                $data['created_at'] = now();
                Product::insert($data);
            } else {
                $product->update($data);
            }
            \DB::commit();
            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return false;
        }
    }

    public function deleteImageProduct($product)
    {
        HelpersFun::deleteImage('uploads/products/' . $product->p_images);
    }
}
