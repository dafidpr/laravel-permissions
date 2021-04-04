var displayErrors = [
    {
        display: '#groupErr',
        inputName: 'group'
    },
    {
        display: '#optionErr',
        inputName: 'option'
    },
    {
        display: '#valueErr',
        inputName: 'value'
    }
];

function maintenanceMode(e){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url + '/administrator/settings/'+ e +'/maintenance',
        method:"post",
        dataType: "json",
        success: function (data) {
            Swal.fire({
                title: "Success",
                icon: "success",
                text: data.messages,
            });
        },
        error: function (xhr, ajaxOptioins, thrownError) {
            Swal.fire({
                title: xhr.status,
                icon: "warning",
                text: thrownError,
            });
        },
    });
}