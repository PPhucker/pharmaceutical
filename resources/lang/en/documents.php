<?php

return [
    'header' => 'Main Info',
    'print' => 'Printing Form',
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
            'copy' => [
                'success' => 'The invoice for payment has been successfully copied',
                'fail' => 'Failed to copy the invoice for payment',
            ],
        ],
        'buttons' => [
            'create_based_on' => 'Create based on',
        ],
        'titles' => [
            'create' => 'Invoicing for payment',
        ],
        'data' => [
            'data' => 'Invoice for payment production',
            'product_catalog_id' => 'Product',
            'quantity' => 'Quantity',
            'price' => 'Price with VAT',
            'nds' => 'VAT',
            'fails' => [
                'quantity' => 'Quantity must be a multiple of :quantity',
                'price_list' => 'No product price in the catalogue of finished products',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Products successfully added to invoice',
                    'fail' => 'Failed to add product to invoice',
                ],
                'update' => [
                    'success' => 'Invoice products updated successfully',
                    'fail' => 'Failed to update products',
                ],
                'delete' => [
                    'success' => 'Product :name has been successfully removed from the invoice',
                ],
                'restore' => [
                    'success' => 'Product :name restored successfully',
                ],
            ],
        ],
    ],
    'shipment' => [
        'shipment' => 'Shipment',
        'invoice_for_payment_id' => 'Invoice for payment',
        'number' => 'Number',
        'date' => 'Data',
        'organization_id' => 'Supplier',
        'organization_place_id' => 'Shipper`s address',
        'organization_bank_id' => 'Supplier details',
        'contractor_id' => 'Buyer',
        'contractor_place_id' => 'Consingee address',
        'contractor_bank_id' => 'Buyer address',
        'director' => 'Director',
        'bookkeeper' => 'Bookkeeper',
        'storekeeper' => 'Storekeeper',
        'filename' => 'File',
        'approved' => 'Appoved',
        'comment' => 'Comment',
        'errors' => [
            'approve_update' => 'Unable to modify an agreed document',
        ],
        'approval' => [
            'approval' => 'Approval',
            'approved_by' => 'Approved by',
            'approved' => 'Approved',
            'not_viewed' => 'Not approved',
            'document' => 'Document',
            'updated' => 'Updated',
            'e-mail' => [
                'send' => [
                    'send' => 'send',
                    'to' => [
                        'markeing' => 'E-mail to the marketing about the approval / non-approval of the shipment',
                        'digital_comunication' => 'E-mail to the digital communications department about the changes made',
                    ],
                    'success' => 'Email sent successfully',
                ]
            ],
        ],
        'packing_lists' => [
            'packing_lists' => 'Packing lists',
            'packing_list' => 'Packing list',
            'buttons' => [
                'create_based_on' => 'Create based on packing list',
            ],
            'errors' => [
                'invoice_for_payment_id' => 'You must select at least one invoice for payment',
                'organization_id' => 'Different suppliers on invoices for payment',
                'contractor_id' => 'Different buyers on invoices for payment',
                'failed_document' => 'Failed to create shipping document',
            ],
            'titles' => [
                'create' => 'Create a packing list',
            ],
            'warning' => 'Attention! When deleting a packing list, the entire package of shipping documents is automatically deleted!',
            'actions' => [
                'create' => [
                    'success' => 'Packing list :number created successfully',
                    'fail' => 'Failed to create packing list',
                ],
                'update' => [
                    'success' => 'Packing list :number updated successfully',
                    'fail' => 'Failed to update packing list',
                ],
                'delete' => [
                    'success' => 'Packing list :number deleted successfully'
                ],
                'restore' => [
                    'success' => 'Packing list :number restored successfully'
                ],
            ],
            'data' => [
                'actions' => [
                    'create' => [
                        'success' => 'Product :name successfully added to the packing list',
                        'fail' => 'Failed to add product to packing list',
                    ],
                    'update' => [
                        'success' => 'Packing list products updated successfully',
                        'fail' => 'Failed to update packing list products',
                    ],
                    'delete' => [
                        'success' => 'Product :name was successfully removed from the packing list',
                    ],
                    'restore' => [
                        'success' => 'Product :name restored successfully',
                    ],
                ],
            ],
        ],
        'bills' => [
            'bills' => 'Bills',
            'bill' => 'Bill',
            'errors' => [
                'packing_list_id' => [
                    'required' => 'You need to select a packing list',
                    'unique' => 'You can only create one bill per packing list.',
                ],
            ],
            'titles' => [
                'create' => 'Creating bill',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Bill №:number created successfully',
                    'fail' => 'Failed to create bill',
                ],
                'update' => [
                    'success' => 'Bill №:number updated successfully',
                    'fail' => 'Failed to update bill',
                ],
                'delete' => [
                    'success' => 'Bill №:number deleted successfully'
                ],
                'restore' => [
                    'success' => 'Bill №:number restored successfully'
                ],
            ],
        ],
        'appendixes' => [
            'appendixes' => 'Appendixes',
            'appendix' => 'Appendix',
            'errors' => [
                'packing_list_id' => [
                    'required' => 'You need to select a packing list',
                    'unique' => 'Only one appendix can be created based on the packing list',
                ],
            ],
            'titles' => [
                'create' => 'Creating Appendix',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Appendix №:number created successfully',
                    'fail' => 'Failed to create appendix',
                ],
                'update' => [
                    'success' => 'Appendix №:number updated successfully',
                    'fail' => 'Failed to update appendix',
                ],
                'delete' => [
                    'success' => 'Appendix №:number deleted successfully'
                ],
                'restore' => [
                    'success' => 'Appendix №:number restored successfully'
                ],
            ],
        ],
        'protocols' => [
            'protocols' => 'Protocols',
            'protocol' => 'Protocol',
            'errors' => [
                'packing_list_id' => [
                    'required' => 'You need to select a packing list',
                    'unique' => 'Only one protocol can be created on the basis of a packing list',
                ],
            ],
            'titles' => [
                'create' => 'Creating protocol',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Protocol №:number created successfully',
                    'fail' => 'Failed to create protocol',
                ],
                'update' => [
                    'success' => 'Protocol №:number updated successfully',
                    'fail' => 'Failed to update protocol',
                ],
                'delete' => [
                    'success' => 'Protocol №:number deleted successfully'
                ],
                'restore' => [
                    'success' => 'Protocol №:number restored successfully'
                ],
            ],
        ],
        'waybills' => [
            'waybills' => 'Waybills',
            'waybill' => 'Waybill',
            'car_model' => 'Car Model',
            'state_car_number' => 'State Car Number',
            'driver' => 'Driver',
            'licence_card' => [
                'licence_card' => 'Licence Card',
                'standard' => 'Standard',
                'limited' => 'Limited',
            ],
            'type_of_transportation' => [
                'type_of_transportation' => 'Type of Transportation',
                'automotive' => 'Automotive',
                'manual_movement' => 'Manual Movement',
            ],
            'trailer' => 'Trailer',
            'state_trailer_number' => 'State Trailer Number',

            'errors' => [
                'packing_list_id' => [
                    'required' => 'You need to select a packing list',
                    'unique' => 'Only one waybill can be created on the basis of a packing list',
                ],
            ],
            'titles' => [
                'create' => 'Creating Waybill',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Waybill №:number created successfully',
                    'fail' => 'Failed to create waybill',
                ],
                'update' => [
                    'success' => 'Waybill №:number updated successfully',
                    'fail' => 'Failed to update waybill',
                ],
                'delete' => [
                    'success' => 'Waybill №:number deleted successfully'
                ],
                'restore' => [
                    'success' => 'Waybill №:number restored successfully'
                ],
            ],
        ],
        'data' => [
            'production' => 'Production',
            'product_catalog_id' => 'Fullname',
            'series' => 'Series',
            'quantity' => 'Quantity',
            'price' => 'Price with VAT',
            'nds' => 'VAT',
            'sum' => 'Sum',
            'total_by_packing_list' => 'Packing List Total',
            'total' => 'Total',
            'titles' => [
                'choose_products' => '`Select products from invoices for payment`',
            ],
        ],
    ],
    'acts' => [
        'acts' => 'Acts',
        'act' => 'Acts',
        'number' => 'Number',
        'date' => 'Date',
        'organization_id' => 'Performer',
        'contractor_id' => 'Customer',
        'filename' => 'Filet',
        'titles' => [
            'create' => 'Creating Act',
        ],
        'actions' => [
            'create' => [
                'success' => 'Act №:number created successfully',
                'fail' => 'Failed to create act',
            ],
            'update' => [
                'success' => 'Act №:number updated successfully',
                'fail' => 'Failed to update act',
            ],
            'delete' => [
                'success' => 'Act №:number deleted successfully'
            ],
            'restore' => [
                'success' => 'Act №:number restored successfully'
            ],
        ],
        'data' => [
            'data' => 'Services, works',
            'service_id' => 'Service',
            'quantity' => 'Quantity',
            'price' => 'Price with VAT',
            'nds' => 'VAT',
            'actions' => [
                'create' => [
                    'success' => 'The service has been successfully added to the act',
                    'fail' => 'Failed to add service to act',
                ],
                'update' => [
                    'success' => 'Act services updated successfully',
                    'fail' => 'Failed to update services',
                ],
                'delete' => [
                    'success' => 'The service was successfully removed from the act',
                ],
                'restore' => [
                    'success' => 'Service successfully restored',
                ],
            ],
        ],
    ],
];
