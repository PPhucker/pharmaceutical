<?php

return [
    'greeting' => 'Hello!',
    'salutation' => 'Regards',
    'contractors' => [
        'created' => [
            'subject' => 'Introducing a new contractor',
            'body' => 'You have received this e-mail because a new contractor has been entered.',
            'contractor' => 'Contractor: :contractor',
            'INN' => 'INN: :INN',
            'created_at' => 'Date: :created_at',
            'user' => 'User: :user',
            'action' => 'Check',
        ],
    ],
    'shipment' => [
        'created' => [
            'subject' => 'Creation of shipping documents',
            'body' => 'You have received this email because a shipment package has been created',
            'organization' => 'Supplier: :orgnanization',
            'contractor' => 'Consignee: :contractor',
            'contractor_inn' => 'TIN: :INN',
            'created_at' => 'Date: :created_at',
            'user' => 'User: :user',
            'action' => 'Check',
        ],
    ],
];
