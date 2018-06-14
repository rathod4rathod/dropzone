var FRONT_URL = location.protocol + '//' + location.host + '/my_projects/laravel/demo/'; // #LOCAL
//var FRONT_URL = location.protocol + '//' + location.host + '/daybreak_stage/'; // #LIVE
var FRONT_IMG_URL = FRONT_URL + 'webroot/img/'; //#LOCAL
var loader_div = '<div id="loadingDiv"><img src="' + FRONT_IMG_URL + 'loader.png" class="ajax-loader" alt="Loading..." /></div>';
var keyCode, clientName;
keyCode = clientName = "";
var LOGIN_URL = FRONT_URL + "login/";
var CLIENT_INVALID_URL = FRONT_URL + "openclientwindow/wrongkeycode/";
var clientLogin = 0;
// Bootstrap notify configuration.
var success_options = {
    type: 'success',
    allow_dismiss: true,
    newest_on_top: true,
    delay: 5000,
    onShow: function(){
        $("div[data-notify='container']:not(:last)").remove();
    },
    offset: {
        y: 10
    },
    placement: {
        from: "top",
        align: "center"
    }
};
var danger_options = {
    type: 'danger',
    allow_dismiss: true,
    newest_on_top: true,
    delay: 5000,
    onShow: function(){
        $("div[data-notify='container']:not(:last)").remove();
    },
    offset: {
        y: 10
    },
    placement: {
        from: "top",
        align: "center"
    }
};

$.extend(true, $.fn.dataTable.defaults, {
    "language": {
            "paginate": {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>', // or '→'
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>' // or '←' 
            }
        },
    "processing": true,
    "serverSide": true,
    "autoWidth": false,
    "preDrawCallback": function (settings) {
        var api = new $.fn.dataTable.Api(settings);
        var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
        var recordInfo  = $(this).closest('.dataTables_wrapper').find('.dataTables_info');
        var lengthInfo  = $(this).closest('.dataTables_wrapper').find('.dataTables_length');
        pagination.toggle(api.page.info().pages >= 1);
        recordInfo.toggle(api.page.info().pages >= 1);
        lengthInfo.toggle(api.page.info().pages >= 1);
    },
});

var somethingWentWrong = 'Something went wrong!!! Please try again later...';
var noDataFoundDownload = 'No data found to download.';
var noDataFoundPrint = 'No data found to print.';
var emailLimit  = 10;
var customPhone = new RegExp('^([\+][0-9]{1,9}[\ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9\ \.\-\/]{3,20})((x|ext|extension)[\ ]?[0-9]{1,4})?$');
var customEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var customIPV4 = /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/;
var customIPV6 = /^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$/;

var htmlStorageError = "Sorry, your browser does not support web storage.";    
/*$(document).ready(function () {
    //menu
    $('.sidebar-menu').tree()

    // ACORDEON
    $(".toggle-accordion").on("click", function () {
        var accordionId = $(this).attr("accordion-id"),
                numPanelOpen = $(accordionId + ' .collapse.in').length;
        $(this).toggleClass("active");
        if (numPanelOpen == 0) {
            openAllPanels(accordionId);
        } else {
            closeAllPanels(accordionId);
        }
    })

    openAllPanels = function (aId) {
        console.log("setAllPanelOpen");
        $(aId + ' .panel-collapse:not(".in")').collapse('show');
    }

    closeAllPanels = function (aId) {
        console.log("setAllPanelclose");
        $(aId + ' .panel-collapse.in').collapse('hide');
    }
    
    // Hide default flash success message of cakephp after 5 seconds.
    setTimeout(function () {
        $('.flash-message').fadeOut('slow');
    }, 5000);
    
    //Show loader on Ajax start and stop
    $(document).ajaxStart(function () {
        $('#loader_placeholder').html(loader_div);
    });
    $(document).ajaxComplete(function () {
        $('#loader_placeholder').html('');
    });
    
    //Force fully punch out functionality while logout

    $(document).on("click", "#signOut", function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            async: false,
            cache: false,
            datatype: "json",
            url: FRONT_URL + "timesheet/processPunchOutTime",
            success: function (response) {
                var obj = jQuery.parseJSON(response);
                if (parseInt(obj.FLAG) === 2)
                {
                    window.location = LOGIN_URL;
                }
                else
                {
                    window.location = FRONT_URL + "login/logout";
                }
            },
            error: function () {
                $('#loader_placeholder').html('');
                $.notify(somethingWentWrong, danger_options);
            }
        });
    });
});

// login
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    //switchery

    var elem = document.querySelector('.js-switch');
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {color: '#39b54a'});
    });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    //Date picker
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'mm/dd/yyyy',
        todayHighlight: true
    });
    
    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    });
    
    $(document).on("keypress", "input:text", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
});

// Function to initialize validation engine
function validationEngineInit(form_id)
{
    // For Form Submission    
    if (typeof $.validationEngine != 'undefined')
    {
        $("#" + form_id).validationEngine({
            validationEventTrigger: 'submit, focusout',
            showOneMessage: true,
            maxErrorsPerField: 1,
            scroll: false,
            promptPosition: "bottomLeft",
            validateNonVisibleFields: true
        });
    }
}*/