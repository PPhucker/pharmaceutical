<?php

return [
    'classifiers' => 'Классификаторы',

    'fail' => 'Не удалось обновить классификатор',

    'legal_forms' => [
        'legal_forms' => 'Правовые формы',
        'legal_form' => 'Правовая форма',
        'abbreviation' => 'Aббревиатура',
        'decoding' => 'Расшифровка',

        'actions' => [
            'update' => [
                'success' => 'Правовые формы успешно обновлены'
            ],
            'create' => [
                'success' => 'Правовая форма успешно добавлена'
            ]
        ],
    ],

    'banks' => [
        'banks' => 'Банки',
        'BIC' => 'БИК',
        'correspondent_account' => 'Корсчет',
        'name' => 'Название',

        'actions' => [
            'update' => [
                'success' => 'Банки успешно обновлены'
            ],
            'create' => [
                'success' => 'Банк успешно добавлен'
            ]
        ],
    ],

    'nomenclature' => [
        'nomenclature' => 'Номенклатура',
        'products' => [
            'products' => 'Готовая Продукция',
            'GTIN' => 'GTIN',
            'full_name' => 'Полное наименование',
            'short_name' => 'Краткое наименование',
            'marking' => [
                'marking' => 'Маркировка',
                'yes' => 'Да',
                'no' => 'Нет',
            ],
            'main_information' => 'Основная информация',
            'best_before_date' => 'Срок годности (месяцы)',
            'actions' => [
                'create' => [
                    'success' => 'Продукт :name успешно добавлен',
                ],
                'update' => [
                    'success' => 'Продукт :name успешно обновлен',
                ],
                'delete' => [
                    'success' => 'Продукт :name успешно удален',
                ],
                'restore' => [
                    'success' => 'Продукт :name успешно восстановлен',
                ],
            ],
            'titles' => [
                'create' => 'Добавление продукта',
                'edit' => 'Редактирование продукта'
            ],
            'types_of_end_products' => [
                'types_of_end_products' => 'Типы готовой продукции',
                'type_of_end_product' => 'Тип готовой продукции',
                'name' => 'Тип',
                'color' => 'Цвет',
                'actions' => [
                    'update' => [
                        'success' => 'Типы готовой продукции успешно обновлены',
                    ],
                    'create' => [
                        'success' => 'Тип готовой :name продукции успешно добавлен'
                    ],
                ],
            ],
            'international_names_of_end_products' => [
                'international_names_of_end_products' => 'Международные названия',
                'international_name_of_end_product' => 'Международ. непатент. назв.',
                'name' => 'Название',
                'actions' => [
                    'update' => [
                        'success' => 'Международные непатентованные названия успешно обновлены',
                    ],
                    'create' => [
                        'success' => 'Международное непатентованное название :name продукции успешно добавлено'
                    ],
                ],
            ],
            'okpd2' => [
                'okpd2' => 'Классификатор ОКПД2',
                'code' => 'Код',
                'name' => 'Наименование',
                'actions' => [
                    'update' => [
                        'success' => 'Классификатор ОКПД2 успешно обновлен',
                    ],
                    'create' => [
                        'success' => 'Код :code успешно добавлен в классификатор ОКПД2',
                    ],
                ],
            ],
            'registration_numbers' => [
                'registration_numbers' => 'Регистрационные номера',
                'resgistration_number' => 'Регистрационный номер',
                'without_registration_number' => 'Нет номера',
                'number' => 'Номер',
                'actions' => [
                    'update' => [
                        'success' => 'Регистрационные номера успешно обновлены',
                    ],
                    'create' => [
                        'success' => 'Регистрационный номер :number успешно добавлен',
                    ],
                ],
            ],
            'types_of_aggregation' => [
                'types_of_aggregation' => 'Типы агрегации',
                'type_of_aggregation' => 'Тип агрегации',
                'code' => 'Код',
                'name' => 'Название типа',
                'product_quantity' => 'Кол-во продукции',
                'actions' => [
                    'update' => [
                        'success' => 'Типы агрегации успешно обновлены',
                    ],
                    'create' => [
                        'success' => 'Тип агрегации :name успешно добавлен',
                    ],
                    'delete' => [
                        'success' => 'Тип агрегации :name успешно удален',
                    ],
                ],
            ],
            'product_catalog' => [
                'product_catalog' => 'Каталог готовой продукции',
                'product_id' => 'Готовый продукт',
                'place_of_business_id' => 'Производство',
                'GTIN' => 'GTIN',
                'actions' => [
                    'create' => [
                        'success' => 'Продукт :name успешно добавлен в каталог продукции',
                    ],
                    'update' => [
                        'success' => 'Продукт :name успешно обновлен в каталоге продукции',
                    ],
                    'delete' => [
                        'success' => 'Продукт :name успешно удален из каталога продукции',
                    ],
                    'restore' => [
                        'success' => 'Продукт :name успешно восстановлен в каталог продукции',
                    ],
                ],
            ],
            'product_prices' => [
                'product_prices' => 'Прайс',
                'organization_id' => 'Поставщик',
                'retail_price' => 'Розничная цена',
                'trade_price' => 'Оптовая цена',
                'nds' => 'НДС %',
                'trade_quantity' => 'Оптовое кол-во',
                'actions' => [
                    'create' => [
                        'success' => 'Прайс успешно добавлен',
                        'fail' => 'Не удалось сохранить прайс',
                    ],
                    'update' => [
                        'success' => 'Прайс успешно обновлен',
                        'fail' => 'Не удалось обновить прайс',
                    ],
                    'delete' => [
                        'success' => 'Прайс успешно удален',
                    ],
                    'restore' => [
                        'success' => 'Прайс успешно восстановлен',
                    ],
                ],
            ],
        ],
        'materials' => [
            'materials' => 'Комплектующие',
            'material' => 'Комплектующее',
            'type_id' => 'Тип комплектующего',
            'okei_code' => 'Единица измерения',
            'name' => 'Наименование',
            'actions' => [
                'update' => [
                    'success' => 'Комплектующие успешно обновлены',
                ],
                'create' => [
                    'success' => 'Комплектующее :name успешно добавлено',
                ],
                'delete' => [
                    'success' => 'Комплектующее :name успешно удалено',
                ],
                'restore' => [
                    'success' => 'Комплектующее :name успешно восстановлено',
                ]
            ],
            'types_of_materials' => [
                'types_of_materials' => 'Типы комплектующих',
                'name' => 'Тип',
                'actions' => [
                    'update' => [
                        'success' => 'Типы комплектующих успешно обновлены',
                    ],
                    'create' => [
                        'success' => 'Тип комплектующих :name успешно добавлен',
                    ],
                ],
            ],
        ],
        'okei' => [
            'okei' => 'Классификатор ОКЕИ',
            'code' => 'Код',
            'unit' => 'Единица измерения',
            'symbol' => 'Сокращение',
            'actions' => [
                'update' => [
                    'success' => 'Классификатор ОКЕИ успешно обновлен',
                ],
                'create' => [
                    'success' => 'Наименование :name успешно добавлено в классификатор ОКЕИ',
                ],
            ],
        ],
    ],
];
