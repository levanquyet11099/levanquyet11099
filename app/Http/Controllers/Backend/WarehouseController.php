<?php

namespace App\Http\Controllers\Backend;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ProductWarehousing;
use Carbon\Carbon;

class WarehouseController extends Controller
{
    //
    public function index(Request $request)
    {
        $products = ProductWarehousing::with([
            'product' => function($product)
            {
                $product->select('*')->with('unit');
            },
        ])->select('pw_product_id', \DB::raw('SUM(pw_total_number) AS total_product'));

        if ($request->p_code) {
            $pro = Product::where('p_code', $request->p_code)->first();
            if ($pro) {
                $products = $products->where('pw_product_id', $pro->id);
            } else {
                $products = $products->where('pw_product_id', NULL);
            }
        }

        if ($request->p_name) {
             $prod= Product::where('p_name','like','%'. $request->p_name .'%')->pluck('id')->toArray();

             if ($prod) {
                 $products = $products->whereIn('pw_product_id', $prod);
             } else {
                 $products = $products->where('pw_product_id', NULL);
             }
        }

        $products = $products->groupBy('pw_product_id')->paginate(10);

        $viewData = [
            'products' => $products,
            'warehouse' => 'active',
        ];

        return view('backend.warehouse.index', $viewData);
    }

    public function statistical(Request $request)
    {
        $products = ProductWarehousing::with([
        'product' => function($product)
        {
            $product->select('*')->with('unit');
        },
        ])->select('pw_product_id', \DB::raw('SUM(pw_total_number) AS total_product'));

        $productsGoodsIssue = ProductWarehousing::select('pw_product_id', \DB::raw('SUM(pw_total_number) AS total_product_goods_issue'))->where('pw_type', 1);
        $productsGoodsReceipt = ProductWarehousing::select('pw_product_id', \DB::raw('SUM(pw_total_number) AS total_product_goods_receipt'))->where('pw_type', 2);

        if($request->p_code) {
            $product = Product::where('p_code', $request->p_code)->first();
            $id = '';
            if ($product) {
                $id = $product->id;
            }
            $products = $products->where('pw_product_id', $id);
            $productsGoodsIssue = $productsGoodsIssue->where('pw_product_id', $id);
            $productsGoodsReceipt = $productsGoodsReceipt->where('pw_product_id', $id);
        }

        if ($request->start_day) {

            $time_form = Carbon::createFromFormat('Y-m-d', $request->start_day)->setTime(00,00,00);
            $products = $products->where('created_at', '>=',  $time_form);
            $productsGoodsIssue = $productsGoodsIssue->where('created_at', '>=',  $time_form);
            $productsGoodsReceipt = $productsGoodsReceipt->where('created_at', '>=',  $time_form);
        }

        if ($request->end_day) {
            $time_to   = Carbon::createFromFormat('Y-m-d', $request->end_day)->setTime(23,59,59);
            $products = $products->where('created_at', '<=',  $time_to);
            $productsGoodsIssue = $productsGoodsIssue->where('created_at', '<=',  $time_to);
            $productsGoodsReceipt = $productsGoodsReceipt->where('created_at', '<=',  $time_to);
        }

        $products = $products->groupBy('pw_product_id')->paginate(10);
        $productsGoodsIssue = $productsGoodsIssue->groupBy('pw_product_id')->paginate(10);
        $productsGoodsReceipt = $productsGoodsReceipt->groupBy('pw_product_id')->paginate(10);

        $viewData = [
            'products' => $products,
            'productsGoodsIssue' => $productsGoodsIssue,
            'productsGoodsReceipt' => $productsGoodsReceipt,
            'statistical' => 'active',
        ];

        return view('backend.warehouse.statistical', $viewData);
    }

