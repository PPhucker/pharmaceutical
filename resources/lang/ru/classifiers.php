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
            'edit_card' => 'Карточка готового продукта',
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
                'name' => 'Название',
                'type' => 'Тип',
                'color' => 'Цвет',
            ],
            'international_names_of_end_products' => [
                'international_names_of_end_products' => 'Международные непатентованные названия',
                'international_name_of_end_product' => 'Международ. непатент. назв.',
                'name' => 'Название',
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
                'edit_card' => 'Карточка готового продукта из каталога',
                'place_of_business_id' => 'Производство',
                'GTIN' => 'GTIN',
                'statistic' => 'Статистика',
                'price_list' => 'Прайс',
            ],
            'prices' => [
                'prices' => 'Цены',
                'price' => 'Цена (руб.)',
                'nds' => 'НДС (%)',
                'retail' => 'Розничная цена',
                'wholesale' => 'Оптовые цены',
                'specific' => 'Индивидуальные цены',
                'quantity' => 'Количество',
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
            'type_id' => 'Тип',
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
