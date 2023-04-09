jQuery(document).ready(function ($) {
    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModal').modal('show');
    });
    // CREATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            first_name: jQuery('#first_name').val(),
            last_surname: jQuery('#last_surname').val(),
            father_name: jQuery('#father_name').val(),
            book: jQuery('#book').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var todo_id = jQuery('#todo_id').val();
        var ajaxurl = 'author/create';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var todo =
                    '<tr id="todo' + data.id + '">' +
                    '<td>' + data.id + '</td>' +
                    '<td>' + data.first_name + '</td>' +
                    '<td>' + data.last_surname + '</td>' +
                    '<td>' + data.father_name + '</td>' +
                    '<td>' + new Date(data.created_at).toJSON().split('.')[0].split('T').join(' ') + '</td>' +
                    '<td>' + new Date(data.updated_at).toJSON().split('.')[0].split('T').join(' ') + '</td>' +
                    '<td>' + data.books[0].name + '</td>' +
                    '<td>' +
                    '<a href="/author/' + data.id + '">' + 'show</a>' +
                    '<a className="delete-button" href=""' + 'id="' + data.id + '"> delete</a>' +
                    '</td>' +

                    '</tr>';
                if (state == "add") {
                    jQuery('#todos-list').append(todo);

                } else {
                    jQuery("#todo" + todo_id).replaceWith(todo);
                }
                jQuery('#myForm').trigger("reset");
                jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                alert(error)
                console.log(data);
            }
        });
    });

    $('.delete-button').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var id = $(this).attr('id');
        var type = "DELETE";
        var ajaxurl = 'author/' + id;

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            success: function (data) {
                $('#author' + id).remove()

            },
            error: function (data) {
                alert(data);
            }
        });
    });
});
