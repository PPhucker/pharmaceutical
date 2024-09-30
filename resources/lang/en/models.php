<?php

return [
    'App' => [
        'Models' => [
            'Auth' => [
                'Role' => 'Role',
                'User' => 'User',
                'Permission' => 'Permission',
            ],
            'Classifier' => [
                'LegalForm' => 'Legal Form',
                'Bank' => 'Bank',
                'Nomenclature' => [
                    'Product' => [
                        'TypeOfEndProduct' => 'Type of finished product',
                        'InternationalNameOfEndProduct' => 'International name of the finished product',
                        'OKPD2' => 'OKPD2 classifier',
                        'RegistrationNumberOfEndProduct' => 'Registration number of the finished product',
                        'EndProduct' => 'End product',
                        'TypeOfAggregation' => 'Aggregation type',
                        'ProductCatalog' => 'Finished products catalog',
                        'ProductPrice' => 'Product price',
                        'ProductRegionalAllowance' => 'Regional allowance',
                    ],
                    'OKEI' => 'OKEI classifier',
                    'Service' => [
                        'Service' => 'Service',
                    ],
                    'Material' => [
                        'TypeOfMaterial' => 'Type of accessory',
                        'Material' => 'Accessories',
                    ],
                ],
            ],
            'Admin' => [
                'Organization' => [
                    'Organization' => 'Organization',
                    'PlaceOfBusiness' => 'Place of business',
                    'BankAccountDetail' => 'Bank details of the organization',
                    'Staff' => 'Employee of the organization',
                    'Transport' => [
                        'Car' => 'Company car',
                        'Driver' => 'Driver of the organization',
                        'Trailer' => 'Company trailer',
                    ],
                ],
            ],
            'Contractor' => [
                'Contractor' => 'Contractor',
                'PlaceOfBusiness' => 'Place of business',
                'BankAccountDetail' => 'Bank details of the organization',
                'ContactPerson' => 'Contractor contact person',
                'Contract' => 'Contractor contract',
                'Transport' => [
                    'Car' => 'Car of the contractor',
                    'Driver' => 'Driver of the contractor',
                    'Trailer' => 'Trailer of the contractor',
                ],
            ],
            'Document' => [
                'InvoicesForPayment' => [
                    'InvoiceForPayment' => 'Invoice for payment',
                    'InvoiceForPaymentProduct' => 'The finished product of the invoice for payment',
                    'InvoiceForPaymentMaterial' => 'Complete invoices for payment',
                ],
                'Act' => [
                    'Act' => 'Act',
                    'ActService' => 'Service of the act'
                ],
                'Shipment' => [
                    'PackingList' => [
                        'PackingList' => 'Packing List',
                        'PackingListProduct' => 'The product of the packing list',
                    ],
                    'Shipment' => 'Shipment',
                    'Bill' => [
                        'Bill' => 'Bill',
                    ],
                    'Appendixe' => [
                        'Appendix' => 'Appendix',
                    ],
                    'Protocol' => [
                        'Protocol' => 'Protocol',
                    ],
                    'Waybill' => [
                        'Waybill' => 'Waybill',
                    ],
                ],
            ],
        ],
    ],
];
