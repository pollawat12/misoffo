$("#datatable-event").DataTable({
    "ordering": false,
    "bAutoWidth": false,
    "aoColumns": [
        { sWidth: '5%' },
        { sWidth: '35%' },
        { sWidth: '12%' },
        { sWidth: '22%' },
        { sWidth: '12%' },
        { sWidth: '20%' }
    ]
});

$("#datatable-expenses").DataTable({
    "ordering": false,
    "bAutoWidth": false,
    "aoColumns": [
        { sWidth: '5%' },
        { sWidth: '35%' },
        { sWidth: '12%' },
        { sWidth: '22%' },
        { sWidth: '12%' },
        { sWidth: '20%' }
    ]
});

$("#datatable-reports").DataTable({
    "ordering": false,
    "bAutoWidth": false,
    "aoColumns": [
        { sWidth: '5%' },
        { sWidth: '35%' },
        { sWidth: '20%' },
        { sWidth: '20%' },
        { sWidth: '20%' }
    ]
});

$("#datatable-progress").DataTable({ordering: false});

$("#datatable-indicators").DataTable({
    "ordering": false,
    "bAutoWidth": false,
    "aoColumns": [
        { sWidth: '8%' },
        { sWidth: '47%' },
        { sWidth: '15%' },
        { sWidth: '15%' },
        { sWidth: '15%' }
    ]
});

$("#datatable-goals").DataTable({
    "ordering": false,
    "bAutoWidth": false,
    "aoColumns": [
        { sWidth: '8%' },
        { sWidth: '75%' },
        { sWidth: '17%' }
    ]
});

$("#datatable-objective").DataTable({
    "ordering": false,
    "bAutoWidth": false,
    "aoColumns": [
        { sWidth: '8%' },
        { sWidth: '75%' },
        { sWidth: '17%' }
    ]
});

$("#datatable-employees").DataTable({
    "ordering": false
});

$("#datatable-items").DataTable({ordering: false});

$(".datepicker-autoclose").datepicker({
    autoclose: !0,
    todayHighlight: !0
});

tinymce.init({
    selector: '#input_project_description',
    toolbar_mode: 'floating',
    branding: false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : false,
    paste_auto_cleanup_on_paste : true,
    paste_remove_styles: true, height : "350",
});

tinymce.init({
    selector: '#input_project_reason',
    toolbar_mode: 'floating',
    branding: false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : false,
    paste_auto_cleanup_on_paste : true,
    paste_remove_styles: true, height : "350",
});

tinymce.init({
    selector: '#input_project_goal',
    toolbar_mode: 'floating',
    branding: false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : false,
    paste_auto_cleanup_on_paste : true,
    paste_remove_styles: true, height : "350",
});


tinymce.init({
    selector: '#update_progress-detail',
    toolbar_mode: 'floating',
    branding: false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : false,
    paste_auto_cleanup_on_paste : true,
    paste_remove_styles: true, height : "300",
});

tinymce.init({
    selector: '#update_obstruction-detail',
    toolbar_mode: 'floating',
    branding: false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : false,
    paste_auto_cleanup_on_paste : true,
    paste_remove_styles: true, height : "300",
});

tinymce.init({
    selector: '#update_solution-detail',
    toolbar_mode: 'floating',
    branding: false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : false,
    paste_auto_cleanup_on_paste : true,
    paste_remove_styles: true, height : "300",
});

tinymce.init({
    selector: '#update_progress-indicator-detail',
    toolbar_mode: 'floating',
    branding: false,
    force_br_newlines : true,
    force_p_newlines : false,
    forced_root_block : false,
    paste_auto_cleanup_on_paste : true,
    paste_remove_styles: true, height : "400",
});



