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

/* Create an array with the values of all the input boxes in a column */
$.fn.dataTable.ext.order['dom-text'] = function(settings, col) {
    return this.api().
        column(col, {order: 'index'}).
        nodes().
        map(function(td) {
            return $('input', td).val();
        });
};

/**
 * https://datatables.net/
 */
const DataTableConfig = (settings) => ({
    /**
     * Отложенный рендеринг.
     *
     * @link https://datatables.net/reference/option/deferRender
     */
    _deferRender: true,
    /**
     * Количество строк на странице.
     *
     * @link https://datatables.net/reference/option/pageLength
     */
    _pageLength: settings.pageLength ?? 50,
    /**
     * Настройки расширения Select.
     *
     * @link https://datatables.net/reference/option/select
     */
    _select: {
        blurable: true,
        info: false,
        items: 'row',
        style: 'os',
        className: 'row-selected',
    },

    /**
     * Параметры отображения кнопки пагинации.
     *
     * @link https://datatables.net/reference/option/pagingType
     */
    _pagingType: 'full_numbers',
    /**
     * Начальный порядок (сортировка), применяемый к таблице.
     *
     * @link https://datatables.net/reference/option/order
     */
    _order: [],
    /**
     * @link https://datatables.net/reference/option/orderCellsTop
     */
    _orderCellsTop: true,
    /**
     * Выделить столбцы, которые упорядочиваются в теле таблицы.
     *
     * @link https://datatables.net/reference/option/orderClasses
     */
    _orderClasses: false,
    /**
     * Отображение типов рендеринга компонентов.
     *
     * @link https://datatables.net/reference/option/renderer
     */
    _renderer: 'bootstrap',
    /**
     * Индикатор обработки.
     *
     * @link https://datatables.net/reference/option/processing
     */
    _processing: true,
    /**
     * Разрешить уменьшать высоту когда отображается
     * ограниченное количество строк.
     *
     * @link  https://datatables.net/reference/option/scrollCollapse
     */
    _scrollCollapse: true,
    /**
     * Фиксированный заголовок.
     *
     * @link https://datatables.net/reference/option/fixedHeader
     */
    _fixedHeader: true,
    /**
     * Параметры библиотек DataTable.
     *
     * @link https://datatables.net/reference/option/
     * @private
     */
    _options: function() {
        return {
            dom: this._dom(),
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-primary',
                    },
                },
                buttons: this._buttons(),
            },
            deferRender: this._deferRender,
            columnDefs: this._columnDefs(),
            language: this._language(),
            lengthMenu: this._lengthMenu(),
            pageLength: this._pageLength,
            pagingType: this._pagingType,
            order: this._order,
            orderCellsTop: this._orderCellsTop,
            orderClasses: this._orderClasses,
            renderer: this._renderer,
            processing: this._processing,
            scrollCollapse: this._scrollCollapse,
            fixedHeader: this._fixedHeader,
            select: this._select,
        };
    },
    /**
     * Элементы управления таблицей, которые будут отображаться на странице,
     * и в каком порядке.
     *
     * @link https://datatables.net/reference/option/dom
     * @returns {string}
     * @private
     */
    _dom: () => {
        let dom;
        switch (settings.tableType) {
            case 'edit':
                dom = '<\'row\'<\'col-sm-12\'r>>' +
                    '<\'row\'<\'col-sm-12\'tr>>';
                break;
            case 'create':
                dom = '<\'list-inline\'' +
                    '<\'list-inline-item mb-1\'f>>' +
                    '<\'row\'<\'col-sm-12\'r>>' +
                    '<\'row\'<\'col-sm-12\'tr>>';
                break;
            default:
                dom = '<\'list-inline\'' +
                    '<\'list-inline-item mb-1\'l>' +
                    '<\'list-inline-item mb-1\'f>' +
                    '<\'list-inline-item\'B>>' +
                    '<\'row\'<\'col-sm-12\'r>>' +
                    '<\'row\'<\'col-sm-12\'tr>>' +
                    '<\'row\'<\'col-sm-12 col-md-5 pb-2\'i>' +
                    '<\'col-sm-12 col-md-7\'p>>';
        }
        return dom;
    },

    /**
     * Возвращает объект конфигурации кнопок.
     *
     * @link https://datatables.net/reference/option/buttons
     * @private
     */
    _buttons: function() {
        const saveAs = settings.localization.buttons.save_as;
        const caption = document.getElementById(
            'caption_' + settings.tableId,
        );
        const title = '<div class=\'text-center fw-bold fs-5\'>' +
            caption.innerText + '</div>';
        const exportTitle = caption.innerText;

        caption.innerText = '';

        return [
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible',
                    rows: function(idx, data, node) {
                        return (!$(node).hasClass('trashed'));
                    },
                    format: {
                        body: function(data, row, column, node) {
                            const span = $(node).children('span.d-none');
                            return span.length > 0 ?
                                span.get(0).innerText :
                                data;
                        },
                    },
                },
                text: DataTableManager.createButton('bi-printer'),
                title: title,
                autoPrint: true,

                split: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                        },
                        text: DataTableManager.createButton('bi-filetype-csv',
                            saveAs + ' CSV'),
                        title: exportTitle,
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible',
                        },
                        text: DataTableManager.createButton('bi-filetype-xls',
                            saveAs + ' EXCEL'),
                        title: exportTitle,
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible',
                        },
                        text: DataTableManager.createButton('bi-filetype-pdf',
                            saveAs + ' PDF'),
                        title: exportTitle,
                    },
                ],
            },
            {
                text: DataTableManager.createButton('bi-eye-slash'),
                className: 'btn-colvis',

                split: [
                    {
                        extend: 'colvis',
                        text: settings.localization.buttons.hide,
                    },
                ],
            },
        ];
    },

    /**
     * Параметры в select списке для длины страницы.
     *
     * @link https://datatables.net/reference/option/lengthMenu
     */
    _lengthMenu: function() {
        return [
            [this._pageLength, 20, 50, 100, -1],
            [this._pageLength, 20, 50, 100, settings.localization.entries.all],
        ];
    },

    /**
     * Установить свойства инициализации столбцов.
     *
     * @link https://datatables.net/reference/option/columnDefs
     * @private
     */
    _columnDefs: () => {
        let columnDefs = {};

        /**
         * Отключение сортировки и поиска.
         */
        if (settings.targets) {
            columnDefs.targets = settings.targets;
            columnDefs.orderable = false;
            columnDefs.searchable = false;
        } else {
            columnDefs.targets = null;
            columnDefs.orderable = true;
            columnDefs.searchable = true;
        }

        /**
         * Режим сортировки.
         */
        if (settings.domOrderType) {
            columnDefs.orderDataType = 'dom-text';
            columnDefs.type = 'string';
        }

        return [columnDefs];
    },

    /**
     * Возвращает параметры языковой конфигурации.
     *
     * @link https://datatables.net/reference/option/language
     * @private
     */
    _language: () => {
        const local = settings.localization;
        return {
            emptyTable: local.noEntries,
            info: local.entries.entries + ': _START_ - _END_ ' +
                local.entries.of + ' _TOTAL_ ',
            infoEmpty: local.entries.no_to_find,
            infoFiltered: '',
            lengthMenu: local.entries.show + ' _MENU_',
            loadingRecords: local.wait,
            paginate: {
                first: '«',
                previous: '‹',
                next: '›',
                last: '»',
            },
            processing: local.wait,
            search: local.search,
            zeroRecords: local.entries.no,
        };
    },
    /**
     * Рендер DataTable.
     */
    render: function() {
        new dt('#' + settings.tableId, this._options());

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
    },

});

window.DataTableConfig = DataTableConfig;
