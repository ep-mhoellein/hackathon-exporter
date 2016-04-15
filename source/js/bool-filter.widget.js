(function ($) {

    $.widget("custom.boolFilter", {
        options: {
            // filterform
        },

        _create: function() {
            var self = this,
                o = self.options,
                elem = self.element,
                radio = elem.find('input.bool-filter-radio:radio');

            // console.log("boolFilter: ", $.fn.filterData);
            // $.fn.filterData.bool = 'bool';

            // input handling
            radio = elem.find('input.bool-filter-radio:radio');

            radio.on('change', function () {
                var current;

                // register filter on filter form if necessary
                if (o.filterform.filterform('getFilter', o.data.filter) === false) {
                    // o.filterform.filterform('setFilter', o.data.filter, o.data);
                    o.filterform.filterform('setFilter', o.data.filter, {
                        type: o.data.type,
                        filter: o.data.filter,
                        //value: "...",
                        op: "=" //$(this).val()
                    });
                }

                // add current value
                current = o.filterform.filterform('getFilter', o.data.filter);
                $.extend(current, {value: $(this).val()});
                o.filterform.filterform('setFilter', o.data.filter, current);

                // ToDo: AJAX request (send AllFilter)
                $.ajax({
                    method: "POST",
                    url: o.filterURL,
                    data: o.filterform.filterform('getAllFilter')
                })
                .done(function( msg ) {
                    //console.log( "Data Saved: " + msg );
                    o.filterOutput.html(msg);
                });

            });


            // delete button handling
            self.delete = elem.find('.del');

            self.delete.on('click', function () {
                // if filter exists in filter object
                if (o.filterform.filterform('getFilter', o.data.filter) !== false) {
                    o.filterform.filterform('removeFilter', o.data.filter);
                }

                // radio.val('');
            });
        }
    });

})(jQuery);