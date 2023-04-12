<?php

return [
    'header' => 'Document header',
    'invoices_for_payment' => [
        'invoices_for_payment' => 'Invoices For Payment',
        'invoice_for_payment' => 'Invoice For Payment',
        'organization_id' => 'Provider',
        'organization_place_id' => 'Provider Address',
        'organization_bank_id' => 'Provider Details',
        'contractor_id' => 'Contractor',
        'contractor_place_id' => 'Contractor Address',
        'contractor_bank_id' => 'Contractor Details',
        'number' => 'Number',
        'date' => 'Date',
        'director' => 'Director',
        'bookkeeper' => 'Bookkeeper',
        'filename' => 'Filename',
        'warning' => 'Attention! When deleting an invoice for payment, the entire package of documents created on its basis is automatically deleted!',
        'actions' => [
            'create' => [
                'success' => 'Invoice for payment №:number successfully created',
                'fail' => 'Failed to create invoice for payment',
            ],
            'update' => [
                'success' => 'Invoice for payment №:number successfully updated',
                'fail' => 'Failed to update invoice for payment',
            ],
            'delete' => [
                'success' => 'Invoice for payment №:number successfully deleted'
            ],
            'restore' => [
                'success' => 'Invoice for payment №:number successfully restored'
            ],
        ],
        'buttons' => [
            'create' => 'Create Invoice'
        ],
        'titles' => [
            'create' => 'Invoicing for payment',
        ],
    ],
];
