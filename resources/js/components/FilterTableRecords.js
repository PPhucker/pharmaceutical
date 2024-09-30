const Filter = {
    showTrashed: function(tableId, recordType) {
        const table = document.getElementById(tableId);

        for (const item of table.getElementsByTagName(
            'tbody')[0].getElementsByTagName('tr')) {
            if (item.classList.contains('trashed')) {
                switch (recordType) {
                    case 'working':
                        item.classList.add('d-none');
                        break;
                    case 'trashed':
                        item.classList.remove('d-none');
                        break;
                }
            } else {
                switch (recordType) {
                    case 'working':
                        item.classList.remove('d-none');
                        break;
                    case 'trashed':
                        item.classList.add('d-none');
                        break;
                }
            }
        }
    },
};

window.Filter = Filter;
