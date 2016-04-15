<?php
echo "var filterObject = [
    {
        filter: 'ean',
        name: 'EAN',
        op: [
            {value: '=', text: 'is'},
            {value: 'contains', text: 'includes'},
            {value: 'notContains', text: 'does not include'},
            {value: 'startsWith', text: 'begins with'},
            {value: 'endsWith', text: 'ends with'}
        ],
        input: {
            name: 'value',
            text: 'EAN'
        },
        type: 'compare'
    },
    {
        filter: 'upc',
        name: 'UPC',
        op: [
            {value: '=', text: '='}
        ],
        input: {
            name: 'upcValue',
            text: 'UPC'
        },
        type: 'compare'
    },
    {
        filter: 'price',
        name: 'Price',
        op: [
            {value: '<', text: '<'},
            {value: '<=', text: '<='},
            {value: '=', text: '='},
            {value: '>=', text: '>='},
            {value: '>', text: '>'}
        ],
        input: {
            name: 'priceValue',
            text: 'Price'
        },
        type: 'compare'
    },
    {
        filter: 'description',
        name: 'Description',
        op: [
            {value: '=', text: 'is'},
            {value: 'contains', text: 'includes'},
            {value: 'notContains', text: 'does not include'},
            {value: 'startsWith', text: 'begins with'},
            {value: 'endsWith', text: 'ends with'}
        ],
        input: {
            name: 'descriptionValue',
            text: 'Description'
        },
        type: 'compare'
    },
    {
        filter: 'manufacturer',
        name: 'Manufacturer',
        op: [
            {value: '=', text: 'is'},
            {value: 'contains', text: 'includes'},
            {value: 'notContains', text: 'does not include'},
            {value: 'startsWith', text: 'begins with'},
            {value: 'endsWith', text: 'ends with'}
        ],
        input: {
            name: 'manufacturerValue',
            text: 'Manufacturer'
        },
        type: 'compare'
    },
    {
        filter: 'name',
        name: 'Name',
        op: [
            {value: '=', text: 'is'},
            {value: 'contains', text: 'includes'},
            {value: 'notContains', text: 'does not include'},
            {value: 'startsWith', text: 'begins with'},
            {value: 'endsWith', text: 'ends with'}
        ],
        input: {
            name: 'nameValue',
            text: 'Name'
        },
        type: 'compare'
    },
    {
        filter: 'productNumber',
        name: 'Product Number',
        op: [
            {value: '=', text: 'is'},
            {value: 'startsWith', text: 'begins with'}
        ],
        input: {
            name: 'productNumberValue',
            text: 'Product number'
        },
        type: 'compare'
    },
    {
        filter: 'stocklevel',
        name: 'Stock level',
        op: [
            {value: '<', text: '<'},
            {value: '<=', text: '<='},
            {value: '=', text: '='},
            {value: '>=', text: '>='},
            {value: '>', text: '>'}
        ],
        input: {
            name: 'stocklevelValue',
            text: 'Stocklevel'
        },
        type: 'compare'
    },
    {
        filter: 'forSale',
        name: 'For Sale',
        op: [
            {value: 'false', text: 'not for sale'},
            {value: 'true', text: 'for sale'}
        ],
        type: 'bool'
    },
    {
        filter: 'specialOffer',
        name: 'Special Offer',
        op: [
            {value: 'false', text: 'no special offer'},
            {value: 'true', text: 'special offer'}
        ],
        type: 'bool'
    }
];";
?>