$(document).ready(function ()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#createForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function (response) {
                var taskHtml = response.taskHtml;
                var targetColumn = response.statusId;
                $('#'+targetColumn).append(taskHtml);
                $('#createTaskModal').modal('hide');
                $('#createForm')[0].reset();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });



    $(".connectedSortable").sortable({
        connectWith: ".connectedSortable",
        placeholder: "ui-state-highlight",
        dropOnEmpty: true,
        update: function(event, ui) {
            var taskIds = $(this).find('li').map(function() {
                return $(this).data('task-id');
            }).get();
            var statusId = $(this).attr('id');
            var url = $(this).attr('route');
            var isStatusChanged = $(this).find('li[data-task-id="' + ui.item.data('task-id') + '"]');
            if (isStatusChanged) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        taskIds: taskIds,
                        statusId: statusId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log("succesfully done");
                    },
                    error: function (xhr, status, error) {
                        console.error("error ", error);
                    }
                });
            } else {
                $.ajax({
                    url: url + "/list",
                    method: 'POST',
                    data: {
                        taskIds: taskIds,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log("succesfully");
                    },
                    error: function (xhr, status, error) {
                        console.error("there is an error ", error);
                    }
                });
            }
        }
    }).disableSelection();












});
