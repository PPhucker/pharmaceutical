<?php

return [
    'App' => [
        'Models' => [
            'Auth' => [
                'Role' => 'Role',
                'User' => 'User',
                'Permission' => 'Permission',
            ],
            'Classifiers' => [
                'LegalForm' => 'Legal Form',
                'Bank' => 'Bank',
                'Nomenclature' => [
                    'Products' => [
                        'TypeOfEndProduct' => 'Type of finished product',
                        'InternationalNameOfEndProduct' => 'International name of the finished product',
                        'OKPD2' => 'OKPD2 classifier',
                        'RegistrationNumberOfEndProduct' => 'Registration number of the finished product',
                        'EndProduct' => 'End product',
                        'TypeOfAggregation' => 'Aggregation type',
                        'ProductCatalog' => 'Finished products catalog',
                        'ProductPrice' => 'Product price',
                    ],
                    'OKEI' => 'OKEI classifier',
                    'Services' => [
                        'Service' => 'Service',
                    ],
                    'Materials' => [
                        'TypeOfMaterial' => 'Type of accessory',
                        'Material' => 'Accessories',
                    ],
                ],
            ],
            'Admin' => [
                'Organizations' => [
                    'Organization' => 'Organization',
                    'PlaceOfBusiness' => 'Place of business',
                    'BankAccountDetail' => 'Bank details of the organization',
                    'Staff' => 'Employee of the organization',
                    'Car' => 'Company car',
                    'Driver' => 'Driver of the organization',
                    'Trailer' => 'Company trailer',
                    'Contract' => 'Contractor contract',
                ],
            ],
            'Contractors' => [
                'Contractor' => 'Contractor',
                'PlaceOfBusiness' => 'Place of business',
                'BankAccountDetail' => 'Bank details of the organization',
                'ContactPerson' => 'Contractor contact person',
                'Car' => 'Car of the contractor',
                'Driver' => 'Driver of the contractor',
                'Trailer' => 'Trailer of the contractor',
            ],
            'Documents' => [
                'InvoicesForPayment' => [
                    'InvoiceForPayment' => 'Invoice for payment',
                    'InvoiceForPaymentProduct' => 'The finished product of the invoice for payment',
                    'InvoiceForPaymentMaterial' => 'Complete invoices for payment',
                ],
                'Acts' => [
                    'Act' => 'Act',
                    'ActService' => 'Service of the act'
                ],
                'Shipment' => [
                    'PackingLists' => [
                        'PackingList' => 'Packing List',
                        'PackingListProduct' => 'The product of the packing list',
                    ],
                    'Shipment' => 'Shipment',
                    'Bills' => [
                        'Bill' => 'Bill',
                    ],
                    'Appendixes' => [
                        'Appendix' => 'Appendix',
                    ],
                    'Protocols' => [
                        'Protocol' => 'Protocol',
                    ],
                    'Waybills' => [
                        'Waybill' => 'Waybill',
                    ],
                ],
            ],
        ],
    ],
];
