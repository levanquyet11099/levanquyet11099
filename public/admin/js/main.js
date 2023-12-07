var config = {};

var init_function = {
    init: function () {
        let _this = this;
        _this.bs_input_file();
        _this.showImage();
        _this.randomCodeSuppliers();
        _this.addRowImportProduct();
        _this.previewWarehousing();
    },
    bs_input_file: function () {
        $(".input-file").before(
            function() {
                if ( ! $(this).prev().hasClass('input-ghost') ) {
                    var element = $("<input type='file' class='input-ghost' id='input_img' style='visibility:hidden; height:0'>");
                    element.attr("name",$(this).attr("name"));
                    element.change(function(){
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                    });
                    $(this).find("button.btn-choose").click(function(){
                        element.click();
                    });
                    $(this).find("button.btn-reset").click(function(){
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor","pointer");
                    $(this).find('input').mousedown(function() {
                        $(this).parents('.input-file').prev().click();
                        return false;
                    });
                    return element;
                }
            }
        );
    },
    showImage: function() {
        $("#input_img").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_render').attr('src', e.target.result);
                    $('#image_render').css('height', '260px');
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    },
    randomCodeSuppliers: function () {
        $(config.rand_code_suppliers).click(function () {
            $(config.code_suppliers).val(randomString(15));
        });
    },
    addRowImportProduct: function () {
        $('.btn-add-row-import_product').click(function () {
            var location = $('table#table-import-product tr:last').attr('location');
            var url = $('table#table-import-product').attr('url');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {
                    location: location
                },
            }).done(function (result) {
                $('.content-table').append(result.html)
            });
        })
    },
    previewWarehousing : function () {
        $(".btn_preview_warehousing").click(function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
            }).done(function (result) {
                if (result.html)
                {
                    $("#warehousing_preview").html('').append(result.html);
                    $(".warehousing_preview").modal('show');
                }
            })
        })
    }

}
$(function () {
    init_function.init();

    $(document).on('before', '.input-file', function () {
        if ( ! $(this).prev().hasClass('input-ghost') ) {
            var element = $("<input type='file' class='input-ghost' id='input_img' style='visibility:hidden; height:0'>");
            element.attr("name",$(this).attr("name"));
            element.change(function(){
                element.next(element).find('input').val((element.val()).split('\\').pop());
            });
            $(this).find("button.btn-choose").click(function(){
                element.click();
            });
            $(this).find("button.btn-reset").click(function(){
                element.val(null);
                $(this).parents(".input-file").find('input').val('');
            });
            $(this).find('input').css("cursor","pointer");
            $(this).find('input').mousedown(function() {
                $(this).parents('.input-file').prev().click();
                return false;
            });
            return element;
        }
    });

    $(document).on('change', '#input_img', function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image_render').attr('src', e.target.result);
                $('#image_render').css('height', '260px');
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    $('.btn-change-code').click(function (event) {
        event.preventDefault();
        let code = randomCode(15);
        $('.random_code').val(code);
    });

    $(document).on('click', '.pw_active_price', function(){
        var activePrice = $(this).val();
        var _that = $(this);

        if (activePrice == 4) {
            _that.parent().find('input.pw_custom_price').css('display', 'block');
            _that.parent().find('input.pw_custom_price').attr('required', true);
        } else {
            _that.parent().find('input.pw_custom_price').css('display', 'none');
            _that.parent().find('input.pw_custom_price').attr('required', false)
        }

        calculateTotalAmount(_that);
    });

    $(document).on('change', '.pw_total_number', function () {
        var _that = $(this);
        calculateTotalAmount(_that);
    });

    $(document).on('change', '.pw_product_id', function () {
        var _that = $(this);
        calculateTotalAmount(_that);
    });

    $(document).on('change', '.pw_custom_price', function () {
        var _that = $(this);
        calculateTotalAmount(_that);
    });
    $(document).on('change', '.manufacturing_date', function () {
        var _that = $(this);
        calculateTotalAmount(_that);
    });

    $(document).on('change', '.expiry_date', function () {
        var _that = $(this);
        calculateTotalAmount(_that);
    });

    $(document).on('click', '.delete-item-product', function () {
        var totalRowCount = $("#table-import-product tr").length;
        var _that = $(this);
         if ( totalRowCount > 2 ) {
             $.confirm({
                 title: 'Cảnh báo?',
                 content: 'Bạn có chắc chắn muốn thực hiện thao tác này không.',
                 type: 'green',
                 buttons: {
                     ok: {
                         text: "ok!",
                         btnClass: 'btn-primary',
                         keys: ['enter'],
                         action: function(){
                             _that.parent().parent().remove();
                         }
                     },
                     cancel: {
                         btnClass: 'btn-danger',
                     },
                 }
             });
         } else {
             $.confirm({
                 title: 'Thông báo',
                 content: 'Dữ liệu nhập hàng cần có ít nhất một sản phẩm',
                 type: 'green',
                 buttons: {
                     ok: {
                         text: "ok!",
                         btnClass: 'btn-primary',
                         keys: ['enter'],
                         action: function(){
                         }
                     },
                 }
             });
         }
    });

    function calculateTotalAmount(_that, activePrice = null) {
        var idProduct = _that.parent().parent().find('select.pw_product_id').val();
        var totalNumber = _that.parent().parent().find('input.pw_total_number').val();
        var flagPrice = _that.parent().parent().find('input.pw_active_price:checked').val();
        var manufacturingDate = _that.parent().parent().find('input.manufacturing_date').val();
        var expiryDate = _that.parent().parent().find('input.expiry_date').val();
        var customPrice = '';
        var url = $('.table').attr('urlCalculate');
        var message = '';


        if ( totalNumber < 0) {
            message = "Số lượng sản phẩm không được phép nhỏ hơn 0."
        }

        if ((manufacturingDate != undefined && manufacturingDate != '') || (expiryDate != undefined && expiryDate != '')) {
            var dateNow = new Date();
            var dateTo = '';
            var dateFrom = '';
            var flgCheckGoods = true;

            if (manufacturingDate != undefined && manufacturingDate != '') {
                dateTo = new Date(manufacturingDate);
            }

            if (expiryDate != undefined && expiryDate != '') {
                dateFrom = new Date(expiryDate);
            }

            if (dateTo == '' && dateFrom != '') {
                if (dateFrom < dateNow) {
                    message = 'Ngày hết hạn không được phép nhỏ hơn ngày hiện tại';
                    flgCheckGoods = false;
                }
            }

            if (dateTo != '' && dateFrom != '') {
                if (dateFrom < dateTo) {
                    message = 'Ngày hết hạn không được phép nhỏ hơn ngày sản xuất';
                    flgCheckGoods = false;
                }
            }

            if (flgCheckGoods) {
                $('.btn-goods-issue').removeAttr('disabled');
            } else {
                $('.btn-goods-issue').attr('disabled','disabled');
            }
        }

        if (flagPrice == 4) {
            customPrice = _that.parent().parent().find('input.pw_custom_price').val();
        }

        if (message != '') {
            $.confirm({
                title: 'Cảnh báo?',
                content: message,
                type: 'green',
                buttons: {
                    cancel: {
                        btnClass: 'btn-danger',
                    },
                },
            });
            $('.btn-goods-issue').attr('disabled','disabled');
            return false;
        } else {
            $('.btn-goods-issue').removeAttr('disabled');
        }

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {
                idProduct: idProduct,
                totalNumber: totalNumber,
                flagPrice : flagPrice,
                customPrice : customPrice
            },
        }).done(function (result) {
            if (result.flgCheck) {
                var totalPrice = formatNumber(result.total, '.', ',') + ' <sup>đ</sup>';
                _that.parent().parent().find('p.pw_total_price').html(totalPrice);
                _that.parent().parent().find('input.pw_total_price').val(result.total);
                if (result.activeBtn) {
                    $('.btn-goods-receipt').removeAttr('disabled');
                }
            } else {
                var stringNotification = 'Số lượng sản phẩm không đủ. Số lượng còn lại ' + result.number;
                _that.parent().parent().find('input.pw_total_number').val(result.number);
                alert(stringNotification);
                $('.btn-goods-receipt').attr('disabled','disabled');
            }
        });
    }

    function formatNumber(nStr, decSeperate, groupSeperate) {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }

    function randomCode(num) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < num; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }


});



