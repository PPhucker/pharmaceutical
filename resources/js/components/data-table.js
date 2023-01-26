global.$ = global.jQuery = require('jquery');

global.JSZip = require('jszip');

import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';

require('datatables.net-bs5');

const dt = require('datatables.net-bs5/js/dataTables.bootstrap5.min.js');

require('datatables.net-buttons-bs5');
require('datatables.net-buttons/js/buttons.colVis.js');
require('datatables.net-buttons/js/buttons.html5.js');
require('datatables.net-buttons/js/buttons.print.js');
require('datatables.net-colreorder-bs5');
require('datatables.net-datetime');
require('datatables.net-scroller-bs5');
require('datatables.net-searchbuilder-bs5');
require('datatables.net-searchpanes-bs5');
require('datatables.net-select-bs5');

pdfMake.vfs = pdfFonts.pdfMake.vfs;

/**
 * https://datatables.net/
 */
export class DataTable {
    __tableId;
    __localization;

    constructor(tableId, localization) {
        this.__tableId = tableId;
        this.__localization = localization;
    }

    /**
     * https://datatables.net/reference/option/dom
     *
     * @returns {string}
     * @private
     */
    get __dom() {
        return '<\'list-inline\'' +
            '<\'list-inline-item mb-1\'l>' +
            '<\'list-inline-item mb-1\'f>' +
            '<\'list-inline-item\'B>>' +
            '<\'row\'<\'col-sm-12\'r>>' +
            '<\'row\'<\'col-sm-12\'tr>>' +
            '<\'row\'<\'col-sm-12 col-md-5 pb-2\'i><\'col-sm-12 col-md-7\'p>>';
    }

