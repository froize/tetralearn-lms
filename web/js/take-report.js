$('.accept').on('click', function () {

    var button = $(this);
    var report_id = button.data('report-id');
    $.ajax({
        type: "POST",
        url: "/course/take-report",
        data: {
            report_id: report_id,
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
                    message: 'Доклад взят!',
                    position: 'topRight'
                });

                setTimeout(function() {
                    button.addClass('dfx-btn-inactive');
                    button.text('Доклад взят');
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