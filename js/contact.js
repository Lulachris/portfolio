(function($, portfolio, undefined) {

    'use strict';

    portfolio.contact = {
        sendMail: () => {
            var name = $('input[name="username"]').val();
            var mail = $('input[name="usermail"]').val();
            $.ajax({
                url: '/contact/sendMail',
                method: 'POST',
                dataType: 'json',
                data: { name: name, mail: mail }
            }).
            done(() => {
                alert('success');
            }).
            fail((data) => {
                console.log(data.responseText);
            }).
            always((data) => {
                console.log(data);
            });
        }
    };

}(jQuery, window.portfolio = window.portfolio || {}));