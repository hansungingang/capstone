function getComments(){    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'get',
        url: '/comment/'+boardId,
        success: function(response) {
            console.log(response);
            $('.area-comment').html(commentShow(response));
        },
        error: function(response){
            console.log(response);
        }
    });
}

function commentShow(comments){
    var result = '';
    $.each(comments.data, function( index, value ) {
        if(value.parent_comment_id == 0 ){ //댓글이면
            if(value.subcomments.length > 0 ){
                //대댓글이 있으면
                result += commentArea(value) + subCommentArea(value.subcomments);
            }else{
                result += commentArea(value)
            }
        }
    });

    return result;
}

function buttonArea(commentId,user_id){
    var result = '';
    if(loggedIn){
        result += '<button class="btn btn-primary text-white" href="#" id="replyButton">답변</button>';
        if(authId == user_id){
            result += '<button class="btn btn-primary text-white" href="#" id="changeComment">수정</button>' +
                        '<form id="destroyComment">' +
                            '<input type="hidden" id="commentId" value="'+ commentId +'">'+
                            '<input type="submit" class="btn btn-danger" value="삭제">' +
                        '</form>';
        }
    }
    return result;
}

function subCommentButtonArea(commentId,user_id){
    var result = '';
    if(loggedIn){
        if(authId == user_id){
            result += '<button class="btn btn-primary text-white" href="#" id="changeComment">수정</button>' +
                    '<form class="form" id="destroyComment">' +
                        '<input type="hidden" id="commentId" value="'+ commentId +'">'+
                        '<input type="submit" class="btn btn-danger" value="삭제">' +
                    '</form>';
        }
    }
    return result;    
}

function commentArea(value){
    return '<div class="comments">' +
    '<div class="comment">' +
        '<div class="content">' +
            '<header class="top">' +
                '<div class="username">'+value.user.name+'</div>' +
                '<div class="utility">' +
                    buttonArea(value.id,value.user_id) +
                '</div>'+
            '</header>'+                                
            '<div class="reply-content"><p>'+ value.content +'</p></div>' +
            '<div class="reply-content-update-form">' +
                '<form id="updateComment">' +
                    '<input type="hidden" id="commentId" value="'+ value.id +'">'+
                    '<input type="text" value="'+value.content+'" id="commentContent">'+
                    '<input type="submit" class="btn btn-success" value="수정">' +
                    '<button type="button" id="changeCancel" class="btn btn-danger">취소</button>' +
                '</form>'+
            '</div>'+
            '<ul class="bottom">'+
                '<li class="menu time">'+ value.created_at +'</li>'+
                '<li class="divider"></li>' +
                '<li class="menu show-reply">답변 수 ('+ value.subcomments.length+')</li>' +
            '</ul>'+
        '</div>'+
    '</div>'+
    '<div class="reply-form-place">' +
        '<form class="form reply-form" id="storeReplyComment">' +
            '<input type="hidden" id="parent_comment_id" value="'+ value.id +'">' +
            '<textarea placeholder="Reply" name="content" id="comment_content"></textarea>' +
            '<button type="submit" class="submit">등록하기</button>' +
        '</form>' +
    '</div>' +
'</div>';
}


function subCommentArea(subComments){
    var result = '';
    if(subComments.length > 0){
        $.each(subComments, function( index, value ) {
            result +='<div class="replies">' +
                        '<div class="reply">' +
                            '<div class="content">' +
                                '<header class="top">' +
                                    '<div class="username">'+value.user.name+'</div>' +
                                    '<div class="utility">' +
                                        subCommentButtonArea(value.id,value.user_id) +
                                    '</div>' +
                                '</header>' +
                                '<div class="reply-content"><p>'+ value.content+'</p></div>' +
                                '<div class="reply-content-update-form">' +
                                    '<form id="updateComment">' +
                                        '<input type="hidden" id="commentId" value="'+ value.id +'">'+
                                        '<input type="text" value="'+value.content+'" id="commentContent">' +
                                        '<input type="submit" class="btn btn-success" value="수정">' +
                                        '<button type="button id="changeCancel" class="btn btn-danger">취소</button>' +
                                    '</form>' +
                                '</div>' +
                                '<ul class="bottom">' +
                                    '<li class="menu time">'+value.created_at+'</li>' +
                                '</ul>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
        });
    }
    return result;
}

