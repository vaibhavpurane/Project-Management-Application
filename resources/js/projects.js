
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('.project-table').DataTable({
        processing: true,
        serverSide: true,
        method: "GET",
        ajax: "/projects",
        pageLength: 15,
        columns: [
            {data: 'name', name: 'name'},
            {data: 'start_date', name: 'start_date'},
            {data: 'active', name: 'active',
                render: function(data, type, row){
                    if(data == 1){
                        return '<span class="badge rounded-pill bg-success fs-6"> Active </span>';
                    }
                    else{
                        return '<span class="badge rounded-pill bg-danger fs-6"> In-Active </span>';
                    }
                }
            },
            {data: 'action', name: 'action'},
        ]
    });

    $('body').on('click', '.deleteProject', function(e) {
        e.preventDefault();
        var project_id = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Project!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it",
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/projects/" + project_id,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(response) {
                        if (response.status === 'success') {
                            $(".project-table").DataTable().ajax.reload();
                            Swal.fire("Your product has been deleted!", {
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
                });
            }
        });
    });

    $('.projectValidation').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            start_date: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
                maxlength: "Name must not exceed 255 characters"
            },
            start_date: {
                required: "Please select starting date",
            },
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            error.insertBefore(element.closest('.form-floating'));
        }
    });

    $(".selectUser").select2({
        placeholder: "Select users",
        multiple: true,
    });
});
