$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var userRoleDataTable   = $("#user_role_grid").DataTable({
        "processing": true,
        "serverSide": true,
        "language": {
            //processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw" style="opacity: 0.6;color:#1b731b;"></i><span class="sr-only"></span> ',
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>', // or '>'
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>', // or '<' 
            }
        },
        "pageLength": 10,
        "aaSorting": [[0, "desc"]],
        "sDom": 'Rfrtlip',
        "columns": [
            {"data": "id", "sortable": true, "searchable": true},
            {"data": "st_role_name", "sortable": true, "searchable": true},
            {"data": "in_role_status", "sortable": false, "searchable": true},
            {"data": "md5_in_role_id", "sortable": false, "searchable": true},
               
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            //action = '<a href="' + FRONT_URL + 'user/edit/' + aData['md5_in_user_id'] + '" name="btn_edit" id="btn_edit" class="data-edit" title="Edit Client"><i class="fa fa-pencil-square-o"></i></a>';
            //$('td', nRow).eq(3).html(action);
        },
        'fnCreatedRow': function (nRow, aData, iDataIndex) {
            
        },
        "ajax": {
            url: FRONT_URL + "roles", // json datasource
            type: "post", // method  , by default get
            error: function () {  // error handling

            },
            complete: function (response) {
                var obj = jQuery.parseJSON(response.responseText);
                if (parseInt(obj.FLAG) == 2) {
                    window.location = LOGIN_URL;
                }
            },
        },
        "columnDefs": [
            {
                "targets": 2,
                "data": "in_role_status",
                "render": function(data) {
                    if(data == 1) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                }
            }, 
            {
                "targets": 3,
                "data": "md5_in_role_id",
                "render": function(data) {
                    return '<a href="' + FRONT_URL + 'roles/edit/' + data + '" name="btn_edit" id="btn_edit" class="data-edit" title="Edit Client"><i class="fa fa-pencil-square-o"></i></a>'
                }
            },
        ],
        "initComplete": function() {
            
        },
        "footerCallback": function (row, data, start, end, display) {
            
        }
    });
});