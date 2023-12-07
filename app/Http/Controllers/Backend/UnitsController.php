<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitsRequest;
use App\Model\Unit;
use App\Model\Product;

class UnitsController extends Controller
{
    public function __construct()
    {
        view()->share([
            'unit_menu' => 'active'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $units = Unit::orderBy('id', 'DESC')->paginate(20);
        return view('backend.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitsRequest $request)
    {
        //
        if ($this->processCreateOrUpdate($request)) {
            return redirect()->route('get.list.units')->with('success','[Success] Thêm mới thành công.');
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
        $unit = Unit::find($id);
        if (!$unit) {
            return redirect()->route('get.list.categories')->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }
        return view('backend.units.update', compact('unit'));
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
            return redirect()->route('get.list.units')->with('success','[Success] Chỉnh sửa thành công.');
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
        $unit = Unit::findOrFail($id);
        if (!$unit) {
            return redirect()->route('get.list.units')->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }

        $products = Product::where('p_unit_id', $id)->count();
        if ($products > 0) {
            return redirect()->route('get.list.units')->with('danger', '[Error] Cần xóa sản phẩm đang dùng đơn vị trước.');
        }

        try {
            $unit->delete();
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
                Unit::insert($data);
            } else {
                Unit::find($id)->update($data);
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
