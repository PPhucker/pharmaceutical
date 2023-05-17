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
        'created' => [
            'subject' => 'Создание документов на отгрузку',
            'body' => 'Вы получили это письмо, так как был создан пакет документов на отгрузку',
            'organization' => 'Поставщик: :orgnanization',
            'contractor' => 'Получатель: :contractor',
            'contractor_inn' => 'ИНН: :INN',
            'created_at' => 'Дата: :created_at',
            'user' => 'Пользователь: :user',
            'action' => 'Проверить',
        ],
    ],
];
