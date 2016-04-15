(function ($) {
    $.widget( "custom.filterform", {

        filter: {},

        // Default options.
        options: {
        },

        _create: function () {
            console.log('filterform');
        },

        setFilter: function (name, data) {
            var self = this;

            self.filter[name] = data;
        },

        getFilter: function (name) {
            var self = this;

            return self.filter[name] ? self.filter[name] : false;
        },

        getAllFilter: function () {
            var self = this;

            return self.filter;
        },

        removeFilter: function (name) {
            var self = this;

            if (self.filter[name]) {
                delete self.filter[name];
            }
        }
    });
})(jQuery);