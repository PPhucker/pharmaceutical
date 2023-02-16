<?php

return [
    'contractors' => 'Contractors',
    'organizations' => [
        'organizations' => 'Organizations',
        'actions' => [
            'create' => [
                'success' => 'Organization :name added successfully',
                'fail' => 'Failed to add organization :name'
            ],
            'update' => [
                'success' => 'Organization :name updated successfully',
                'fail' => 'Failed to update organization :name'
            ],
            'destroy' => [
                'success' => 'Organization :name deleted successfully'
            ],
            'restore' => [
                'success' => 'Organization :name restored successfully'
            ],
        ],
        'titles' => [
            'create' => 'Adding a new organization'
        ]
    ],

    'places_of_business' => [
        'places_of_business' => 'Places Of Business',
        'place_of_business' => 'Place Of Business',

        'identifier' => 'Registration number (mdlp.crpt.ru)',
        'registered' => 'Registered Address',
        'index' => 'Index',
        'address' => 'Address',

        'actions' => [
            'create' => [
                'success' => 'Place of business :name added successfully',
                'fail' => 'Failed to add activity location :name'
            ],
            'update' => [
                'success' => 'Places of business successfully updated',
                'fail' => 'Failed to update places of business',
            ],
            'destroy' => [
                'success' => 'Place of business :name removed successfully'
            ],
            'restore' => [
                'success' => 'Place of business :name successfully restored'
            ],
        ],
    ],

    'bank_account_details' => [
        'bank_account_details' => 'Bank Account Details',
        'bank' => 'Bank',
        'payment_account' => 'Payment Account',

        'actions' => [
            'create' => [
                'success' => 'Bank details :name added successfully',
                'fail' => 'Failed to add bank details :name'
            ],
            'update' => [
                'success' => 'Bank details updated successfully',
                'fail' => 'Failed to update bank details',
            ],
            'destroy' => [
                'success' => 'Bank details :name deleted successfully'
            ],
            'restore' => [
                'success' => 'Bank details :name restored successfully'
            ],
        ],
    ],

    'staff' => [
        'staff' => 'Staff',
        'name' => 'Name',
        'post' => 'Post',

        'actions' => [
            'create' => [
                'success' => 'Employee :name added successfully',
                'fail' => 'Failed to add employee :name'
            ],
            'update' => [
                'success' => 'Employees updated successfully',
                'fail' => 'Failed to update employees',
            ],
            'destroy' => [
                'success' => 'Employee :name was successfully deleted'
            ],
            'restore' => [
                'success' => 'Employee :name successfully restored'
            ],
        ],
    ],

    'name' => 'Name',
    'inn' => 'NIP Number',
    'okpo' => 'Russian Business and Organization Classification',
    'contacts' => 'Contacts',
    'card' => 'Counterparty card',
    'main_information' => 'Main information'
];
