function lecture_pagination(allData,sort=null){
    var result = '';
    if(typeof allData.data !== 'undefined' && allData.data.length > 0)
    {
        $.each(allData.data, function(key, item){
            if(allData.data.length % 2 ==0){
                //전체개수가 짝수
                if(key %  2 == 0){
                    result += firstColumn(item.id,item.file.id,item.name,item.instructor_name,item.platform,item.heart);
                }else{
                    result += secondColumn(item.id,item.file.id,item.name,item.instructor_name,item.platform,item.heart);
                    result += '<br>';
                }
            }else{
                //전체 개수가 홀수
                if(key %  2 == 0){
                    //첫번째 콜럼에서 맨 마지막인 경우
                    if(key == allData.data.length-1){
                        result += firstColumnWhenOddLast(item.id,item.file.id,item.name,item.instructor_name,item.platform,item.heart);
                        result += '<br>';
                    }else{
                        result += firstColumn(item.id,item.file.id,item.name,item.instructor_name,item.platform,item.heart);
                    }
                }else{
                    result += secondColumn(item.id,item.file.id,item.name,item.instructor_name,item.platform,item.heart);
                    result += '<br>';
                }
            }

            if(key == allData.data.length-1){
                if(allData.last_page > 1){
                    result += '<br>';
                    result += '<div class="d-flex justify-content-end">';
                    result += '<nav aria-label="Page navigation example">';
                    result += '<ul class="pagination">';
                    for(let i = 0; i<allData.links.length; i++){
                        result += paginationNumber(i, allData.current_page,allData.links);
                    }
                    
                    result += '</ul>';
                    result += '</nav>';
                    result += '</div>';
                }
            }
        });
    }
    else
    {
        result = '<div class="row">' +
                    '<div class="col"> 리스트가 존재하지 않습니다.</div>' +
                 '</div>';
    }
    $('#table_data').html(result);
}

function getHeart(heart){
    if(heart == 1){
        return '<i class="bi bi-heart-fill"></i>';   
    }else{
        return '<i class="bi bi-heart"></i>';
    }
}

function firstColumn(id, fileId, name, instructor_name,platform,isHeart){
result = '<div class="row">' + 
'<div class="col-sm-6">' +
    '<div class="card width18">' +
        '<div class="ms-auto">' +
            getHeart(isHeart) +
        '</div>'+
        '<a href="lecture/show/'+ id + '">' +
            '<img class="card-img-top" src="file/imageDownload/'+ fileId+ '"'+'width="300" height="200">' +
            '<div class="card-body">' +
                '<h5 class="card-title">'+ name +'</h5>' +
                '<p class="card-text">'+ '강사이름 : '+ instructor_name +'</p>';

result += platformInfo(platform);

result +=   '</div>' +
        '</a>' +
    '</div>' +
'</div>';

return result;
}

function firstColumnWhenOddLast(id, fileId, name, instructor_name, platform,isHeart){
result = '<div class="row">' + 
    '<div class="col-sm-6">' +
        '<div class="card width18">' +
            '<div class="ms-auto">' +
                getHeart(isHeart) +
            '</div>'+
            '<a href="lecture/show/'+ id + '">' +
            '<img class="card-img-top" src="file/imageDownload/'+ fileId+ '"'+'width="300" height="200">' +
            '<div class="card-body">' +
                '<h5 class="card-title">'+ name +'</h5>' +
                '<p class="card-text">'+ '강사이름 : '+ instructor_name +'</p>';

result += platformInfo(platform);

result +=   '</div>' +
        '</a>' +
        '</div>' +
    '</div>' +
    '<div class="col-sm-6">' +
    '</div>'+
'</div>';

return result;
}

function secondColumn(id, fileId, name, instructor_name,platform,isHeart){
result = '<div class="col-sm-6">' +
            '<div class="card width18">' +
                '<div class="ms-auto">' +
                    getHeart(isHeart) +
                '</div>'+
                '<a href="lecture/show/'+ id + '">' +
                    '<img class="card-img-top border0" src="file/imageDownload/'+ fileId+ '"'+'width="300" height="200">' +
                    '<div class="card-body">' +
                        '<h5 class="card-title">'+ name +'</h5>' +
                        '<p class="card-text">'+ '강사이름 : '+ instructor_name +'</p>';

result += platformInfo(platform);

result +=               '</div>' +
                    '</a>' +
                '</div>' +
            '</div>'+
        '</div>';

return result;
}

function platformInfo(platform){
    result = '';
    platform.forEach(function (item){
        result += `<p class="card-text">플랫폼 : ${item.platform_name}</p>`;
        result += `<p class="card-text">가격 : ${item.price}</p>`;
    });
    return result;
}

function paginationNumber(i, current_page, links){
    return '<li class="page-item'+ (links[i]?.label == current_page ? ' active' : '') +'">' +
        '<a href="#" id="pagination" class="page-link" value="'+ links[i]?.url +'">'+ links[i]?.label +'</a>' +
    '</li>';
}

function previousButton(prev_page_url){
    return '<li class="page-item">' +
        '<a href="#" id="pagination" class="page-link"'+ (prev_page_url ? "" : "disabled") + ' value="'+ prev_page_url+'">'+
        '<span class="sr-only">Previous</span>' +
        '</a>'+
    '</li>';
}

function nextButton(next_page_url){
return  '<li class="page-item">' +
            '<a href="#" id="pagination" class="page-link" class="btn"'+ (next_page_url ? "" : "disabled") + ' value="'+ next_page_url+'">'+
            '<span class="sr-only">Next</span>' +
            '</a>'+
        '</li>';
}

function getCategory(){
    return new URL(document.URL).searchParams.get("category_id");
}

function getBrands(){
    var brands = [];
    $('.form-check-input:checked').each(function(){
        brands.push($(this).val());
    });
    return brands;
}

function getSort(){
    return $('#sort').find(":selected").val();
}

function getSearch(){
    return new URL(document.URL).searchParams.get("search");
}

function getSubName(){
    return new URL(document.URL).searchParams.get("name");
}

function fetch_data(page=1,sort=null,category_id=null,brands=null,search=null,name=null){
    $.ajax({
        type:'get',
        url:"/lecture/ajax_data",
        data : {
            page : page,
            sort : sort,
            category_id : category_id,
            brands : brands,
            search : search,
            name : name
        },
        success:function(result){
            lecture_pagination(result,sort);
        }
    });
}


document.addEventListener("DOMContentLoaded", function(){
    fetch_data(1,null,getCategory(),null,getSearch(),getSubName());

    if(getSearch() != '' && typeof(getSearch()) !='undefined'){
        $('#search').val(getSearch());
    }

    $(document).on('click', '#pagination', function(event){
        event.preventDefault(); 
        var page = $(this).attr('value').split('page=')[1];

        try{
            if(page !=undefined){
                fetch_data(page,getSort(),getCategory(),getBrands(),getSearch(),getSubName());
            }else{
                throw new Error('이상한 page 값');
            }
        }catch(error){
            console.log(error.message);   
        }
    });

    $(document).on('change', '#sort', function(event){
        fetch_data(1,getSort(),getCategory(),getBrands(),getSearch(),getSubName());
    });

    $(document).on('click','.form-check-input',function(event){
        fetch_data(1,getSort(),getCategory(),getBrands(),getSearch(),getSubName());
    });

    
});