var datatableUrl = "/administrator/menus/loadDatatable";
var displayErrors = [
    {
        display: "#titleErr",
        inputName: "title",
    },
    {
        display: "#urlErr",
        inputName: "url",
    },
    {
        display: "#positionErr",
        inputName: "position",
    },
    {
        display: "#targetErr",
        inputName: "target",
    },
    {
        display: "#typeErr",
        inputName: "type",
    },
    {
        display: "#groupErr",
        inputName: "group",
    },
];

$('#type_menu').on('change', function(){
    let val = $(this).val();
    if(val == 'Frontend'){
        $('#menu_group_select').append($("<option></option>").attr("value", "null").text("None")); 
        // $('#menu_group_select').html('<input type="text" class="form-control" name="group" autocomplete="off" value="None" readonly>');
        $('#menu_group_select').val('null');
        $('#menu_group_select').attr('disabled', 'disabled');
        
    } else {
        $('#menu_group_select').attr('disabled', false);
        $('#menu_group_select option[value="null"]').remove();
    }
})