function storeComment(comment_content,parent_comment_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        url: '/comment/'+boardId,
        data: {
            content : comment_content,
            parent_comment_id : parent_comment_id
        },
        success: function(response) {
            if(response.status == '200'){
                getComments();
                alert(response.message);
            }else{
                console.log(response.message);
            }
        },
        error: function(xhr, ajaxOptions, thrownError){
            message = jQuery.parseJSON( xhr.responseText ).message;
            alert('댓글 작성 실패하였습니다. 이유: '+message);
            if (xhr.status == 401) {
                window.location.href = '/login';
            }
        }
    });
    return false;
}

function updateComment(commentId, commentContent){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'POST',
        url: '/comment/update/'+commentId,
        data: {
            _method: "PUT",
            content : commentContent

        },
        success: function(response) {
            if(response.status == '200'){
                getComments();
            }else{
                console.log(response.message);
            }
        },
        error: function(xhr, ajaxOptions, thrownError){
            message = jQuery.parseJSON( xhr.responseText ).message;
            alert('댓글 수정 실패하였습니다. 이유: '+message);
            if (xhr.status == 401) {
                window.location.href = '/login';
            }
        }
    });
    return false;
}

function destroyComment(commentId){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        url: '/comment/destroy/'+commentId,
        data: {
            _method: "DELETE",
        },
        success: function(response) {
            if(response.status == '200'){
                getComments();
            }else{
                console.log(response.message);
            }
        },
        error: function(xhr, ajaxOptions, thrownError){
            message = jQuery.parseJSON( xhr.responseText ).message;
            alert('댓글 삭제 실패하였습니다. 이유: '+message);
            if (xhr.status == 401) {
                window.location.href = '/login';
            }
        }
    });
    return false;
}

document.addEventListener("DOMContentLoaded", function () {
    getComments();

    $(document).on('click','#replyButton',function(){
        var replyForm = $(this).parents('.comment').siblings('.reply-form-place');
        if(replyForm.hasClass('active')){
            replyForm.removeClass('active');
        }else{
            replyForm.addClass('active');
        }
    });

    $(document).on('submit','#storeComment',function(event){
        event.preventDefault();
        var parent_comment_id = $(this).children('#parent_comment_id').val();
        var comment_content = $(this).children('#comment_content');

        storeComment(comment_content.val(),parent_comment_id);
        comment_content.val('');
    });

    $(document).on('submit','#storeReplyComment',function(event){
        event.preventDefault();
        var parent_comment_id = $(this).children('#parent_comment_id').val();
        var comment_content = $(this).children('#comment_content');

        storeComment(comment_content.val(),parent_comment_id);        
        comment_content.val('');
    });

    $(document).on('submit','#updateComment',function(event){
        event.preventDefault();
        commentId = $(this).children('#commentId').val();
        commentContent = $(this).children('#commentContent').val();
        updateComment(commentId,commentContent);
    });

    $(document).on('submit','#destroyComment',function(event){
        event.preventDefault();
        var commentId = $(this).children('#commentId').val();
        destroyComment(commentId);
    });

    $(document).on('click','#changeComment',function(){
        reply = $(this).parents('.top');
        replyForm = reply.siblings('.reply-content-update-form');
        replyContent = reply.siblings('.reply-content');        
        replyFormActive(replyForm,replyContent);
    });

    $(document).on('click','#changeCancel',function(){
        replyForm = $(this).parents('.reply-content-update-form');
        replyContent = replyForm.siblings('.reply-content');
        replyFormActive(replyForm,replyContent);
    });
});

function replyFormActive(replyForm, replyContent){
    if(replyForm.hasClass('active')){
        replyContent.removeClass('hide');
        replyForm.removeClass('active');
    }else{
        replyContent.addClass('hide');
        replyForm.addClass('active');
    }
}