(function ($) {

    $.widget("custom.selectFilter", {
        options: {},

        _create: function() {
            $.fn.filterData.select = 'select';
            console.log("selectFilter: ", $.fn.filterData);
        }
    });

})(jQuery);