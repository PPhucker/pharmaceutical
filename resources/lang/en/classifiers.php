<?php

return [
    'classifiers' => 'Classifiers',

    'fail' => 'Failed to update classifier',

    'legal_forms' => [
        'legal_forms' => 'Legal Forms',
        'legal_form' => 'Legal Form',
        'abbreviation' => 'Abbreviation',
        'decoding' => 'Decoding',

        'actions' => [
            'update' => [
                'success' => 'Legal forms updated successfully'
            ],
            'create' => [
                'success' => 'Legal form added successfully'
            ]
        ],
    ],

    'banks' => [
        'banks' => 'Banks',
        'BIC' => 'RCBIC',
        'correspondent_account' => 'Correspondent Account',
        'name' => 'Name',

        'actions' => [
            'update' => [
                'success' => 'Banks updated successfully'
            ],
            'create' => [
                'success' => 'Bank added successfully'
            ]
        ],
    ],

    'regions' => [
        'regions' => 'Regions',
        'region' => 'Region',
        'name' => 'Name',
        'zone' => 'Zone',

        'actions' => [
            'update' => [
                'success' => 'Regions updated successfully'
            ],
            'create' => [
                'success' => 'Region created successfully'
            ]
        ],
    ],

    'nomenclature' => [
        'nomenclature' => 'Nomenclature',
        'products' => [
            'products' => 'Products',
            'GTIN' => 'GTIN',
            'full_name' => 'Full name',
            'short_name' => 'Short name',
            'marking' => [
                'marking' => 'Marking',
                'yes' => 'Yes',
                'no' => 'No',
            ],
            'main_information' => 'Main information',
            'best_before_date' => 'Best before date (months)',
            'actions' => [
                'create' => [
                    'success' => 'Product :name added successfully',
                ],
                'update' => [
                    'success' => 'Product :name updated successfully',
                ],
                'delete' => [
                    'success' => 'Product :name deleted successfully',
                ],
                'restore' => [
                    'success' => 'Product :name restored successfully',
                ],
            ],
            'titles' => [
                'create' => 'Product addition',
                'edit' => 'Product Editing'
            ],
            'types_of_end_products' => [
                'types_of_end_products' => 'Types Of End Products',
                'type_of_end_product' => 'Type Of End Product',
                'name' => 'Type',
                'color' => 'Color',
                'actions' => [
                    'update' => [
                        'success' => 'Types Of End Products have updated successfully',
                    ],
                    'create' => [
                        'success' => 'Type Of End Product :name added successfully'
                    ],
                ],
            ],
            'international_names_of_end_products' => [
                'international_names_of_end_products' => 'International names of end products',
                'international_name_of_end_product' => 'International name of end product',
                'name' => 'International name',
                'actions' => [
                    'update' => [
                        'success' => 'International names updated successfully',
                    ],
                    'create' => [
                        'success' => 'International name :name added successfully'
                    ],
                ],
            ],
            'okpd2' => [
                'okpd2' => 'OKPD2 Сlassifier',
                'code' => 'Code',
                'name' => 'Name',
                'actions' => [
                    'update' => [
                        'success' => 'Classifier OKPD2 successfully updated',
                    ],
                    'create' => [
                        'success' => 'The :code code has been successfully added to the OKPD2 classifier',
                    ],
                ],
            ],
            'registration_numbers' => [
                'registration_numbers' => 'Registration Numbers',
                'registration_number' => 'Registration Number',
                'without_registration_number' => 'Without Number',
                'number' => 'Number',
                'actions' => [
                    'update' => [
                        'success' => 'Registration numbers successfully updated',
                    ],
                    'create' => [
                        'success' => 'Registration number :number successfully added',
                    ],
                ],
            ],
            'types_of_aggregation' => [
                'types_of_aggregation' => 'Types Of Aggregation',
                'type_of_aggregation' => 'Type Of Aggregation',
                'code' => 'Code',
                'name' => 'Name',
                'product_quantity' => 'Product Quantity',
                'actions' => [
                    'update' => [
                        'success' => 'Aggregation types updated successfully',
                    ],
                    'create' => [
                        'success' => 'Aggregation type :name added successfully',
                    ],
                    'delete' => [
                        'success' => 'Aggregation type :name deleted successfully',
                    ],
                ],
            ],
            'product_catalog' => [
                'product_catalog' => 'Product Catalog',
                'product_id' => 'End Product',
                'place_of_business_id' => 'Production',
                'GTIN' => 'GTIN',
                'statistic' => 'Statistic',
                'actions' => [
                    'create' => [
                        'success' => 'Product :name has been successfully added to the product catalog',
                    ],
                    'update' => [
                        'success' => 'Product :name successfully updated in the product catalog',
                    ],
                    'delete' => [
                        'success' => 'Product :name has been successfully removed from the product catalog',
                    ],
                    'restore' => [
                        'success' => 'Product :name successfully restored to product catalog',
                    ],
                ],
            ],
            'product_prices' => [
                'product_prices' => 'Price',
                'organization_id' => 'Supplier',
                'retail_price' => 'Retail Price',
                'trade_price' => 'Trade Price',
                'nds' => 'NDS %',
                'trade_quantity' => 'Trade Quantity',
                'actions' => [
                    'create' => [
                        'success' => 'Price added successfully',
                        'fail' => 'Failed to save price',
                    ],
                    'update' => [
                        'success' => 'Price updated successfully',
                        'fail' => 'Failed to update price',
                    ],
                    'delete' => [
                        'success' => 'Price removed successfully',
                    ],
                    'restore' => [
                        'success' => 'Price successfully restored',
                    ],
                ],
            ],
            'regional_allowances' => [
                'regional_allowances' => 'Regional allowances',
                'region_id' => 'Region',
                'allowance' => 'Allowance',
                'actions' => [
                    'create' => [
                        'success' => 'Regional allowance successfully added',
                        'fail' => 'Failed to add regional allowance',
                    ],
                    'update' => [
                        'success' => 'Regional allowances successfully updated',
                        'fail' => 'Failed to update regional allowances',
                    ],
                    'delete' => [
                        'success' => 'Regional allowance successfully removed',
                    ],
                    'restore' => [
                        'success' => 'Regional allowance successfully reinstated',
                    ],
                ],
            ],
        ],
        'materials' => [
            'materials' => 'Components',
            'material' => 'Component',
            'type_id' => 'Component type',
            'okei_code' => 'Unit',
            'name' => 'Name',
            'actions' => [
                'update' => [
                    'success' => 'Components updated successfully',
                ],
                'create' => [
                    'success' => 'Component :name added successfully',
                ],
                'delete' => [
                    'success' => 'Component :name deleted successfully',
                ],
                'restore' => [
                    'success' => 'Component :name restored successfully',
                ],
            ],
            'types_of_materials' => [
                'types_of_materials' => 'Component types',
                'name' => 'Type',
                'actions' => [
                    'update' => [
                        'success' => 'Component types updated successfully',
                    ],
                    'create' => [
                        'success' => 'Component type :name added successfully',
                    ],
                ],
            ],
        ],
        'services' => [
            'services' => 'Services',
            'service' => 'Service',
            'name' => 'Name',
            'okei' => 'OKEI Symbol',
            'actions' => [
                'update' => [
                    'success' => 'Services updated successfully',
                    'fail' => 'Failed to update service',
                ],
                'create' => [
                    'success' => 'Service :name added successfully',
                    'fail' => 'Failed to create service',
                ],
                'delete' => [
                    'success' => 'Service :name deleted successfully',
                ],
                'restore' => [
                    'success' => 'Service :name restored successfully',
                ]
            ],
        ],
        'okei' => [
            'okei' => 'OKEI Classifier',
            'code' => 'Code',
            'unit' => 'Unit',
            'symbol' => 'Symbol',
            'actions' => [
                'update' => [
                    'success' => 'Classifier OKEI successfully updated',
                ],
                'create' => [
                    'success' => 'The unit :name has been successfully added to the OKEI classifier',
                ],
            ],
        ],
    ],
];
