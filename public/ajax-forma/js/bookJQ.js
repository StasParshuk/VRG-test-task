jQuery(document).ready(function($){
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
        var image = jQuery('#image').prop('files')[0];
        e.preventDefault();
        var formData = new FormData();


        var name = jQuery('#name').val();
        var description = jQuery('#description').val();
        var author = jQuery('#authors').val();

        formData.append('image', image)
        formData.append('name', name)
        formData.append('description', description)
        formData.append('author', author)

        var state = jQuery('#btn-save').val();
        var todo_id = jQuery('#todo_id').val();

        $.ajax({
            type: 'POST',
            url: 'book/create',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                var todo =
                    '<tr id="todo' + data.id + '">' +
                    '<td>' + data.id + '</td>' +
                    '<td>' + data.name + '</td>' +
                    '<td>' + data.description + '</td>' +
                    '<td>' + '<img src="storage/' + data.image + '" className="img-fluid"  width="200px" height="200px" alt="no found">' + '</td>' +
                    '<td>' + new Date(data.created_at).toJSON().split('.')[0].split('T').join(' ') + '</td>' +
                    '<td>' + new Date(data.updated_at).toJSON().split('.')[0].split('T').join(' ') + '</td>' +
                    '<td>' + data.authors[0].first_name + data.authors[0].last_surname + data.authors[0].father_name + '</td>' +
                    '<td>' +
                    '<a href="/book/' + data.id + '">' + 'show</a>' + '</td>' +
                    '<a className="delete-button" href=""' + 'id="' + data.id + '"> delete</a>' + +
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
        var ajaxurl = 'book/' + id;

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            success: function (data) {
                $('#book' + id).remove()

            },
            error: function (data) {
                alert(data);
            }
        });
    });

});
