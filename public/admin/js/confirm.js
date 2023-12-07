$(function(){
    $(".confirm__btn").click(function(event){
        event.preventDefault();
        let $this = $(this);

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
                        window.location = $this.attr('href');
                    }
                },
                cancel: {
                    btnClass: 'btn-danger',
                },
            }
        });
    });
})