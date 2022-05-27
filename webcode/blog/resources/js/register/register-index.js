function checked(name,value){
    return  '<span class="checked" value="'+ value +'">' +
                name + '<button type="button" class="btn btn-primary btn-sm" id="btn_check_del">삭제</button>'+
            '</span>'
}

document.addEventListener("DOMContentLoaded", function(){
    $(document).on('click','#interest_category_button',function(){
        if(!$('.interest_wrap').hasClass('on')){
            $('.interest_wrap').addClass('on').show();
        }            
        else{
            $('.interest_wrap.on').removeClass('on').hide();
        }   
    });

    $(document).on('click','.category li',function(){
        $('.category li').removeClass('selected');
        $(this).addClass('selected');
        $('.sub_category').removeClass('on');
        var li = $('.interest_wrap').find('ul[data-value="' + $(this).attr('value') + '"]');
        li.addClass('on');
    });

    $(document).on('change','.sub_category input',function(){
        var value = $(this).val();
        if(this.checked) {
            var name = $(this).siblings('label').first().html();
            $('.check_category_area').append(checked(name,value));

            if($('.check_category_area > span.checked').length != 0){
                $('.no_checked').css('display','none');
            }
        }else{
            $('.check_category_area').find('span[value="'+ value +'"]').remove();

            if($('.check_category_area > span.checked').length == 0){
                $('.no_checked').css('display','block');
            }
        }
    });

    $(document).on('click','#btn_check_del',function(){
        var value = $(this).parent().attr('value');
        $('.interest_wrap').find('input[value="'+ value +'"]').prop('checked',false);
        $(this).parent().remove();
        if($('.checked').length == 0){
            $('.no_checked').css('display','block');
        }
    })

    $(document).on('change','#checkBox-agree-all',function(){
        if($(this).prop('checked')){
            $('.area_agreement').find('input[type=checkbox]').prop('checked',true);
        }else{
            $('.area_agreement').find('input[type=checkbox]').prop('checked',false);
        }
    })
});