    /**
     * https://datatables.net/reference/option/
     *
     * @returns {{scrollCollapse: boolean, colReorder: {enable: boolean, fixedColumnsRight: number}, renderer: string, dom: string, buttons: {dom: {button: {className: string}}, buttons: [{extend: string, split: [{extend: string, exportOptions: {columns: string}, text: HTMLUListElement},{extend: string, exportOptions: {columns: string}, text: HTMLUListElement},{extend: string, exportOptions: {columns: string}, text: HTMLUListElement}], exportOptions: {columns: string}, text: HTMLUListElement},{split: {extend: string, text}[], className: string, text: HTMLUListElement}]}, select: {style: string, items: string, blurable: boolean, info: boolean}, pageLength: number, language: {loadingRecords: *, search, infoEmpty: string, zeroRecords: string, paginate: {next: string, previous: string, last: string, first: string}, processing: *, emptyTable: string, infoFiltered: string, lengthMenu: string, info: string}, lengthMenu: (number[]|(number|*)[])[], fixedHeader: boolean, orderClasses: boolean, pagingType: string, orderCellsTop: boolean, processing: boolean, columnDefs: [{orderable: boolean, targets: number[]},{targets: number[], searchable: boolean}], order: (number|string)[][]}}
     * @private
     */
    get __options() {
        return {
            dom: this.__dom,
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-primary',
                    },
                },
                buttons: this.__buttons,
            },
            columnDefs: this.__columnDefs,
            language: this.__language,
            lengthMenu: this.__lengthMenu,
            pageLength: this.__pageLength,
            pagingType: this.__pagingType,
            order: this.__order,
            orderCellsTop: this.__orderCellsTop,
            orderClasses: this.__orderClasses,
            renderer: this.__renderer,
            processing: this.__processing,
            scrollCollapse: this.__scrollCollapse,
            colReorder: this.__colReorder,
            fixedHeader: this.__fixedHeader,
            select: this.__select,
        };
    }

    /**
     * https://datatables.net/reference/option/select
     *
     * @returns {{style: string, items: string, blurable: boolean, info: boolean}}
     * @private
     */
    get __select() {
        return {
            blurable: true,
            info: false,
            items: 'row',
            style: 'os',
            className: 'row-selected',
        };
    }

    /**
     * https://datatables.net/reference/option/buttons
     *
     * @returns {[{extend: string, split: [{extend: string, exportOptions: {columns: string}, text: HTMLUListElement},{extend: string, exportOptions: {columns: string}, text: HTMLUListElement},{extend: string, exportOptions: {columns: string}, text: HTMLUListElement}], exportOptions: {columns: string}, text: HTMLUListElement},{split: [{extend: string, text}], className: string, text: HTMLUListElement}]}
     * @private
     */
    get __buttons() {
        const saveAs = this.__localization.saveAs;

        return [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible',
                },
                text: this.__createButton('bi-printer'),

                split: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                        },
                        text: this.__createButton('bi-filetype-csv',
                            saveAs + ' CSV'),
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                        },
                        text: this.__createButton('bi-filetype-xls',
                            saveAs + ' EXCEL'),
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible',
                        },
                        text: this.__createButton('bi-filetype-pdf',
                            saveAs + ' PDF'),
                    },
                ],
            },
            {
                text: this.__createButton('bi-eye-slash'),
                className: 'btn-colvis rounded-start',

                split: [
                    {
                        extend: 'colvis',
                        text: this.__localization.hide,
                    },
                ],
            },
        ];
    }

    /**
     * https://datatables.net/reference/option/language
     *
     * @returns {{loadingRecords: *, search, infoEmpty: string, zeroRecords: string, paginate: {next: string, previous: string, last: string, first: string}, processing: *, emptyTable: string, infoFiltered: string, lengthMenu: string, info: string}}
     * @private
     */
    get __language() {
        return {
            emptyTable: this.__localization.noEntries,
            info: this.__localization.entries + ': _START_ - _END_ ' +
                this.__localization.of + ' _TOTAL_ ',
            infoEmpty: this.__localization.noEntriesToFind,
            infoFiltered: '',
            lengthMenu: this.__localization.show + ' _MENU_',
            loadingRecords: this.__localization.wait,
            paginate: {
                first: '«',
                previous: '‹',
                next: '›',
                last: '»',
            },
            processing: this.__localization.wait,
            search: this.__localization.search,
            zeroRecords: this.__localization.noEntries,
        };
    }

    /**
     * https://datatables.net/reference/option/colReorder
     *
     * @returns {{enable: boolean, fixedColumnsRight: number}}
     * @private
     */
    get __colReorder() {
        return {
            enable: true,
            fixedColumnsRight: 2,
            realtime: true,
        };
    }

    get __fixedHeader() {
        return true;
    }

    /**
     * https://datatables.net/reference/option/columnDefs
     *
     * @returns {[{orderable: boolean, targets: number[]},{targets: number[], searchable: boolean}]}
     * @private
     */
    get __columnDefs() {
        return [
            {
                orderable: false,
                targets: [-1, -2],
            },
            {
                searchable: false,
                targets: [-1, -2],
            },
        ];
    }

    /**
     * https://datatables.net/reference/option/pageLength
     *
     * @returns {number}
     * @private
     */
    get __pageLength() {
        return 20;
    }

    /**
     * https://datatables.net/reference/option/lengthMenu
     *
     * @returns {(number[]|(number|*)[])[]}
     * @private
     */
    get __lengthMenu() {
        return [
            [this.__pageLength, 50, 100, -1],
            [this.__pageLength, 50, 100, this.__localization.all],
        ];
    }

    /**
     * https://datatables.net/reference/option/pagingType
     *
     * @returns {string}
     * @private
     */
    get __pagingType() {
        return 'full_numbers';
    }

    /**
     * https://datatables.net/reference/option/order
     *
     * @returns {(number|string)[][]}
     * @private
     */
    get __order() {
        return [
            [0, 'asc'],
        ];
    }

    /**
     * https://datatables.net/reference/option/orderCellsTop
     *
     * @returns {boolean}
     * @private
     */
    get __orderCellsTop() {
        return true;
    }

    /**
     * https://datatables.net/reference/option/orderClasses
     *
     * @returns {boolean}
     * @private
     */
    get __orderClasses() {
        return false;
    }

    /**
     * https://datatables.net/reference/option/renderer
     *
     * @returns {string}
     * @private
     */
    get __renderer() {
        return 'bootstrap';
    }

    /**
     * https://datatables.net/reference/option/processing
     *
     * @returns {boolean}
     * @private
     */
    get __processing() {
        return true;
    }

    /**
     * https://datatables.net/reference/option/scrollCollapse
     *
     * @returns {boolean}
     * @private
     */
    get __scrollCollapse() {
        return true;
    }

    /**
     *
     * @param {string} iconClass
     * @param {string} buttonText
     * @returns {HTMLUListElement}
     * @private
     */
    __createButton(iconClass, buttonText = '') {
        const ul = document.createElement('ul');
        const liForIcon = document.createElement('li');
        const i = document.createElement('i');

        ul.classList.add('list-inline', 'mb-0');

        liForIcon.classList.add('list-inline-item', 'me-0');

        const liForButtonText = liForIcon.cloneNode();

        liForButtonText.classList.add('ms-1');
        liForButtonText.innerText = buttonText;

        i.classList.add('bi', iconClass, 'fs-5');

        liForIcon.append(i);

        ul.append(liForIcon, liForButtonText);

        return ul;
    }

    render() {
        new dt('#' + this.__tableId, this.__options);

        for (const button of document.getElementsByClassName(
            'dt-btn-split-drop')) {
            button.classList.remove('btn-secondary');
            button.classList.add('btn-sm', 'btn-primary');
        }

        let splitWrapperButtons = document.getElementsByClassName(
            'dt-btn-split-wrapper btn-group');

        for (const button of splitWrapperButtons) {
            if (button ===
                splitWrapperButtons[splitWrapperButtons.length - 1]) {
                break;
            }
            button.classList.add('pe-2');
        }
    }
}