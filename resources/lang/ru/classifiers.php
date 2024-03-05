<?php

return [
    'classifiers' => 'Классификаторы',
    'legal_forms' => [
        'legal_forms' => 'Правовые формы',
        'legal_form' => 'Правовая форма',
        'abbreviation' => 'Aббревиатура',
        'decoding' => 'Расшифровка',
    ],
    'banks' => [
        'banks' => 'Банки',
        'bank' => 'Банк',
        'BIC' => 'БИК',
        'correspondent_account' => 'Корсчет',
        'name' => 'Название',
    ],

    'regions' => [
        'regions' => 'Регионы',
        'region' => 'Регион',
        'name' => 'Название региона',
        'zone' => 'Зона',
        'notifications' => [
            'info' => 'В скобках названия региона указан номер зоны, к которой относится данный регион.',
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
                        'success' => 'Классификатор типов готовой продукции успешно обновлен',
                        'fail' => 'Не удалось обновить классификатор типов готовой продукции',
                    ],
                    'create' => [
                        'success' => 'Тип готовой продукции :name успешно добавлен в классификатор',
                        'fail' => 'Не удалось добавить тип готовой продукции в классификатор',
                    ],
                ],
            ],
            'international_names_of_end_products' => [
                'international_names_of_end_products' => 'Международные непатентованные названия',
                'international_name_of_end_product' => 'Международ. непатент. назв.',
                'name' => 'Название',
                'actions' => [
                    'update' => [
                        'success' => 'Международные непатентованные названия успешно обновлены',
                        'fail' => 'Не удалось обновить классификатор международных
                        непатентованных названий готовой продукции',
                    ],
                    'create' => [
                        'success' => 'Международное непатентованное название :name продукции успешно добавлено',
                        'fail' => 'Не удалось добавить международное непатентованное название готовой продукции',
                    ],
                ],
            ],
            'okpd2' => [
                'okpd2' => 'Классификатор ОКПД2',
                'code' => 'Код',
                'name' => 'Наименование',
            ],
            'registration_numbers' => [
                'registration_numbers' => 'Регистрационные номера готовой продукции',
                'registration_number' => 'Регистрационный номер',
                'without_registration_number' => 'Нет номера',
                'number' => 'Номер',
            ],
            'types_of_aggregation' => [
                'types_of_aggregation' => 'Типы агрегации',
                'type_of_aggregation' => 'Тип агрегации',
                'code' => 'Код',
                'name' => 'Название типа',
                'product_quantity' => 'Кол-во продукции',
            ],
            'product_catalog' => [
                'product_catalog' => 'Каталог готовой продукции',
                'product_id' => 'Готовый продукт',
                'place_of_business_id' => 'Производство',
                'GTIN' => 'GTIN',
                'statistic' => 'Статистика',
            ],
            'product_prices' => [
                'product_prices' => 'Прайс',
                'organization_id' => 'Поставщик',
                'retail_price' => 'Розничная цена',
                'trade_price' => 'Оптовая цена',
                'nds' => 'НДС %',
                'trade_quantity' => 'Оптовое кол-во',
                'tips' => [
                    'price_added' => 'Прайс добавлен',
                    'price_not_added' => 'Прайс не добавлен',
                ],
            ],
            'regional_allowances' => [
                'regional_allowances' => 'Региональные надбавки',
                'region_id' => 'Регион',
                'allowance' => 'Надбавка',
            ],
        ],
        'materials' => [
            'materials' => 'Комплектующие',
            'material' => 'Комплектующее',
            'type_id' => 'Тип комплектующего',
            'okei_code' => 'Единица измерения',
            'name' => 'Наименование',
            'price' => 'Цена с НДС',
            'nds' => 'НДС',
            'types_of_materials' => [
                'types_of_materials' => 'Типы комплектующих',
                'name' => 'Тип',
            ],
        ],
        'services' => [
            'services' => 'Услуги',
            'service' => 'Услуга',
            'name' => 'Наименование',
            'okei' => 'Единица измерения',
        ],
        'okei' => [
            'okei' => 'Классификатор ОКЕИ',
            'code' => 'Код',
            'unit' => 'Единица измерения',
            'symbol' => 'Сокращение',
        ],
    ],
];
