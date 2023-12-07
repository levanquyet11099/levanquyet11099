<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductWarehousing;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        view()->share([
            'home' => 'active'
        ]);
    }
    public function index(Request $request)
    {
        $numberProduct = Product::count();
        $productsGoodsIssue = ProductWarehousing::select('pw_product_id', \DB::raw('SUM(pw_total_price) AS total_product_goods_issue'))->where('pw_type', 1)->groupBy('pw_product_id')->get();
        $productsGoodsReceipt = ProductWarehousing::select('pw_product_id', \DB::raw('SUM(pw_total_price) AS total_product_goods_receipt'))->where('pw_type', 2)->groupBy('pw_product_id')->get();

        $totalInvestment = 0;
        $totalRevenue = 0;

        foreach ($productsGoodsIssue as $key => $goodsIssue) {
            $totalInvestment = $totalInvestment + $goodsIssue->total_product_goods_issue;
        }

        foreach ($productsGoodsReceipt as $goodsReceipt) {
            $totalRevenue = $totalRevenue + $goodsReceipt->total_product_goods_receipt;
        }

        $viewData = [
            'numberProduct' => $numberProduct,
            'totalInvestment' => $totalInvestment,
            'totalRevenue' => $totalRevenue,
        ];

        return view('backend.dashboard', $viewData);
    }
}
