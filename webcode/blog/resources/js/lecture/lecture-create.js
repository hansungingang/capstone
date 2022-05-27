function add_platform_field(){
    var result = "<div class='form-group row'>";
    result +=
    add_platform_by_field('platform_name') + 
    add_platform_by_field('price') + 
    add_platform_by_field('url') + 
    add_platform_by_field('watch_time') +
    add_platform_by_field('end_time') + 
    platform_cancel();

    result +='</div>';
    return result;
}

function add_platform_by_field(field){
    var kor_field= '';
    var html = '';
    var id = null;
    var placeholder = '';
    switch(field){
        case 'platform_name':
            kor_field = '플랫폼이름';
            break;
        case 'price':
            kor_field = '가격';
            break;
        case 'url':
            kor_field = 'url';
            break;
        case 'watch_time':
            kor_field = '시청가능기간(숫자)';
            placeholder = '0이면 평생 시청';
            break;
        case 'end_time':
            kor_field = '강의 종료시간';
            id = 'datetimepicker';
            break;
        default:
            break;
    }

    
    html +=  '<div class="col-md-2">'+
                kor_field +
                '<input type="text" class="form-control"'+ 
                (id ? 'id="'+id+'"' : '') + 
                'name="'+ field +'[]"'+ 
                (placeholder ? 'placeholder="'+placeholder+'"' : '') + 
                '>'+
            '</div>';
    return html;
}

function platform_cancel(){
    return '<div class="col-md-2">'+
                '<button type="button" class="btn btn-outline-danger" style="hegiht:100%;padding:17px;" id="delete">삭제</button>'+
            '</div>';
}

window.loadfile = function(event){
    var preview = document.getElementById('output_image');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.onload = function() {
        URL.revokeObjectURL(preview.src) // free memory
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    event.preventDefault();
    var formData = new FormData();
    formData.append('upload',event.target.files[0]);

    $.ajax({
        type:'POST',
        url: '/file/lectureImageUpload',
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(response) {
            $('.file_id').val(response);
        },
        error: function(response){
            alert('File Fail');
        }
    });
}


document.addEventListener("DOMContentLoaded", function(){
    $(document).on('click',"#add_platform",function(){
        $('.add_platform_place').append(add_platform_field());
        $( "input[name='end_time[]']" ).datetimepicker({ dateFormat:'Y-m-d H:i:s' });  
    });
    $(document).on('click',"#delete",function(){
        $(this).parent().parent().remove();
    })
})
