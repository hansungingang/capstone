function checked(name,value){
    return  '<span class="checked" value="'+ value +'">' +
                name + '<button type="button" class="btn btn-primary btn-sm" id="btn_check_del">삭제</button>'+
            '</span>'
}

function ifAlreadyChecked(){
    var alreadyChecked = $('.interest_wrap').find('input[type=checkbox]:checked');
    if(alreadyChecked.length > 0){
        $.each(alreadyChecked, function(index, item){
            var name = $(this).siblings('label').first().html();
            var value = $(this).val();
            $('.check_category_area').append(checked(name,value));
        });
        $('.no_checked').css('display','none');
    }    
}

document.addEventListener("DOMContentLoaded", function(){
    ifAlreadyChecked();
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
});