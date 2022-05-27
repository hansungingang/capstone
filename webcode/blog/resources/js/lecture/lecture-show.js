function getDamoaReviews() {
    $.ajax({
        type: "get",
        url: "/review/" + getLectureId(),
        success: function (result) {
            console.log(result);
        },
    });
}

function getDamoaReviewPagination(page) {
    $.ajax({
        type: "get",
        url: "/review/" + getLectureId() + "?page=" + page,
        success: function (result) {
            console.log(result);
            var str = "";
            var str2 = "";
            $.each(result.data.data, function (i) {
                str += "<TR>";
                str +=
                    "<TD>" +
                    "유저 이름 : " +
                    result.data.data[i].user.name +
                    "</TD><TD>" +
                    result.data.data[i].content +
                    "</TD><TD>" +
                    "난이도 : " +
                    result.data.data[i].difficulty +
                    "</TD><TD>" +
                    "별점 : " +
                    result.data.data[i].star +
                    "</TD>";

                str += "</TR>";
            });
            if (result.data.last_page > 1) {
                str2 += "<br>";
                str2 += '<div class="d-flex justify-content-end">';
                str2 += '<nav aria-label="Page navigation example">';
                str2 += '<ul class="pagination">';
                for (let i = 0; i < result.data.links.length; i++) {
                    str2 += paginationNumber(
                        i,
                        result.data.current_page,
                        result.data.links
                    );
                }

                str2 += "</ul>";
                str2 += "</nav>";
                str2 += "</div>";
            }
            $("#result").html(str);
            $("#page").html(str2);
        },
    });
}

function paginationNumber(i, current_page, page_link) {
    return (
        '<li class="page-item' +
        (page_link[i]?.label == current_page ? " active" : "") +
        '">' +
        '<a href="#" id="pagination" class="page-link" value="' +
        page_link[i]?.url +
        '">' +
        page_link[i]?.label +
        "</a>" +
        "</li>"
    );
}

function getPlatformReview() {
    $.ajax({
        type: "get",
        url: "/platform_review/" + getLectureId(),
        success: function (result) {
            console.log(result);
        },
    });
}

function getLectureId() {
    return $("#lecture_id").val();
}

window.ingangDamoaSetColor = function (button) {
    if (button.className == "btn") {
        document
            .getElementById("platform_review")
            .classList.remove("btn-success");
        button.classList.add("btn-success");
        $("#divToggle").show();
    }
};

window.platformSetColor = function (button) {
    if (button.className == "btn") {
        document
            .getElementById("ingangdamoa_review")
            .classList.remove("btn-success");
        button.classList.add("btn-success");
        $("#divToggle").hide();
    }
};

document.addEventListener("DOMContentLoaded", function () {
    getDamoaReviewPagination(1);
    $(document).on("click", "#pagination", function (event) {
        event.preventDefault();
        var page = $(this).attr("value").split("page=")[1];
        try {
            if (page != undefined) {
                getDamoaReviewPagination(page);
            } else {
                throw new Error("이상한 page 값");
            }
        } catch (error) {
            console.log(error.message);
        }
    });
});
