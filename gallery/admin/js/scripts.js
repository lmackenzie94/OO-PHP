$(document).ready(function () {
    let user_id;
    let image_name;
    let photo_id;

    // edit photo sidebar (dropdown)
    $('.info-box-header').click(function () {
        $('.inside').slideToggle('fast');
        $('#toggle').toggleClass(
            'glyphicon-menu-down glyphicon, glyphicon-menu-up glyphicon'
        );
    });

    $('.modal_thumbnails').click(function () {
        $('#set_user_image').prop('disabled', false);

        $(this).addClass('selected').siblings().removeClass('selected');
        user_id = $('#user-id').prop('href').split('=').at(-1);
        image_name = $(this).prop('src').split('/').at(-1);

        photo_id = $(this).attr('data');

        $.ajax({
            url: 'includes/ajax_code.php',
            data: { photo_id },
            type: 'POST',
            success: function (data) {
                if (!data.error) {
                    $('#modal_sidebar').html(data);
                }
            }
        });

        console.log('user-id', user_id);
        console.log('image-name', image_name);
    });

    $('#set_user_image').click(function () {
        $.ajax({
            url: 'includes/ajax_code.php',
            data: {
                user_id,
                image_name
            },
            type: 'POST',
            success: function (data) {
                if (!data.error) {
                    $('.user_image_box a').prop('src', data);
                }
            }
        });
    });

    // text editor for the admin
    $('#summernote').summernote({
        height: 150
    });

    // delete function

    $('.delete_link').click(function () {
        return confirm('Are you sure uou want to delete this item?');
    });
});
