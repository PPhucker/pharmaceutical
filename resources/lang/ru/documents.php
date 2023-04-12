<?php

return [
    'header' => 'Шапка документа',
    'invoices_for_payment' => [
        'invoices_for_payment' => 'Счета на оплату',
        'invoice_for_payment' => 'Счет на оплату',
        'organization_id' => 'Поставщик',
        'organization_place_id' => 'Адрес грузоотправителя',
        'organization_bank_id' => 'Реквизиты поставщика',
        'contractor_id' => 'Получатель',
        'contractor_place_id' => 'Адрес грузополучателя',
        'contractor_bank_id' => 'Реквизиты получателя',
        'number' => 'Номер',
        'date' => 'Дата',
        'director' => 'Руководитель',
        'bookkeeper' => 'Главный бухгалтер',
        'filename' => 'Прикрепленный файл',
        'warning' => 'Внимание! При удалении счета на оплату автоматически удаляется весь пакет документов, созданный на его основании!',
        'actions' => [
            'create' => [
                'success' => 'Счет на оплату №:number успешно создан',
                'fail' => 'Не удалось создать счет на оплату',
            ],
            'update' => [
                'success' => 'Счет на оплату №:number успешно обновлен',
                'fail' => 'Не удалось обновить счет на оплату',
            ],
            'delete' => [
                'success' => 'Счет на оплату №:number успешно удален'
            ],
            'restore' => [
                'success' => 'Счет на оплату №:number успешно восстановлен'
            ],
        ],
        'buttons' => [
            'create' => 'Выставить счет'
        ],
        'titles' => [
            'create' => 'Выставление счета на оплату',
        ],
    ],
];