    public function revenue(Request $request)
    {
        $products = ProductWarehousing::with([
            'product' => function($product)
            {
                $product->select('*')->with('unit');
            },
        ])->select('pw_product_id');
        $productsGoodsIssue = ProductWarehousing::select('pw_product_id', \DB::raw('SUM(pw_total_price) AS total_product_goods_issue'))->where('pw_type', 1);
        $productsGoodsReceipt = ProductWarehousing::select('pw_product_id', \DB::raw('SUM(pw_total_price) AS total_product_goods_receipt'))->where('pw_type', 2);

        if($request->p_code) {
            $product = Product::where('p_code', $request->p_code)->first();
            $id = '';
            if ($product) {
                $id = $product->id;
            }
            $products = $products->where('pw_product_id', $id);
            $productsGoodsIssue = $productsGoodsIssue->where('pw_product_id', $id);
            $productsGoodsReceipt = $productsGoodsReceipt->where('pw_product_id', $id);
        }

        if($request->day) {
            $products = $products->whereDay('created_at', $request->day);
            $productsGoodsIssue = $productsGoodsIssue->whereDay('created_at', $request->day);
            $productsGoodsReceipt = $productsGoodsReceipt->whereDay('created_at', $request->day);
        }

        if($request->month) {
            $products = $products->whereMonth('created_at', $request->month);
            $productsGoodsIssue = $productsGoodsIssue->whereMonth('created_at', $request->month);
            $productsGoodsReceipt = $productsGoodsReceipt->whereMonth('created_at', $request->month);
        }

        if($request->year) {
            $products = $products->whereYear('created_at', $request->year);
            $productsGoodsIssue = $productsGoodsIssue->whereYear('created_at', $request->year);
            $productsGoodsReceipt = $productsGoodsReceipt->whereYear('created_at', $request->year);
        }

        $products = $products->groupBy('pw_product_id')->paginate(10);
        $productsGoodsIssue = $productsGoodsIssue->groupBy('pw_product_id')->paginate(10);
        $productsGoodsReceipt = $productsGoodsReceipt->groupBy('pw_product_id')->paginate(10);

        $viewData = [
            'products' => $products,
            'productsGoodsIssue' => $productsGoodsIssue,
            'productsGoodsReceipt' => $productsGoodsReceipt,
            'revenue' => 'active',
        ];

        return view('backend.warehouse.revenue', $viewData);
    }

    public function quantityStatistics(Request $request)
    {
        $products = ProductWarehousing::with([
            'product' => function($product)
            {
                $product->select('*')->with('unit');
            },
        ])->select('pw_product_id');
        $productsGoodsIssue = ProductWarehousing::select('pw_product_id', \DB::raw('SUM(pw_total_number) AS total_product_goods_issue'))->where('pw_type', 1);
        $productsGoodsReceipt = ProductWarehousing::select('pw_product_id', \DB::raw('SUM(pw_total_number) AS total_product_goods_receipt'))->where('pw_type', 2);

        if($request->p_code) {
            $product = Product::where('p_code', $request->p_code)->first();
            $id = '';
            if ($product) {
                $id = $product->id;
            }
            $products = $products->where('pw_product_id', $id);
            $productsGoodsIssue = $productsGoodsIssue->where('pw_product_id', $id);
            $productsGoodsReceipt = $productsGoodsReceipt->where('pw_product_id', $id);
        }

        if($request->day) {
            $products = $products->whereDay('created_at', $request->day);
            $productsGoodsIssue = $productsGoodsIssue->whereDay('created_at', $request->day);
            $productsGoodsReceipt = $productsGoodsReceipt->whereDay('created_at', $request->day);
        }

        if($request->month) {
            $products = $products->whereMonth('created_at', $request->month);
            $productsGoodsIssue = $productsGoodsIssue->whereMonth('created_at', $request->month);
            $productsGoodsReceipt = $productsGoodsReceipt->whereMonth('created_at', $request->month);
        }

        if($request->year) {
            $products = $products->whereYear('created_at', $request->year);
            $productsGoodsIssue = $productsGoodsIssue->whereYear('created_at', $request->year);
            $productsGoodsReceipt = $productsGoodsReceipt->whereYear('created_at', $request->year);
        }

        $products = $products->groupBy('pw_product_id')->paginate(10);
        $productsGoodsIssue = $productsGoodsIssue->groupBy('pw_product_id')->paginate(10);
        $productsGoodsReceipt = $productsGoodsReceipt->groupBy('pw_product_id')->paginate(10);

        $viewData = [
            'products' => $products,
            'productsGoodsIssue' => $productsGoodsIssue,
            'productsGoodsReceipt' => $productsGoodsReceipt,
            'quantity_statistics' => 'active',
        ];

        return view('backend.warehouse.quantity_statistics', $viewData);
    }
}
