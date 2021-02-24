var pathStoreUrl = "/administrator/permissions/store";
var datatableUrl = "/administrator/permissions/loadDatatable";

var dataColumns = [
    {
        data: null,
        width: '1%',
        sClass: 'text-center',
        orderable: false,
        render: function(data, type, row, meta){
            return meta.row + meta.settings._iDisplayStart + 1;
        }
    },
    {data: 'name', name: 'name'},
    {data: 'guard_name', name: 'guard_name'},
    {
        data: 'id',
        width: '90px',
        sClass: 'text-center',
        render: function(data){
            return `<ul class="nk-tb-actions gx-1">
            <li>
                <div class="drodown">
                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="link-list-opt no-bdr">
                            <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Permission</span></a></li>
                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete Permission</span></a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>`
        }
    }
];

var displayErrors = [
    {
        display: '#permissionNameErr',
        inputName: 'name'
    },
    {
        display: '#permissionErr',
        inputName: 'permission'
    }
];
