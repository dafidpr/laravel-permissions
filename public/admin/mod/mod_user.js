var displayErrors = [
    {
        display: '#nameErr',
        inputName: 'name'
    },
    {
        display: '#usernameErr',
        inputName: 'username'
    },
    {
        display: '#emailErr',
        inputName: 'email'
    },
    {
        display: '#passErr',
        inputName: 'password'
    },
    {
        display: '#roleErr',
        inputName: 'role'
    },
    {
        display: '#phoneErr',
        inputName: 'phone'
    },
    {
        display: '#blockErr',
        inputName: 'block'
    },
    {
        display: '#picErr',
        inputName: 'picture'
    },
    {
        display: '#currentPassErr',
        inputName: 'current_password'
    },
    {
        display: '#newPassErr',
        inputName: 'new_password'
    },
    {
        display: '#confirmPassErr',
        inputName: 'confirm_password'
    },
];

$('.block-user').click(function() {
    let id = $(this).data('id');
    const title = $(this).text();
    Swal.fire({
        title: title == "Block User" ? "Are you sure block user ?" : "Are you sure unblock user ?",
        icon: "warning",
        text: title == "Block User" ? "A blocked user cannot log in" : "Unblocked users can log in again",
        showConfirmButton: true,
        confirmButtonText: title == "Block User" ? "Yes, block it" : "Yes, unblock it",
        showCancelButton: true,
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/administrator/users/'+ id +'/block',
                method:"post",
                dataType: "json",
                success: function (data) {
                    Swal.fire({
						title: "Success",
						icon: "success",
						text: data.messages,
					}).then(function () {
						window.location.href = url + data.redirect;
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
    });
})