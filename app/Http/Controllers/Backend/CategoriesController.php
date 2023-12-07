<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Supplier;
use App\Model\Category;
use App\Http\Requests\CategoryRequest;
use App\Model\Product;


class CategoriesController extends Controller
{
    public function __construct()
    {
        $suppliers = Supplier::select('id', 's_name')->get();
        view()->share([
            'suppliers' => $suppliers,
            'c_menu' => 'active'
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
        $categories = Category::with('supplier');

        if ($request->c_code) {
            $categories = $categories->where('c_code', $request->c_code);
        }

        if ($request->c_name) {
            $categories = $categories->where('c_name','like','%'.$request->c_name.'%');
        }

        $categories = $categories->orderBy('id', 'DESC')->paginate(20);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //
        if ($this->processCreateOrUpdate($request)) {
            return redirect()->route('get.list.categories')->with('success','[Success] Thêm mới thành công.');
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
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('get.list.categories')->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }
        return view('backend.categories.update', compact('category'));
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
        if ($this->processCreateOrUpdate($request, $id)) {
            return redirect()->route('get.list.categories')->with('success','[Success] Chỉnh sửa thành công.');
        }
        return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể lưu dữ liệu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $category = Category::findOrFail($id);
        
        if (!$category) {
            return redirect()->route('get.list.categories')->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }

        $products = Product::where('p_category_id', $id)->count();
        if ($products > 0) {
            return redirect()->route('get.list.categories')->with('danger', '[Error] Cần xóa sản phẩm đang thuộc loại hàng trước.');
        }

        try {
            $category->delete();
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
        $data = $request->except('_token');
        $data['updated_at'] = now();

        \DB::beginTransaction();
        try {
            if ($id === NULL) {
                $data['created_at'] = now();
                Category::insert($data);
            } else {
                Category::find($id)->update($data);
            }
            \DB::commit();
            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return false;
        }
    }
}
