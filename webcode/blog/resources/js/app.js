require('./bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;

require('jquery-datetimepicker');
jQuery.datetimepicker.setLocale('ko');

function recent_ajax(){
    $.ajax({
        type:'get', 
        url:"/recent", 
        success:function(result){
            $('.modal-body').html(result);
        }
    });
}

document.addEventListener("DOMContentLoaded", function(){
    recent_ajax();

    $('#datetimepicker').datetimepicker({
        lang:'ko',
        format:'Y-m-d H:i',
        inline: true,
        sideBySide: true,
        lazyInit:true,
        ownerDocument: document,
        contentWindow: window,
        allowTimes : []
    });

    $(document).on('click','#modalButton',function(){
        recent_ajax();
    });
    
    $(document).on('click','.bi-heart',function(){
        var lecture_id = $(this).parent().siblings('a').attr("href").split('lecture/show/')[1];
        var $this = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type:'post',
            url:"/interest",
            data : {
                lecture_id : lecture_id
            },
            success:function(result){
                if(result.status == 200){
                    $this.removeClass('bi-heart').addClass('bi-heart-fill');
                }else{
                    console.log(result);
                }
            }
        });
    }).on('click', '.bi-heart-fill', function (e) {
        e.stopPropagation();
        var lecture_id = $(this).parent().siblings('a').attr("href").split('lecture/show/')[1];
        var $this = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: "POST",
            url:"/interest/destroy",
            data:{
                lecture_id: lecture_id,
                _method:"DELETE"
            },
            success:function(result){
                if(result.status == 200){
                    $this.removeClass('bi-heart-fill').addClass('bi-heart');
                }else{
                    console.log(result);
                }
            }
        });
     });
});