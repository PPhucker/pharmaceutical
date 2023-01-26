require('./bootstrap');

global.$ = global.jQuery = require('jquery');

import {DataTable} from './components/data-table.js';

global.DataTable = DataTable;

import {Filter} from './components/filter-table-records.js';

global.Filter = Filter;


