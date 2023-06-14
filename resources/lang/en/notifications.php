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
        'organization' => 'Organization: :organization',
        'contractor' => 'Contractor: :contractor',
        'contractor_inn' => 'TIN: :INN',
        'number' => 'Number: №:number',
        'date' => 'Date: :date',
        'subject' => 'Shipment №:number :date',
        'created' => [
            'body' => 'You have received this email because a shipment package has been created.',
            'created_at' => 'Date: :created_at',
            'user' => 'User: :user',
            'action' => 'Check',
        ],
        'approval' => [
            'success' => 'Documents approved',
            'fail' => 'Documents not approved',
            'show' => 'Show',
            'correct' => 'Documents corrected',
        ],
    ],
];
