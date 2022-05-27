function noContent(){
    return  '<tr>' +
                '<td>'+
                '</td>' +
                '<td colspan="6">' +
                    '<div>목록이 존재하지 않습니다.</div>' +
                '</td>' +
            '</tr>';
}

document.addEventListener("DOMContentLoaded", function(){
    $(document).on('click','#delete_all',function(){
        $('input:checkbox').prop('checked', this.checked);    
    });

    $(document).on('click','#deleteOne',function(){
        $this = $(this);
        var lecture_id = $(this).val();
        console.log(lecture_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url: '/interest/destroy',
            data : {
                lecture_id : lecture_id,
                _method : 'DELETE'
            },
            success: function(response) {
                if(response.status == 200){
                    location.reload();
                }  
            },
            error: function(response){
                console.log(response);             
            }
        });
    });

    $(document).on('click','#deleteAll',function(){
        var lecture_ids = [];
        $('input.deleteMany:checkbox:checked').each(function () {
            lecture_ids.push($(this).attr('name').split('checkbox_')[1]);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type:'post',
            url : '/interest/multipleDestroy',
            data : {
                lecture_ids : lecture_ids,
                _method : 'delete'
            },
            success:function(response){
                if(response.status == 200){
                    location.reload();
                }
            }
        });
    });
});