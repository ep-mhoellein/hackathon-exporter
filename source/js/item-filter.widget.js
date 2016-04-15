(function ($) {

    $.widget("custom.itemFilter", {
        options: {},

        _create: function() {
            $.fn.filterData.item = 'item';
            console.log("itemFilter: ", $.fn.filterData);
        }
    });

})(jQuery);