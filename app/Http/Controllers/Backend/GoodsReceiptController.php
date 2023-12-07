<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehousingRequest;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Warehousing;
use App\Model\ProductWarehousing;

class GoodsReceiptController extends Controller
{
    public function __construct()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        view()->share([
            'export_menu' => 'active',
            'products' => $products,
            'suppliers' => $suppliers
        ]);
    }
    //
    public function index(Request $request)
    {
        $warehousings = Warehousing::with('user');

        if ($request->w_code) {
            $warehousings = $warehousings->where('w_code', $request->w_code);
        }

        if ($request->w_name) {
            $warehousings = $warehousings->where('w_name', $request->w_name);
        }

        $warehousings = $warehousings->where('w_type', 2)->orderBy('id', 'DESC')->paginate(20);
        return view('backend.goods_receipt.index', compact('warehousings'));
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('backend.goods_receipt.create');
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
                'w_type' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $id = Warehousing::insertGetId($dataWarehousing);

            $productId = $request->pw_product_id;
            $supplierId = $request->pw_supplier_id;
            $totalNumber = $request->pw_total_number;
            $activePrice = $request->pw_active_price;
            $customPrice = $request->pw_custom_price;
            $totalPrice = $request->pw_total_price;

            foreach ($productId as $key => $prId) {
                $dataProduct = [
                    'pw_product_id' => $prId,
                    'pw_warehousing_id' => $id,
                    'pw_supplier_id' => $supplierId[$key],
                    'pw_total_number' => -$totalNumber[$key],
                    'pw_active_price' => $activePrice[$key],
                    'pw_custom_price' => isset($customPrice[$key]) ? $customPrice[$key] : NULL,
                    'pw_total_price' => isset($totalPrice[$key]) ? $totalPrice[$key] : NULL,
                    'pw_type' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                ProductWarehousing::insert($dataProduct);
            }

            \DB::commit();
            return redirect()->route('get.list.export.products')->with('success','[Success] Thêm mới thành công.');
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
            return redirect()->route('get.list.export.products')->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }

        return view('backend.goods_receipt.update', compact('warehousing'));
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
                'updated_at' => now(),
            ];
            $warehousing->update($dataWarehousing);

            $productId = $request->pw_product_id;
            $supplierId = $request->pw_supplier_id;
            $totalNumber = $request->pw_total_number;
            $activePrice = $request->pw_active_price;
            $customPrice = $request->pw_custom_price;
            $totalPrice = $request->pw_total_price;

            ProductWarehousing::where('pw_warehousing_id', $id)->delete();

            foreach ($productId as $key => $prId) {
                $dataProduct = [
                    'pw_product_id' => $prId,
                    'pw_warehousing_id' => $id,
                    'pw_supplier_id' => $supplierId[$key],
                    'pw_total_number' => -$totalNumber[$key],
                    'pw_active_price' => $activePrice[$key],
                    'pw_custom_price' => isset($customPrice[$key]) ? $customPrice[$key] : NULL,
                    'pw_total_price' => isset($totalPrice[$key]) ? $totalPrice[$key] : NULL,
                    'pw_type' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                ProductWarehousing::insert($dataProduct);
            }

            \DB::commit();
            return redirect()->back()->with('success','[Success] Thêm mới thành công.');
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
            return redirect()->back()->with('success','[Success] Xóa thành công.');
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
            $type = false;
            $html =  view('components.import_row_table',compact('location', 'type'))->render();
            return response([
                'html' => $html
            ]);
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return Http\Response
     * @throws \Throwable
     */
    public function warehousingExportPreview(Request $request, $id)
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

            $html =  view('components.export_warehousing_preview', compact('products', 'warehousing'))->render();

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
            $activeBtn = true;

            $numberImport = ProductWarehousing::where(['pw_product_id' => $idProduct, 'pw_type' => 1])->sum('pw_total_number');
            $numberExport = ProductWarehousing::where(['pw_product_id' => $idProduct, 'pw_type' => 2])->sum('pw_total_number');
            $number = $numberImport + $numberExport;
            
            if ($number < intval($totalNumber)) {
                $flgCheck = false;
                $activeBtn = false;
            }

            if ($number <= 0) {
                $number = 0;
            }

            $product = Product::find($idProduct);
            if ($product) {
                $total = $totalNumber * getPriceProduct($product, $flagPrice, $customPrice);
            }

            return response([
                'total' => $total,
                'flgCheck' => $flgCheck,
                'number' => $number,
                'activeBtn' => $activeBtn,
            ]);
        }

    }
}
