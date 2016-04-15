var mock = [
    {
        filter: 'category',
        name: 'category',
        op: [
            {value: '0', text: 'Schuhe'},
            {value: '1', text: 'Hemden'},
            {value: '2', text: 'Hosen'}
        ],
        type: 'select'
    },
    {
        filter: 'visibility',
        name: 'visibility',
        op: [
            {value: '0', text: 'hoch'},
            {value: '1', text: 'tief'}
        ],
        type: 'bool'
    },
    {
        filter: 'new',
        name: 'new',
        op: [
            {value: 'n', text: 'nein'},
            {value: 'y', text: 'ja'}
        ],
        type: 'bool'
    },
    {
        filter: 'period',
        name: 'period',
        op: [
            {value: '0', text: 'null'},
            {value: '1', text: 'eins'},
            {value: '2', text: 'zwei'},
            {value: '3', text: 'drei'},
            {value: '4', text: 'vier'}
        ],
        type: 'item'
    },
    {
        filter: 'stocklevel',
        name: 'stocklevel',
        op: [
            {value: '0', text: '<'},
            {value: '1', text: '='},
            {value: '2', text: '>'}
        ],
        input: {
            name: 'tollername',
            text: 'TollesFeld'
        },
        type: 'compare'
    },
    {
        filter: 'horst',
        name: 'horst',
        op: [
            {value: '0', text: '<'},
            {value: '1', text: '='},
            {value: '2', text: '>'}
        ],
        input: {
            name: 'horstname',
            text: 'horstfeld'
        },
        type: 'compare'
    }
];



(function ($, filterObject) {
    $(function () {
        var filterData = {},
            tmpls = {
                'select': 'templates/select.mst',
                'compare': 'templates/compare.mst',
                'item': 'templates/item.mst',
                'bool': 'templates/bool.mst'
            },

            tmplObj = {},

            loadTmpl = function (tmpl, key) {
                $.get(tmpl, function(template) {
                    tmplObj[key] = template;
                    // var rendered = Mustache.render(template, {name: "Luke"});

                    // $(target).html(rendered);

                    delete tmpls[key];

                    if (Object.keys(tmpls).length === 0) {
                        loadReady();
                    }
                    // console.log('loadTmpl: ', Object.keys(tmpls).length);

                    // fillTemplate({name: "Lucky "}, target);
                    // fillTemplate({name: "Luke"}, target);
                });
            },

            fillTemplate = function (obj) {
                var rendered = Mustache.render(tmplObj[obj.type], obj.data);

                rendered = $(rendered);

                // $(obj.target).html($(obj.target).html() + rendered);
                $(obj.target).append(rendered);

                rendered[obj.type + "Filter"]({
                    data: obj.data,
                    //filterData: filterData,
                    filterform: form,
                    filterURL: filterURL,
                    filterOutput: filterOutput
                });
            },

            loadReady = function () {
                var target = $('#formFields'),
                    i;

                for (i=0; i<filterObject.length; i++) {
                    fillTemplate({
                        type: filterObject[i].type,
                        data: filterObject[i],
                        target: target
                    });
                }
            },

            form = $('form.filterform:first'),
            filterOutput = $('#responseContainer'),
            filterURL = "php/filter-request.php",
            exportLink = $('#exportLink'),
            _key;

        form.filterform();

        exportLink.on('click', function (evt) {
            evt.preventDefault();

            var filter = form.filterform('getAllFilter');

            // ToDo: AJAX request (send AllFilter)
            // $.ajax({
            //     method: "POST",
            //     url: "php/csv_export.php",
            //     data: filter
            // })
            // .done(function( msg ) {
            //     // console.log( "Data Saved: ", msg );
            //     window.location = "php/csv_export.php";
            // });

            window.location = "php/csv_export.php?" + $.param(filter);
        });

        for (_key in tmpls){
            if (tmpls.hasOwnProperty(_key)) {
                loadTmpl(tmpls[_key], _key);
            }
        }

    });
})(jQuery, filterObject);