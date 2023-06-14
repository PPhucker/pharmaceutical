<?php

return [
    'App' => [
        'Models' => [
            'Auth' => [
                'Role' => 'Роль',
                'User' => 'Пользователь',
                'Permission' => 'Право',
            ],
            'Classifiers' => [
                'LegalForm' => 'Организационно-правовая форма',
                'Bank' => 'Банк',
                'Nomenclature' => [
                    'Products' => [
                        'TypeOfEndProduct' => 'Тип готового продукта',
                        'InternationalNameOfEndProduct' => 'Международное название готового продукта',
                        'OKPD2' => 'Классификатор ОКПД2',
                        'RegistrationNumberOfEndProduct' => 'Регистрационный номер готового продукта',
                        'EndProduct' => 'Конечный продукт',
                        'TypeOfAggregation' => 'Тип аггрегации',
                        'ProductCatalog' => 'Каталог готовой продукции',
                        'ProductPrice' => 'Прайс продукта',
                    ],
                    'OKEI' => 'Классификатор ОКЕИ',
                    'Services' => [
                        'Service' => 'Услуги',
                    ],
                    'Materials' => [
                        'TypeOfMaterial' => 'Тип комплектующего',
                        'Material' => 'Комплектующее',
                    ],
                ],
            ],
            'Admin' => [
                'Organizations' => [
                    'Organization' => 'Организация',
                    'PlaceOfBusiness' => 'Место деятельности организации',
                    'BankAccountDetail' => 'Банковские реквизиты организации',
                    'Staff' => 'Сотрудник организации',
                    'Car' => 'Автомобиль организации',
                    'Driver' => 'Водитель организации',
                    'Trailer' => 'Прицеп организации',
                ],
            ],
            'Contractors' => [
                'Contractor' => 'Контрагент',
                'PlaceOfBusiness' => 'Место осуществления контрагента',
                'BankAccountDetail' => 'Банковские реквизиты контрагента',
                'ContactPerson' => 'Контактное лицо контрагента',
                'Car' => 'Автомобиль контрагента',
                'Driver' => 'Водитель контрагента',
                'Trailer' => 'Прицеп контрагента',
            ],
            'Documents' => [
                'InvoicesForPayment' => [
                    'InvoiceForPayment' => 'Счет на оплату',
                    'InvoiceForPaymentProduct' => 'Готовый продукт счета на оплату',
                    'InvoiceForPaymentMaterial' => 'Комлектующее счета на оплату',
                ],
                'Acts' => [
                    'Act' => 'Акт',
                    'ActService' => 'Устуга акта'
                ],
                'Shipment' => [
                    'PackingLists' => [
                        'PackingList' => 'Товарная накладная',
                        'PackingListProduct' => 'Продукт товарной накладной',
                    ],
                    'Shipment' => 'Отгрузка',
                    'Bills' => [
                        'Bill' => 'Счет-фактура',
                    ],
                    'Appendixes' => [
                        'Appendix' => 'Приложение',
                    ],
                    'Protocols' => [
                        'Protocol' => 'Протокол',
                    ],
                    'Waybills' => [
                        'Waybill' => 'Товарно-транспортная накладная',
                    ],
                ],
            ],
        ],
    ],
];
