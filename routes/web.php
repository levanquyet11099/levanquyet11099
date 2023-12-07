<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace'=>'Auth'], function () {

    Route::get('/', 'LoginController@login')->name('login');
    Route::post('/', 'LoginController@postLogin');
    Route::get('logout', 'LoginController@logoutUser')->name('logout');
    Route::get('logout', 'LoginController@logoutUser')->name('logout');

    Route::get('/update-info-profile', 'UserUpdateInforProfileController@userUpdateInfo')->name('update.info.profile');
    Route::post('/update-info-profile', 'UserUpdateInforProfileController@updateInfoUser');

    Route::get('forgot-password', 'ForgotPasswordController@forgotPassword')->name('forgot.password');
    Route::post('forgot-password', 'ForgotPasswordController@postPassword');
    Route::get('reset-password/{token}', 'ResetPasswordController@resetPassword')->name('reset.password');
    Route::post('reset-password/{token}', 'ResetPasswordController@postResetPassword')->name('post.reset.password');
});

Route::group(['prefix' => 'system', 'namespace' => 'Backend', 'middleware' =>['auth']], function (){

    Route::get('/', 'AdminDashboardController@index')->name('admin.dashboard');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    //Quản lý tài khoản
    Route::group(['prefix' => 'account','namespace' => 'Account'], function (){
        // quan ly nhom quyen
        Route::group(['prefix' => 'group-permission'], function(){
            Route::get('/', 'AdminGroupPermissionController@index')->name('get.list.group-permission');
            Route::get('/create', 'AdminGroupPermissionController@create')->name('get.create.group-permission');
            Route::post('/create', 'AdminGroupPermissionController@store');

            Route::get('/update/{id}', 'AdminGroupPermissionController@edit')->name('get.update.group-permission');
            Route::post('/update/{id}', 'AdminGroupPermissionController@update');

            Route::get('/delete/{id}', 'AdminGroupPermissionController@delete')->name('get.delete.group-permission');
        });

        Route::group(['prefix' => 'permission'], function(){
            Route::get('/', 'AdminPermissionController@index')->name('get.list.permission');
            Route::get('/create', 'AdminPermissionController@create')->name('get.create.permission');
            Route::post('/create', 'AdminPermissionController@store');

            Route::get('/update/{id}', 'AdminPermissionController@edit')->name('get.update.permission');
            Route::post('/update/{id}', 'AdminPermissionController@update');

            Route::get('/delete/{id}', 'AdminPermissionController@delete')->name('get.delete.permission');
        });

        // quản lý vai trò
        Route::group(['prefix' => 'role'], function(){
            Route::get('/', 'AdminRoleController@index')->name('get.list.role')->middleware('permission:danh-sach-vai-tro-thanh-vien|toan-bo-he-thong');
            Route::get('/create', 'AdminRoleController@create')->name('get.create.role')->middleware('permission:them-vai-tro-thanh-vien|toan-bo-he-thong');
            Route::post('/create', 'AdminRoleController@store');

            Route::get('/update/{id}', 'AdminRoleController@edit')->name('get.update.role')->middleware('permission:sua-vai-tro-thanh-vien|toan-bo-he-thong');
            Route::post('/update/{id}', 'AdminRoleController@update');

            Route::get('/delete/{id}', 'AdminRoleController@delete')->name('get.delete.role')->middleware('permission:xoa-vai-tro-thanh-vien|toan-bo-he-thong');
        });

        // quan ly thanh vien
        Route::group(['prefix' => 'user'], function(){
            Route::get('/', 'AdminUserController@index')->name('get.list.user')->middleware('permission:danh-sach-quan-tri-vien|toan-bo-he-thong');

            Route::get('/create', 'AdminUserController@create')->name('get.create.user')->middleware('permission:them-moi-quan-tri-vien|toan-bo-he-thong');
            Route::post('/create', 'AdminUserController@store');

            Route::get('/update/{id}', 'AdminUserController@edit')->name('get.update.user')->middleware('permission:sua-quan-tri-vien|toan-bo-he-thong');
            Route::post('/update/{id}', 'AdminUserController@update');

            Route::get('/delete/{id}', 'AdminUserController@delete')->name('get.delete.user')->middleware('permission:xoa-quan-tri-vien|toan-bo-he-thong');

            Route::get('/account', 'AdminUserController@account')->name('get.account.info');
            Route::post('/account/update/{id}', 'AdminUserController@updateAccount')->name('update.account');

            Route::get('/change/password', 'ChangePasswordController@changePassword')->name('change.password');
            Route::post('/password/change', 'ChangePasswordController@postChangePassword')->name('post.change.password');
        });
    });

    Route::group(['prefix' => 'suppliers'], function (){
        Route::get('/', 'SupplierController@index')->name('get.list.suppliers')->middleware('permission:danh-sach-nha-cung-cap|toan-bo-he-thong');
        Route::get('/create', 'SupplierController@create')->name('get.create.supplier')->middleware('permission:them-nha-cung-cap|toan-bo-he-thong');
        Route::post('/create', 'SupplierController@store');
        Route::get('/update/{id}', 'SupplierController@edit')->name('get.update.supplier')->middleware('permission:sua-nha-cung-cap|toan-bo-he-thong');
        Route::post('/update/{id}', 'SupplierController@update');
        Route::get('/delete/{id}', 'SupplierController@delete')->name('get.delete.supplier')->middleware('permission:xoa-nha-cung-cap|toan-bo-he-thong');
    });

    Route::group(['prefix' => 'categories'], function (){
        Route::get('/','CategoriesController@index')->name('get.list.categories')->middleware('permission:danh-sach-loai-hang|toan-bo-he-thong');
        Route::get('/create','CategoriesController@create')->name('get.create.category')->middleware('permission:them-moi-loai-hang|toan-bo-he-thong');
        Route::post('/create','CategoriesController@store');
        Route::get('/update/{id}','CategoriesController@edit')->name('get.update.category')->middleware('permission:chinh-sua-loai-hang|toan-bo-he-thong');
        Route::post('/update/{id}','CategoriesController@update');
        Route::get('/delete/{id}','CategoriesController@delete')->name('get.delete.category')->middleware('permission:xoa-loai-hang|toan-bo-he-thong');
    });

    Route::group(['prefix' => 'units'], function (){
        Route::get('/', 'UnitsController@index')->name('get.list.units')->middleware('permission:danh-sach-don-vi-tinh|toan-bo-he-thong');
        Route::get('/create', 'UnitsController@create')->name('get.create.unit')->middleware('permission:them-don-vi-tinh|toan-bo-he-thong');
        Route::post('/create', 'UnitsController@store');
        Route::get('/update/{id}', 'UnitsController@edit')->name('get.update.unit')->middleware('permission:sua-don-vi-tinh|toan-bo-he-thong');
        Route::post('/update/{id}', 'UnitsController@update');
        Route::get('/delete/{id}', 'UnitsController@delete')->name('get.delete.unit')->middleware('permission:xoa-don-vi-tinh|toan-bo-he-thong');
    });

    Route::group(['prefix' => 'products'], function (){
        Route::get('/', 'ProductController@index')->name('get.list.products')->middleware('permission:danh-sach-san-pham|toan-bo-he-thong');
        Route::get('/create', 'ProductController@create')->name('get.create.product')->middleware('permission:them-san-pham|toan-bo-he-thong');
        Route::post('/create', 'ProductController@store');
        Route::get('/update/{id}', 'ProductController@edit')->name('get.update.product')->middleware('permission:sua-san-pham|toan-bo-he-thong');
        Route::post('/update/{id}', 'ProductController@update');
        Route::get('/delete/{id}', 'ProductController@delete')->name('get.delete.product')->middleware('permission:xoa-san-pham|toan-bo-he-thong');
    });

    Route::group(['prefix' => 'goods_issue'], function (){
        Route::get('/','GoodsIssueController@index')->name('get.list.goods_issue.products')->middleware('permission:danh-sach-nhap-hang|toan-bo-he-thong');
        Route::get('/create', 'GoodsIssueController@create')->name('get.goods_issue.create.product')->middleware('permission:them-don-nhap-hang|toan-bo-he-thong');
        Route::post('/create', 'GoodsIssueController@store');
        Route::get('/update/{id}', 'GoodsIssueController@edit')->name('get.goods_issue.edit.product')->middleware('permission:sua-don-nhap-hang|toan-bo-he-thong');
        Route::post('/update/{id}', 'GoodsIssueController@update');
        Route::get('/delete/{id}', 'GoodsIssueController@delete')->name('delete.goods_issue.product')->middleware('permission:xoa-don-nhap-hang|toan-bo-he-thong');
        Route::get('/add/row/table', 'GoodsIssueController@ajaxAddRow')->name('add.row.goods_issue.product');
        Route::get('/calculate/total/amount', 'GoodsIssueController@calculateTotalAmount')->name('goods_issue.calculate.total.amount');
        Route::post('/goods_issue/preview/{id}', 'GoodsIssueController@warehousingPreview')->name('goods_issue.product.preview');
        Route::post('/goods_issue/load/excel', 'GoodsIssueController@loadExcel')->name('goods_issue.load.excel');
    });

    Route::group(['prefix' => 'goods_receipt'], function (){
        Route::get('/','GoodsReceiptController@index')->name('get.list.export.products')->middleware('permission:danh-sach-xuat-hang|toan-bo-he-thong');
        Route::get('/create', 'GoodsReceiptController@create')->name('get.export.create.product')->middleware('permission:them-don-xuat-hang|toan-bo-he-thong');
        Route::post('/create', 'GoodsReceiptController@store');
        Route::get('/update/{id}', 'GoodsReceiptController@edit')->name('get.export.edit.product')->middleware('permission:sua-don-xuat-hang|toan-bo-he-thong');
        Route::post('/update/{id}', 'GoodsReceiptController@update');
        Route::get('/delete/{id}', 'GoodsReceiptController@delete')->name('delete.export.product')->middleware('permission:xoa-don-xuat-hang|toan-bo-he-thong');
        Route::get('/add/row/table', 'GoodsReceiptController@ajaxAddRow')->name('add.row.export.table');
        Route::get('/calculate/total/amount', 'GoodsReceiptController@calculateTotalAmount')->name('export.calculate.total.amount');
        Route::post('/goods_receipt/preview/{id}', 'GoodsReceiptController@warehousingExportPreview')->name('export.goods_receipt.preview');
    });

    Route::group(['prefix' => 'product_warehousing'], function (){
        Route::get('/', 'ProductWarehousingController@index')->name('get.list.product.goods_issue')->middleware('permission:du-lieu-san-pham-nhap-hang|toan-bo-he-thong');
        Route::get('/delete/product/goods_issue/{id}', 'ProductWarehousingController@deleteProductWarehousing')->name('delete.product.goods_issue')->middleware('permission:toan-bo-he-thong');
    });

    Route::group(['prefix' => 'export_product_warehousing'], function (){
        Route::get('/', 'ExportProductWarehousingController@index')->name('get.list.export.product.goods_issue')->middleware('permission:du-lieu-san-pham-xuat-hang|toan-bo-he-thong');
    });
    
    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/', 'WarehouseController@index')->name('get.list.warehouse')->middleware('permission:du-lieu-kho-hang|toan-bo-he-thong');
        Route::get('/statistical', 'WarehouseController@statistical')->name('statistical')->middleware('permission:thong-ke-nhap-xuat-ton-dau|toan-bo-he-thong');;
        Route::get('/revenue', 'WarehouseController@revenue')->name('revenue')->middleware('permission:thong-ke-doanh-thu|toan-bo-he-thong');;
        Route::get('/quantity-statistics', 'WarehouseController@quantityStatistics')->name('quantity.statistics')->middleware('permission:thong-ke-so-luong-ban-ra|toan-bo-he-thong');;
    });
});