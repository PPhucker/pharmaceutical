<?php

return [
    'greeting' => 'Здравствуйте!',
    'salutation' => 'С уважением',
    'contractors' => [
        'created' => [
            'subject' => 'Заведение нового контрагента',
            'body' => 'Вы получили это письмо, так как был заведен новый контрагент.',
            'contractor' => 'Контрагент: :contractor',
            'INN' => 'ИНН: :INN',
            'created_at' => 'Дата: :created_at',
            'user' => 'Пользователь: :user',
            'action' => 'Проверить',
        ],
    ],
    'shipment' => [
        'organization' => 'Поставщик: :organization',
        'contractor' => 'Получатель: :contractor',
        'contractor_inn' => 'ИНН: :INN',
        'number' => 'Номер: №:number',
        'date' => 'Дата: :date',
        'subject' => 'Отгрузка №:number от :date',
        'created' => [
            'body' => 'Вы получили это письмо, так как был создан пакет документов на отгрузку.',
            'created_at' => 'Дата: :created_at',
            'user' => 'Пользователь: :user',
            'action' => 'Проверить',
        ],
        'approval' => [
            'success' => 'Документы согласованы',
            'fail' => 'Документы не согласованы',
            'show' => 'Просмотр',
            'correct' => 'Документы исправлены',
        ],
    ],
];
