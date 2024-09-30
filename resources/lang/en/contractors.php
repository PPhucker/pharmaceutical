<?php

return [
    'contractors' => 'Contractors',
    'contractor' => 'Contractor',
    'quantity' => 'Quantity',

    'actions' => [
        'create' => [
            'success' => 'Contractor :name added successfully',
            'fail' => 'Failed to add contractor :name'
        ],
        'update' => [
            'success' => 'Contractor :name updated successfully',
            'fail' => 'Failed to update contractor :name'
        ],
        'delete' => [
            'success' => 'Contractor :name deleted successfully'
        ],
        'restore' => [
            'success' => 'Contractor :name restored successfully'
        ],
    ],
    'titles' => [
        'create' => 'Adding a new contractor'
    ],

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
            'delete' => [
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
                'fail' => 'Failed to add activity location'
            ],
            'update' => [
                'success' => 'Places of business successfully updated',
                'fail' => 'Failed to update places of business',
            ],
            'delete' => [
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
            'delete' => [
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
            'delete' => [
                'success' => 'Employee :name was successfully deleted'
            ],
            'restore' => [
                'success' => 'Employee :name successfully restored'
            ],
        ],
    ],

    'contact_persons' => [
        'contact_persons' => 'Contact Persons',
        'contact_person' => 'Contact Person',
        'name' => 'Name',
        'post' => 'Post',
        'phone' => 'Phone',
        'email' => 'E-mail',

        'actions' => [
            'create' => [
                'success' => 'Contact person :name added successfully',
                'fail' => 'Failed to add contact person :name'
            ],
            'update' => [
                'success' => 'Contacts updated successfully',
                'fail' => 'Failed to update contacts',
            ],
            'delete' => [
                'success' => 'Contact person :name deleted successfully'
            ],
            'restore' => [
                'success' => 'Contact person :name successfully restored'
            ],
        ],
    ],

    'drivers' => [
        'drivers' => 'Drivers',
        'driver' => 'Driver',
        'name' => 'Name',
        'actions' => [
            'create' => [
                'success' => 'Driver :name added successfully',
                'fail' => 'Failed to add driver'
            ],
            'update' => [
                'success' => 'Drivers updated successfully',
                'fail' => 'Failed to update drivers',
            ],
            'delete' => [
                'success' => 'Driver :name deleted successfully'
            ],
            'restore' => [
                'success' => 'Driver :name restored successfully'
            ],
        ],
    ],

    'cars' => [
        'cars' => 'Cars',
        'car' => 'Car',
        'car_model' => 'Car Model',
        'state_number' => 'State Number',
        'actions' => [
            'create' => [
                'success' => 'Car :number added successfully',
                'fail' => 'Failed to add car'
            ],
            'update' => [
                'success' => 'Cars updated successfully',
                'fail' => 'Failed to update cars',
            ],
            'delete' => [
                'success' => 'Car :number deleted successfully'
            ],
            'restore' => [
                'success' => 'Car :number restored successfully'
            ],
        ],
    ],

    'trailers' => [
        'trailers' => 'Trailers',
        'trailer' => 'Trailer',
        'type' => 'Type',
        'state_number' => 'state_number',
        'actions' => [
            'create' => [
                'success' => 'Trailer :number added successfully',
                'fail' => 'Failed to add trailer'
            ],
            'update' => [
                'success' => 'Trailers updated successfully',
                'fail' => 'Failed to update trailers',
            ],
            'delete' => [
                'success' => 'Trailer :number deleted successfully'
            ],
            'restore' => [
                'success' => 'Trailer :number restored successfully'
            ],
        ],
    ],
    'contracts' => [
        'contracts' => 'Contracts',
        'contract' => 'Contract',
        'organization_id' => 'The contract is concluded with',
        'number' => 'Number',
        'date' => 'Date',
        'comment' => 'Comment',
        'is_valid' => 'Is valid',
        'actions' => [
            'create' => [
                'success' => 'Contract successfully added',
                'fail' => 'Failed to add a contract'
            ],
            'update' => [
                'success' => 'Contracts successfully updated',
                'fail' => 'Failed to update contracts',
            ],
            'delete' => [
                'success' => 'The contract has been successfully deleted'
            ],
            'restore' => [
                'success' => 'The treaty has been successfully restored'
            ],
        ],
    ],

    'name' => 'Name',
    'inn' => 'NIP Number',
    'okpo' => ' OKPO code',
    'kpp' => 'KPP',
    'contacts' => 'Contacts',
    'card' => 'Counterparty card',
    'main_information' => 'Main information',
    'comment' => 'Comment',
];
