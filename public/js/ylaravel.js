$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var editor = new wangEditor('content');
// 设置 headers（举例）
if (editor.config) {
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };
    editor.config.uploadImgUrl = '/posts/image/upload';
    editor.create();
}

$('.preview_input').change(function () {
    var file = event.currentTarget.files[0];
    var url = window.URL.createObjectURL(file);
    $(event.target).next(".preview_img").attr('src', url);
});

$('.like-button').click(function () {
    this_button = $(this);
    url_type = this_button.attr('like-value');
    user_id = this_button.attr('like-user');
    if (url_type == 1) {
        url = '/user/' + user_id + '/unfan';
    } else {
        url = '/user/' + user_id + '/fan';
    }
    $.ajax({
        type: "POST",
        url: url,
        data: {id: user_id},
        dataType: "json",
        success: function (data) {
            if (data.error != 0) {
                return;
            }
            if (data.type == 1){
                this_button.text('关注');
            } else{
                this_button.text('取消关注');
            }
            this_button.attr('like-value', data.type);
        }
    });
});