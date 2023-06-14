require('./bootstrap');

global.$ = global.jQuery = require('jquery');

require('suggestions-jquery');

import {DataTable} from './components/data-table.js';

global.DataTable = DataTable;

import {Filter} from './components/filter-table-records.js';

global.Filter = Filter;

import {DaData} from './components/dadata/DaData.js';

global.DaData = DaData;


