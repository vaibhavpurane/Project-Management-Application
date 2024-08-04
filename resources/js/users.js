
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        method: "GET",
        ajax: "/users",
        pageLength: 10,
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('body').on('click', '.deleteUser', function (e) {
        e.preventDefault();
        var user_id = $(this).data("id");
        console.log("response.status=>",user_id)
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this User!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it",
        })
        .then((result) => {
            // console.log("response.then=>")
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "/users/" + user_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        if (response.status === 'success') {
                            $(".data-table").DataTable().ajax.reload();
                            Swal.fire("User has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            Swal.fire("Oops! Something went wrong!", {
                                icon: "error",
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting project');
                        console.error(xhr.responseText);
                    }
                    // error: function (data) {
                    //     console.log('Error:', data);
                    //     toastr.error('Error deleting user', 'Error Alert');
                    // }
                });
            }
        });
    });


    $('.userValidation').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            role: {
                required: true
            },
            is_active: {
                required: true
            },
            colour_pallate: {
                required: true,
                maxlength: 6
            },
            image: {
                required: true,
                extension: "jpeg|png|jpg|gif"
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                maxlength: "Name must not exceed 255 characters"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Please enter your phone number",
                digits: "Please enter only digits",
                minlength: "Phone number must be exactly 10 digits",
                maxlength: "Phone number must be exactly 10 digits"
            },
            password: {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            },
            role: {
                required: "Please select a role"
            },
            is_active: {
                required: "Please select active status"
            },
            colour_pallate: {
                required: "Please enter a colour palette",
                maxlength: "Colour palette must be exactly 6 characters long"
            },
            image: {
                required: "Please upload an image",
                extension: "Please upload an image of type: jpeg, png, jpg, gif"
            }
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            error.insertBefore(element.closest('.form-floating'));
        }
    });

    $('#image').change(function() {
        previewImage(this);
    });
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.imagePreview').attr('src', e.target.result);
                // $('#preview').removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
});
