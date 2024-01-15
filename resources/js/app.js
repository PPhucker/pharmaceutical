require('./bootstrap');
global.$ = global.jQuery = require('jquery');
require('suggestions-jquery');

import {DataTableMnager} from './components/datatable/DataTableManager.js';
import {DataTable} from './components/datatable/DataTableConfig.js';
import {Filter} from './components/FilterTableRecords.js';
import {FormUtils} from './components/form/FormUtils.js';
import {DaData} from './components/dadata/DaData.js';

global.DaData = DaData;
