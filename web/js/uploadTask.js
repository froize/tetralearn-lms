$('#upload-answer').click(function () {
    $('#uploadfile-file').click();
    $('#uploadedTask').on('change', function () {
        var formData = $('#uploadingTask').serialize();
        $.ajax({
            type: 'POST',
            url: '/task/view?id=6',
            data: formData,
            idmodel: $('#idmodel').val(),
            success: function (data) {
                alert(data);
            },
            error: function (xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });

    });

});