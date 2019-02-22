(function($, portfolio, undefined) {

    'use strict';

    portfolio.content = {
        menuClick: (menuItem) => {
            $.ajax({
                url : menuItem,
                method : 'GET',
                data: { first: 0 },
                dataType: 'json'
            }).
            done(() => {

            }).
            fail(() => {

            });
        }
    };

    $(document).ready(function() {
        $('.navbar-nav > .nav-item > .nav-link').click(function () {
            portfolio.content.menuClick($(this).attr('href'));
        });
    });

}(jQuery, window.portfolio = window.portfolio || {}));