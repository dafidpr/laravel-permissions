var pathStoreUrl = "/administrator/roles/store";
var datatableUrl = "/administrator/roles/loadDatatable";
var displayErrors = [
    {
        display: '#roleErr',
        inputName: 'role'
    }
];

$('.edit').click(() => {
    let id = $(this).data('id');
    $('#myModal form').attr('action', '/administrator/roles/'+id+'/update');
    console.log(id);
    $.ajax({
        url: url + '/administrator/roles/'+ id +'/show',
        dataType: 'json',
        success:function(response){
            console.log(response);
            $('#role').val(response.name);
        } 
    });
})