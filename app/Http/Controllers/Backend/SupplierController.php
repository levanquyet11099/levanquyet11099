<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Model\Supplier;
use App\Model\Category;

class SupplierController extends Controller
{
    public function __construct()
    {
        view()->share([
            'sup_menu' => 'active'
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
        $suppliers = Supplier::select('*');
        if ($request->s_code) {
            $suppliers = $suppliers->where('s_code', $request->s_code);
        }

        if ($request->s_name) {
            $suppliers = $suppliers->where('s_name','like','%'.$request->s_name.'%');
        }

        $suppliers = $suppliers->orderBy('id', 'DESC')->paginate(20);

        return view('backend.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        //
        if ($this->processCreateOrUpdate($request)) {
            return redirect()->route('get.list.suppliers')->with('success','[Success] Thêm mới thành công.');
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
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return redirect()->route('get.list.suppliers')->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }
        return view('backend.suppliers.update', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        //
        if ($this->processCreateOrUpdate($request, $id)) {
            return redirect()->route('get.list.suppliers')->with('success','[Success] Chỉnh sửa thành công.');
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
        $supplier = Supplier::findOrFail($id);
        if (!$supplier) {
            return redirect()->route('get.list.suppliers')->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }

        $categories = Category::where('c_supplier_id', $id)->count();
        if ($categories > 0) {
            return redirect()->route('get.list.suppliers')->with('danger', '[Error] Cần xóa loại hàng thuộc nhà cung cấp trước.');
        }
        
        try {
            $supplier->delete();
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
                Supplier::insert($data);
            } else {
                Supplier::find($id)->update($data);
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
