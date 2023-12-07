<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehousingRequest;
use App\Http\Requests\CheckInputFileRequest;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Warehousing;
use App\Model\ProductWarehousing;

class GoodsIssueController extends Controller
{
    public function __construct()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        view()->share([
            'import_menu' => 'active',
            'products' => $products,
            'suppliers' => $suppliers
        ]);
    }

    /**
     * @param Request $request
     * @return View\View
     */
    public function index(Request $request)
    {
        $warehousings = Warehousing::with('user');

        if ($request->w_code) {
            $warehousings = $warehousings->where('w_code', $request->w_code);
        }

        if ($request->w_name) {
            $warehousings = $warehousings->where('w_name', $request->w_name);
        }

        $warehousings = $warehousings->where('w_type', 1)->orderBy('id', 'DESC')->paginate(20);
        return view('backend.goods_issue.index', compact('warehousings'));
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('backend.goods_issue.create');
    }

    /**
     * @param WarehousingRequest $request
     */
    public function store(WarehousingRequest $request)
    {
        \DB::beginTransaction();
        try {
            $dataWarehousing = [
                'pw_user_id' => \Auth::user()->id,
                'w_code' => $request->w_code,
                'w_name' => $request->w_name,
                'w_note' => $request->w_note,
                'w_type' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $id = Warehousing::insertGetId($dataWarehousing);

            $productId = $request->pw_product_id;
            $supplierId = $request->pw_supplier_id;
            $totalNumber = $request->pw_total_number;
            $activePrice = $request->pw_active_price;
            $customPrice = $request->pw_custom_price;
            $manufacturingDate = $request->pw_manufacturing_date;
            $expiryDate = $request->pw_expiry_date;
            $totalPrice = $request->pw_total_price;

            foreach ($productId as $key => $prId) {
                $dataProduct = [
                    'pw_product_id' => $prId,
                    'pw_warehousing_id' => $id,
                    'pw_supplier_id' => $supplierId[$key],
                    'pw_total_number' => $totalNumber[$key],
                    'pw_active_price' => $activePrice[$key],
                    'pw_custom_price' => isset($customPrice[$key]) ? $customPrice[$key] : NULL,
                    'pw_manufacturing_date' => $manufacturingDate[$key],
                    'pw_expiry_date' => $expiryDate[$key],
                    'pw_total_price' => isset($totalPrice[$key]) ? $totalPrice[$key] : NULL,
                    'pw_type' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                ProductWarehousing::insert($dataProduct);
            }

            \DB::commit();
            return redirect()->route('get.list.goods_issue.products')->with('success','[Success] Thêm mới thành công.');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể lưu dữ liệu.');
        }
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id)
    {
        $warehousing = Warehousing::with('warehousingProduct')->where('id', $id)->first();
        if (!$warehousing) {
            return redirect()->route('get.list.import.products')->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }

        return view('backend.goods_issue.update', compact('warehousing'));
    }

    /**
     * @param WarehousingRequest $request
     * @param $id
     */
    public function update(WarehousingRequest $request, $id)
    {
        $warehousing = Warehousing::find($id);
        \DB::beginTransaction();
        try {
            $dataWarehousing = [
                'pw_user_id' => \Auth::user()->id,
                'w_code' => $request->w_code,
                'w_name' => $request->w_name,
                'w_note' => $request->w_note,
                'w_type' => 1,
                'updated_at' => now(),
            ];
            $warehousing->update($dataWarehousing);

            $productId = $request->pw_product_id;
            $supplierId = $request->pw_supplier_id;
            $totalNumber = $request->pw_total_number;
            $activePrice = $request->pw_active_price;
            $customPrice = $request->pw_custom_price;
            $manufacturingDate = $request->pw_manufacturing_date;
            $expiryDate = $request->pw_expiry_date;
            $totalPrice = $request->pw_total_price;

            ProductWarehousing::where('pw_warehousing_id', $id)->delete();

            foreach ($productId as $key => $prId) {
                $dataProduct = [
                    'pw_product_id' => $prId,
                    'pw_warehousing_id' => $id,
                    'pw_supplier_id' => $supplierId[$key],
                    'pw_total_number' => $totalNumber[$key],
                    'pw_active_price' => $activePrice[$key],
                    'pw_custom_price' => isset($customPrice[$key]) ? $customPrice[$key] : NULL,
                    'pw_manufacturing_date' => $manufacturingDate[$key],
                    'pw_expiry_date' => $expiryDate[$key],
                    'pw_total_price' => isset($totalPrice[$key]) ? $totalPrice[$key] : NULL,
                    'pw_type' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                ProductWarehousing::insert($dataProduct);
            }

            \DB::commit();
            return redirect()->route('get.list.goods_issue.products')->with('success','[Success] Thêm mới thành công.');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể lưu dữ liệu.');
        }
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $warehousing = Warehousing::find($id);

        if (!$warehousing) {
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }

        try {
            $warehousing->delete();
            return redirect()->route('get.list.goods_issue.products')->with('success','[Success] Xóa thành công.');
        } catch (\Exception $exception) {
            \Log::error($exception);
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function ajaxAddRow(Request $request)
    {
        if ($request->ajax())
        {
            $location = intval($request->location) + 1;
            $type = true;
            $html =  view('components.import_row_table',compact('location', 'type'))->render();
            return response([
                'html' => $html
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function calculateTotalAmount(Request $request)
    {
        if ($request->ajax())
        {
            $idProduct = intval($request->idProduct);
            $totalNumber = intval($request->totalNumber);
            $flagPrice = $request->flagPrice;
            $customPrice = $request->customPrice;
            $total = 0;
            $flgCheck = true;

            $product = Product::find($idProduct);

            if ($product) {
                $total = $totalNumber * getPriceProduct($product, $flagPrice, $customPrice);
            }

            return response([
                'total' => $total,
                'flgCheck' => $flgCheck,
            ]);
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return Http\Response
     * @throws \Throwable
     */
    public function warehousingPreview(Request $request, $id)
    {
        if ($request->ajax())
        {
            $warehousing = Warehousing::with('user')->where('id', $id)->first();

            $products = ProductWarehousing::with([
                'product' => function($product)
                {
                    $product->select('*')->with('unit');
                },
                'supplier'
            ])->where('pw_warehousing_id', $id)->get();

            $html =  view('components.warehousing_preview', compact('products', 'warehousing'))->render();

            return response([
                'html' => $html
            ]);
        }
    }

    public function loadExcel(CheckInputFileRequest $request)
    {
        if ($request->ajax())
        {
            $productExcels = [];
            $dataExcels = \Excel::load($request->file('files'), function($reader) {})->get();
            if ($dataExcels) {
                foreach($dataExcels as $key => $value) {

                    $product = Product::where('p_code', trim($value['ma_san_pham']))->first();
                    $productExcels[$key]['product_id'] = $product ? $product->id : '';
                    $supplier = Supplier::where('s_code', trim($value['ma_nha_cung_cap']))->first();
                    $productExcels[$key]['supplier_id'] = $supplier ? $supplier->id : '';
                    $productExcels[$key]['total_number'] = $value['so_luong'];
                    $productExcels[$key]['active_price'] = 4;
                    $productExcels[$key]['custom_price'] = $value['don_gia'];
                    $productExcels[$key]['manufacturing_date'] = date('Y-m-d', strtotime($value['ngay_san_xuat']));
                    $productExcels[$key]['expiry_date'] = date('Y-m-d', strtotime($value['ngay_het_han']));
                    $productExcels[$key]['total_price'] = $value['tong_tien'];
                }
            }
            $html =  view('components.import_row_excel_table', compact('productExcels'))->render();

            return response([
                'html' => $html
            ]);

        }
    }
}
