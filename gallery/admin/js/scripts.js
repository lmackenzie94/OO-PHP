$(document).ready(function () {
    $('.modal_thumbnails').click(function () {
        $('#set_user_image').prop('disabled', false);

        const user_id = $('#user-id').prop('href').split('=').at(-1);
        const image_name = $(this).prop('src').split('/').at(-1);

        console.log('user-id', user_id);
        console.log('image-name', image_name);
    });

    // text editor for the admin
    $('#summernote').summernote({
        height: 150
    });
});
