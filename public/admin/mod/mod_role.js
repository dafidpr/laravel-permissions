
var displayErrors = [
    {
        display: '#roleErr',
        inputName: 'role'
    }
];
$('.add').click(() => {
    $('#myModal form').attr('action', url + '/administrator/role/store');
})