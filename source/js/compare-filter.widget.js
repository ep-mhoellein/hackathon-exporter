(function ($) {

    $.widget("custom.compareFilter", {
        options: {},

        _create: function() {
            var self = this,
                o = self.options,
                elem = self.element;

            self.input = elem.find('input.compare-filter-input'),
            self.select = elem.find('select.compare-filter-select');

            self.select.on('change', function (evt) {

                if (self.input.val().length > 0) {
                    self._sendFilter();

                    // // register filter on filter form if necessary
                    // if (o.filterform.filterform('getFilter', o.data.filter) === false) {
                    //     o.filterform.filterform('setFilter', o.data.filter, {
                    //         type: o.data.type,
                    //         filter: o.data.filter
                    //     });
                    // }

                    // // add current value
                    // current = o.filterform.filterform('getFilter', o.data.filter);
                    // $.extend(current, {
                    //     value: input.val(),
                    //     op: select.val()
                    // });

                    // o.filterform.filterform('setFilter', o.data.filter, current);

                    // // ToDo: AJAX request (send AllFilter)
                    // $.ajax({
                    //     method: "POST",
                    //     url: o.filterURL,
                    //     data: o.filterform.filterform('getAllFilter')
                    // })
                    // .done(function( msg ) {
                    //     //console.log( "Data Saved: " + msg );
                    //     o.filterOutput.html(msg);
                    // });
                }
            });

            self.input.on('keyup', function (evt) {
                if (self.select[0].selectedIndex > -1) {
                    //console.log('compareFilter - input ok', select.val(), input.val());
                    self._sendFilter();
                }
            });


            // delete button handling
            self.delete = elem.find('.del');

            self.delete.on('click', function () {
                // if filter exists in filter object
                if (o.filterform.filterform('getFilter', o.data.filter) !== false) {
                    o.filterform.filterform('removeFilter', o.data.filter);
                }

                self.input.val('');
                self.select[0].selectedIndex = 0;
            });
        },

        _sendFilter: function () {
            var self = this,
                o = self.options,
                elem = self.element,
                current;

                    // register filter on filter form if necessary
                    if (o.filterform.filterform('getFilter', o.data.filter) === false) {
                        o.filterform.filterform('setFilter', o.data.filter, {
                            type: o.data.type,
                            filter: o.data.filter
                        });
                    }

                    // add current value
                    current = o.filterform.filterform('getFilter', o.data.filter);
                    $.extend(current, {
                        value: self.input.val(),
                        op: self.select.val()
                    });

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

        }
    });

})(jQuery);