$(function () {
    function callBackFunc(data) {
        var alertType = 'error';
        var alertTitle = 'แจ้งเตือน';
        var alertMsg = data.msg;
        var actionForm = $("input[name=action]").val();

        $(".btn-submit").attr("disabled", false);

        if (data.status) {
            setTimeout(() => {
                window.location.reload();
            }, 2300);
            ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
        } else {
            ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
        }
    }

    $('#frm-project-info').validate({
        rules: {
            'input[project_name]': {
                required: true
            }
        },
        messages: {
            'input[project_name]': {
                required: "กรุณาชื่อโครงการ"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $(".btn-submit").attr("disabled", "disabled");

            ajaxSubmitForm("frm-project-info", "json", callBackFunc);
            return false;
        }
    });


    function callBackFuncEventReport(data) {
        var alertType = 'error';
        var alertTitle = 'แจ้งเตือน';
        var alertMsg = data.msg;
        var actionForm = $("input[name=action]").val();

        $(".btn-submit").attr("disabled", false);

        if (data.status) {
            // setTimeout(() => {
            //     window.location.reload();
            // }, 2300);
            ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
        } else {
            ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
        }
    }

    $('#frm-event-report-save').validate({
        rules: {},
        messages: {},
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $(".btn-submit").attr("disabled", "disabled");

            ajaxSubmitForm("frm-event-report-save", "json", callBackFuncEventReport);
            return false;
        }
    });




    function callBackFuncObjective(data) {
        var alertType = 'error';
        var alertTitle = 'แจ้งเตือน';
        var alertMsg = data.msg;
        var actionForm = $("input[name=action]").val();

        $(".btn-submit").attr("disabled", false);

        if (data.status) {
            setTimeout(() => {
                window.location.reload();
            }, 2300);
            ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
        } else {
            ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
        }
    }

    $('#frm-objective-save').validate({
        rules: {
            'input[name]': {
                required: true
            }
        },
        messages: {
            'input[name]': {
                required: "กรุณาวัตถุประสงค์"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $(".btn-submit").attr("disabled", "disabled");

            ajaxSubmitForm("frm-objective-save", "json", callBackFuncObjective);
            return false;
        }
    });



    function callBackFuncGoal(data) {
        var alertType = 'error';
        var alertTitle = 'แจ้งเตือน';
        var alertMsg = data.msg;
        var actionForm = $("input[name=action]").val();

        $(".btn-submit").attr("disabled", false);

        if (data.status) {
            setTimeout(() => {
                window.location.reload();
            }, 2300);
            ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
        } else {
            ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
        }
    }

    $('#frm-goal-save').validate({
        rules: {
            'input[name]': {
                required: true
            }
        },
        messages: {
            'input[name]': {
                required: "กรุณาเป้าหมาย"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $(".btn-submit").attr("disabled", "disabled");

            ajaxSubmitForm("frm-goal-save", "json", callBackFuncGoal);
            return false;
        }
    });




    function callBackFuncUpdateIndicator(data) {
        var alertType = 'error';
        var alertTitle = 'แจ้งเตือน';
        var alertMsg = data.msg;
        var actionForm = $("input[name=action]").val();

        $(".btn-submit").attr("disabled", false);

        if (data.status) {
            setTimeout(() => {
                window.location.reload();
            }, 2300);
            ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
        } else {
            ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
        }
    }

    $('#frm-indicator-report-save').validate({
        rules: {},
        messages: {},
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $(".btn-submit").attr("disabled", "disabled");

            ajaxSubmitForm("frm-indicator-report-save", "json", callBackFuncUpdateIndicator);
            return false;
        }
    });



    function callBackFuncUpdateIndicator(data) {
        var alertType = 'error';
        var alertTitle = 'แจ้งเตือน';
        var alertMsg = data.msg;
        var actionForm = $("input[name=action]").val();

        $(".btn-submit").attr("disabled", false);

        if (data.status) {
            setTimeout(() => {
                window.location.reload();
            }, 2300);
            ajaxSweetAlert("success", data.msg, "แจ้งเตือน");
        } else {
            ajaxSweetAlert("error", data.msg, "แจ้งเตือน");
        }
    }

    $('#frm-project-save').validate({
        rules: {},
        messages: {},
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function () {
            $(".btn-submit").attr("disabled", "disabled");

            ajaxSubmitForm("frm-project-save", "json", callBackFuncUpdateIndicator);
            return false;
        }
    });



    
});