const DataTableManager =
    {
        /**
         * Возвращает объект настроек для таблицы DataTable.
         *
         * @param id
         */
        getSettings(id) {
            const getElementValue = (suffix) => {
                const element = document.getElementById(
                    suffix + '_' + id,
                );
                return element ? element.value : null;
            };

            const tableId = getElementValue('tableId');
            const tableType = getElementValue('tableType');
            const orderType = getElementValue('orderType');
            const pageLength = getElementValue('pageLength');
            const localization = JSON.parse(
                document.getElementById(
                    'localization-data',
                ).dataset.localization,
            );

            const getTargets = () => {
                const targets = getElementValue('targets');
                return targets ? targets.split(',').map(Number) : null;
            };

            return {
                tableId,
                tableType,
                targets: getTargets(),
                orderType,
                localization,
                pageLength,
            };
        },
        /**
         *
         * @param {string} iconClass
         * @param {string} buttonText
         * @returns {HTMLUListElement}
         * @private
         */
        createButton: function(iconClass, buttonText = '') {
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
        },
    };

window.DataTableManager = DataTableManager;
