document.addEventListener("DOMContentLoaded", function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "post",
        url: "/pageview",
        data:{
            'current_url' : $('#current').attr('value'),
            'referer' : $('#referer').attr('value')
        },
        success: function (result) {
           
        }
    });
});