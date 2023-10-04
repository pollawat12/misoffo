// -- javascript -- //
$(function () {

    $(document).on("click", ".btn-del", function () {
        var _id = $(this).attr("data-id");
        var _url = $(this).attr("data-url");
        ajaxConfirmDel(_id, _url);
    });
});

function resetForm(formId) {
    $("#" + formId)[0].reset();
}

function ajaxConfirmDel(_id, _url) {
    swal({
            title: "แจ้งเตือน",
            text: "คุณแน่ใจต้องการลบรายการนี้?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                type: "post",
                url: _url,
                dataType: "json",
                data: {
                    del_id: _id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status) {
                        $("#item-" + _id).remove();
                        ajaxSweetAlert("success", "ลบรายการสำเร็จ", "แจ้งแตือน");
                    } else {
                        ajaxSweetAlert("error", "ลบรายการไม่สำเร็จ", "แจ้งแตือน");
                    }
                }
            });
        });
}

function ajaxConfirmRoleDel(_id, _url) {
    swal({
            title: "แจ้งเตือน",
            text: "คุณแน่ใจต้องการลบรายการนี้?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",
            closeOnConfirm: false
        },
        function () {
            $.ajax({
                type: "post",
                url: _url,
                dataType: "json",
                data: {
                    emp_id: _id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status) {
                        ajaxSweetAlert("success", "ลบรายการสำเร็จ", "แจ้งแตือน");

                        setTimeout(() => {
                            window.location.href = $("#div-url-redirect").attr("data-url");
                        }, 2800);
                    } else {
                        ajaxSweetAlert("error", "ลบรายการไม่สำเร็จ", "แจ้งแตือน");
                    }
                }
            });
        });
}

function ajaxSubmitForm(formId, dataType, callBackFunc) {
    var formObj = $("#" + formId);
    var formUrl = formObj.attr("action");
    var formMethod = formObj.attr("method");
    var formData = formObj.serialize();


    $.ajax({
        type: formMethod,
        url: formUrl,
        dataType: dataType,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            callBackFunc(data);
        }
    });
    return false;
}

function ajaxSubmitFormImage(formId, dataType, callBackFunc) {
    var formObj = $("#" + formId);
    var formUrl = formObj.attr("action");
    var formMethod = formObj.attr("method");
    var formData = new FormData(formObj[0]);

    $.ajax({
        type: "POST",
        url: formUrl,
        dataType: dataType,
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            callBackFunc(data);
        }
    });
}

function ajaxSweetAlert(alertType, alertMsg, alertTitle, timeLimit = 2000) {
    swal({
        title: alertTitle,
        text: alertMsg,
        timer: timeLimit,
        type: alertType,
        showConfirmButton: false
    });
}

$(document).on("click", "#btn-icon-load-more", function () {
    var _lastId = $(this).attr("data-id");
    var _url = $(this).attr("data-url") + "/?last_id=" + _lastId;

    $.get(_url, function (data) {
        $("#btn-icon-load-more").attr("data-id", data.last_id);
        $("#icon-li-lasted").before(data.html_content);
    }, "json");
});

$(document).on("click", ".checked-icon-category", function () {
    var _checked = $(this);
    var _url = $("#default-url-app").attr("data-url");
    var _alertType = "error";
    if (_checked.is(':checked')) {
        var _checkedId = _checked.val();
        $.get(_url + "/bi/favorite/category/add/?icon_id=" + _checkedId, function (data) {
            $("#content-icon").append(data.html_icon);
            if (data.status) {
                _alertType = "success";
            }
            ajaxSweetAlert(_alertType, data.msg, "แจ้งเตือน", 2500);
        }, "json");
    } else {
        var _checkedId = _checked.val();
        $.get(_url + "/bi/favorite/category/del/?icon_id=" + _checkedId, function (data) {
            $("#icon-dashboard-" + _checkedId).remove();
            if (data.status) {
                _alertType = "success";
            }
            ajaxSweetAlert(_alertType, data.msg, "แจ้งเตือน", 2500);
        }, "json");
    }
});
