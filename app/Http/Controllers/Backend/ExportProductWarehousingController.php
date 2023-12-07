<?php

namespace App\Http\Controllers\Backend;

use App\Model\Product;
use App\Model\ProductWarehousing;
use App\Model\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Carbon\Carbon;


class ExportProductWarehousingController extends Controller
{
    /**
     * ProductWarehousingController constructor.
     */
    public function __construct()
    {
        view()->share([
            'export_list_product' => 'active',
        ]);
    }

    /**
     * @param Request $request
     * @return View\View
     */
    public function index(Request $request)
    {

        $products = ProductWarehousing::with([
            'product' => function($product)
            {
                $product->select('*')->with('unit');
            },
            'supplier'
        ]);

        if ($request->pw_product_id) {
            $products = $products->where('pw_product_id', $request->pw_product_id);
        }

        if ($request->pw_supplier_id) {
            $products = $products->where('pw_supplier_id', $request->pw_supplier_id);
        }

        $products = $products->where('pw_type', 2)->orderBy('id', 'DESC');
        if ($request->export) {
            $products = $products->get();
            $this->exportExcel($products);
        } else {
            $products = $products->paginate(10);
        }

        $listProducts = Product::all();
        $suppliers = Supplier::all();
        $type = false;

        return view('backend.product_warehousing.index', compact('products', 'listProducts', 'suppliers', 'type'));
    }


    /**
     * @param $products
     * @return \Illuminate\Http\RedirectResponse
     */
    public function exportExcel($products)
    {
        try{

            return Excel::create('danh-sach-xuat-hang-'.Carbon::now(), function($excel) use ($products) {

                $excel->sheet('Danh sách sản phẩm đã xuất kho', function ($sheet) use ($products) {

                    $sheet->cell('A1', function ($cell) {
                        $cell->setValue('STT');
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('B1', function ($cell) {
                        $cell->setValue('Tên sản phẩm');
                        $cell->setAlignment('center');
                    });
                    $sheet->cell('C1', function ($cell) {
                        $cell->setValue('Nhà cung cấp');
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('D1', function ($cell) {
                        $cell->setValue('Số lượng');
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('E1', function ($cell) {
                        $cell->setValue('Đơn giá');
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('F1', function ($cell) {
                        $cell->setValue('Đơn vị');
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('G1', function ($cell) {
                        $cell->setValue('Tổng tiền');
                        $cell->setAlignment('center');
                    });

                    $sheet->cell('H1', function ($cell) {
                        $cell->setValue('Ngày nhập');
                        $cell->setAlignment('center');
                    });

                    foreach ($products as $key => $product)
                    {
                        switch($product->pw_active_price)
                        {
                            case(1) :
                                $entryPrice =  number_format($product->product->p_entry_price, 0, ',', '.'). ' đ';
                                break;
                            case(2) :
                                $entryPrice = number_format($product->product->p_retail_price, 0, ',', '.'). ' đ';
                                break;
                            case(3) :
                                $entryPrice = number_format($product->product->p_cost_price, 0, ',', '.'). ' đ';
                            case(4) :
                                $entryPrice = number_format($product->pw_custom_price, 0, ',', '.'). ' đ';
                            default :
                                $entryPrice = number_format($product->product->p_entry_price, 0, ',', '.'). ' đ';
                                break;
                        }

                        $i= $key+2;
                        $sheet->cell('A'.$i, $key + 1);
                        $sheet->cell('B'.$i, $product->product->p_name);
                        $sheet->cell('C'.$i, $product->supplier->s_name);
                        $sheet->cell('D'.$i, $product->pw_total_number);
                        $sheet->cell('E'.$i, $entryPrice);
                        $sheet->cell('F'.$i, $product->product->unit->u_name);
                        $sheet->cell('G'.$i, number_format($product->pw_total_price, 0, ',', '.'). ' đ');
                        $sheet->cell('H'.$i, $product->created_at);
                    }
                });

            })->download('xlsx');

        }catch (\Exception $exception) {
            Log::error("[Error Export xlsx ]".$exception->getMessage());
            return redirect()->back()->with('danger',"- " .$exception->getMessage());
        }
    }
}
