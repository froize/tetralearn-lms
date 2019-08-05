$('.request_access').on('click', function () {

    var button = $(this);
    var course_id = button.data('course-id');

    button.html('<i class="fa fa-spinner"></i>Отправка заявки');

    $.ajax({
        type: "POST",
        url: "/course/enroll",
        data: {
            course_id: course_id,
            _csrf: yii.getCsrfToken()
        },

        success: function (response) {
            if (!response) {
                iziToast.error({
                    title: 'Ошибка сервера',
                    message: 'Пожалуйста обратитесь к администратору!',
                    position: 'topRight'
                });
            }
            else {
                iziToast.success({
                    title: 'Успешно',
                    message: 'Заявка отправлена!',
                    position: 'topRight'
                });

                setTimeout(function() {
                    button.addClass('dfx-btn-inactive');
                    button.text('Заявка отправлена');
                }, 1500);
            }
        },
        error: function (response) {
            iziToast.error({
                title: 'Ошибка сервера',
                message: 'Пожалуйста обратитесь к администратору!',
                position: 'topRight'
            });
        }
    });

    return false;
});