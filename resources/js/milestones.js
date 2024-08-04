
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var projectId = $('.milestone-table').data('project-id');
    var table = $('.milestone-table').DataTable({
        processing: true,
        serverSide: true,
        method: "GET",
        ajax: "/projects/"+projectId+"/milestones/",
        pageLength: 15,
        columns: [
            {data: 'name', name: 'name'},
            {data: 'due_date', name: 'due_date'},
            {data: 'action', name: 'action'},
        ]
    });

    $('body').on('click', '.deleteMilestone', function(e) {
        e.preventDefault();
        var milestone_id = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Milestone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it",
        })
        .then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/projects/" + projectId +"/milestones/" + milestone_id,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(response) {
                        if (response.status === 'success') {
                            $(".milestone-table").DataTable().ajax.reload();
                            Swal.fire("Your milestone has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            Swal.fire("Oops! Something went wrong!", {
                                icon: "error",
                            });
                        }
                    },
                    error: function() {
                        Swal.fire("Oops! Something went wrong!", {
                            icon: "error",
                        });
                    }
                });
            }
        });
    });

    $('.milestoneValidation').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            statuses_id: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
                maxlength: "Name must not exceed 255 characters"
            },
            statuses_id: {
                required: "Plese Select milestone status",
            },
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            error.insertBefore(element.closest('.form-floating'));
        }
    });

    // $(".selectStatus").select2({
    //     placeholder: "Select Statuses",
    //     // multiple: true,
    // });
});
