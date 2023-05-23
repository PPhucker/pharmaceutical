<?php

return [
    'header' => 'Шапка документа',
    'print' => 'Печатная форма',
    'invoices_for_payment' => [
        'invoices_for_payment' => 'Счета на оплату',
        'invoice_for_payment' => 'Счет на оплату',
        'organization_id' => 'Поставщик',
        'organization_place_id' => 'Адрес грузоотправителя',
        'organization_bank_id' => 'Реквизиты поставщика',
        'contractor_id' => 'Получатель',
        'contractor_place_id' => 'Адрес грузополучателя',
        'contractor_bank_id' => 'Реквизиты получателя',
        'number' => 'Номер',
        'date' => 'Дата',
        'director' => 'Руководитель',
        'bookkeeper' => 'Главный бухгалтер',
        'filename' => 'Прикрепленный файл',
        'warning' => 'Внимание! При удалении счета на оплату автоматически удаляется весь пакет документов, созданный на его основании!',
        'actions' => [
            'create' => [
                'success' => 'Счет на оплату №:number успешно создан',
                'fail' => 'Не удалось создать счет на оплату',
            ],
            'update' => [
                'success' => 'Счет на оплату №:number успешно обновлен',
                'fail' => 'Не удалось обновить счет на оплату',
            ],
            'delete' => [
                'success' => 'Счет на оплату №:number успешно удален'
            ],
            'restore' => [
                'success' => 'Счет на оплату №:number успешно восстановлен'
            ],
        ],
        'buttons' => [
            'create' => 'Выставить счет',
            'create_based_on' => 'Создать на основании счетов',
        ],
        'titles' => [
            'create' => 'Выставление счета на оплату',
        ],
        'data' => [
            'data' => 'Продукция счета на оплату',
            'product_catalog_id' => 'Продукт',
            'quantity' => 'Количество',
            'price' => 'Цена с НДС',
            'nds' => 'НДС',
            'fails' => [
                'quantity' => 'Кол-во должно быть кратно :quantity'
            ],
            'actions' => [
                'create' => [
                    'success' => 'Продукт :name успешно добавлен в счет на оплату',
                    'fail' => 'Не удалось добавить продукт в счет на оплату',
                ],
                'update' => [
                    'success' => 'Продукция счета на оплату успешно обновлена',
                    'fail' => 'Не удалось обновить продукцию',
                ],
                'delete' => [
                    'success' => 'Продукт :name успешно удален из счета на оплату',
                ],
                'restore' => [
                    'success' => 'Продукт :name успешно восстановлен',
                ],
            ],
        ],
    ],
    'shipment' => [
        'shipment' => 'Отгрузка',
        'invoice_for_payment_id' => 'Счет на оплату',
        'number' => 'Номер',
        'date' => 'Дата',
        'organization_id' => 'Поставщик',
        'organization_place_id' => 'Адрес грузоотправителя',
        'organization_bank_id' => 'Реквизиты поставщика',
        'contractor_id' => 'Получатель',
        'contractor_place_id' => 'Адрес грузополучателя',
        'contractor_bank_id' => 'Реквизиты получателя',
        'director' => 'Руководитель',
        'bookkeeper' => 'Главный бухгалтер',
        'storekeeper' => 'Зав. складом готовой продукции',
        'filename' => 'Прикрепленный файл',
        'approved' => 'Согласовано',
        'comment' => 'Комментарий',
        'approval' => [
            'approval' => 'Согласование',
            'approved_by' => 'Проверил',
            'approved' => 'Согласовано',
            'not_viewed' => 'Не просмотрено',
            'document' => 'Документ',
            'updated' => 'Обновлено',
            'e-mail' => [
                'send' => [
                    'send' => 'Отправить',
                    'to' => [
                        'markeing' => 'E-mail отделу сбыта о согласовании/несогласовании отгрузки',
                        'digital_comunication' => 'E-mail отделу цифтовых коммуникаций о внесенных изменениях',
                    ],
                    'success' => 'Письмо успешно отправлено',
                ]
            ],
        ],
        'packing_lists' => [
            'packing_lists' => 'Товарные накладные',
            'packing_list' => 'Товарная накладная',
            'buttons' => [
                'create_based_on' => 'Создать на основании товарной накладной',
            ],
            'errors' => [
                'invoice_for_payment_id' => 'Необходимо выбрать хотя бы один счет на оплату',
                'organization_id' => 'Разные поставщики в счетах на оплату',
                'contractor_id' => 'Разные покупатели в счетах на оплату',
                'failed_document' => 'Не удалось создать документ на отгрузку',
            ],
            'titles' => [
                'create' => 'Создание товарной накладной',
            ],
            'warning' => 'Внимание! При удалении товарной накладной автоматически удаляется весь пакет документов на отгрузку!',
            'actions' => [
                'create' => [
                    'success' => 'Товарная накладная №:number успешно создана',
                    'fail' => 'Не удалось создать товарную накладную',
                ],
                'update' => [
                    'success' => 'Товарная накладная №:number успешно обновлена',
                    'fail' => 'Не удалось обновить товарную накладную',
                ],
                'delete' => [
                    'success' => 'Товарная накладная №:number успешно удалена'
                ],
                'restore' => [
                    'success' => 'Товарная накладаная №:number успешно восстановлена'
                ],
            ],
            'data' => [
                'actions' => [
                    'create' => [
                        'success' => 'Продукт :name успешно добавлен в товарную накладную',
                        'fail' => 'Не удалось добавить продукт в товарную накладную',
                    ],
                    'update' => [
                        'success' => 'Продукция товарной накладной успешно обновлена',
                        'fail' => 'Не удалось обновить продукцию товарной накладной',
                    ],
                    'delete' => [
                        'success' => 'Продукт :name успешно удален из товарной накладной',
                    ],
                    'restore' => [
                        'success' => 'Продукт :name успешно восстановлен',
                    ],
                ],
            ],
        ],
        'bills' => [
            'bills' => 'Счет-фактуры',
            'bill' => 'Счет-фактура',
            'errors' => [
                'packing_list_id' => [
                    'required' => 'Необходимо выбрать товарную накладную',
                    'unique' => 'На основании товарной накладной можно создать только одну счет-фактуру',
                ],
            ],
            'titles' => [
                'create' => 'Создание счет-фактуры',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Счет-фактура №:number успешно создана',
                    'fail' => 'Не удалось создать счет-фактуру',
                ],
                'update' => [
                    'success' => 'Счет-фактура №:number успешно обновлена',
                    'fail' => 'Не удалось обновить счет-фактуру',
                ],
                'delete' => [
                    'success' => 'Счет-фактура №:number успешно удалена'
                ],
                'restore' => [
                    'success' => 'Счет-фактура №:number успешно восстановлена'
                ],
            ],
        ],
        'appendixes' => [
            'appendixes' => 'Приложения',
            'appendix' => 'Приложение',
            'errors' => [
                'packing_list_id' => [
                    'required' => 'Необходимо выбрать товарную накладную',
                    'unique' => 'На основании товарной накладной можно создать только одно приложение',
                ],
            ],
            'titles' => [
                'create' => 'Создание приложения',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Приложение №:number успешно создано',
                    'fail' => 'Не удалось создать приложение',
                ],
                'update' => [
                    'success' => 'Приложение №:number успешно обновлено',
                    'fail' => 'Не удалось обновить приложение',
                ],
                'delete' => [
                    'success' => 'Приложение №:number успешно удалено'
                ],
                'restore' => [
                    'success' => 'Приложение №:number успешно восстановлено'
                ],
            ],
        ],
        'protocols' => [
            'protocols' => 'Протоколы',
            'protocol' => 'Протокол',
            'errors' => [
                'packing_list_id' => [
                    'required' => 'Необходимо выбрать товарную накладную',
                    'unique' => 'На основании товарной накладной можно создать только один протокол',
                ],
            ],
            'titles' => [
                'create' => 'Создание протокола',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Протокол №:number успешно создан',
                    'fail' => 'Не удалось создать протокол',
                ],
                'update' => [
                    'success' => 'Протокол №:number успешно обновлен',
                    'fail' => 'Не удалось обновить протокол',
                ],
                'delete' => [
                    'success' => 'Протокол №:number успешно удален'
                ],
                'restore' => [
                    'success' => 'Протокол №:number успешно восстановлен'
                ],
            ],
        ],
        'waybills' => [
            'waybills' => 'Товарно-транспортные накладные',
            'waybill' => 'Товарно-транспортная накладная',
            'car_model' => 'Автомобиль',
            'state_car_number' => 'Гос. номер автомобиля',
            'driver' => 'Водитель',
            'licence_card' => [
                'licence_card' => 'Лицензионная карточка',
                'standard' => 'Стандартная',
                'limited' => 'Ограниченная',
            ],
            'type_of_transportation' => [
                'type_of_transportation' => 'Вид перевозки',
                'automotive' => 'Автомобильный',
                'manual_movement' => 'Ручное перемещение',
            ],
            'trailer' => 'Прицеп',
            'state_trailer_number' => 'Гос. номер прицепа',

            'errors' => [
                'packing_list_id' => [
                    'required' => 'Необходимо выбрать товарную накладную',
                    'unique' => 'На основании товарной накладной можно создать только одну
                    товарно-транспортную накладную',
                    'last' => 'Товарно-транспортная накладная создается последней',
                ],
            ],
            'titles' => [
                'create' => 'Создание товарно-транспортной накладной',
            ],
            'actions' => [
                'create' => [
                    'success' => 'Товарно-транспортная накладная №:number успешно создана',
                    'fail' => 'Не удалось создать товарно-транспортную накладную',
                ],
                'update' => [
                    'success' => 'Товарно-транспортная накладная №:number успешно обновлена',
                    'fail' => 'Не удалось обновить товарно-транспортную накладную',
                ],
                'delete' => [
                    'success' => 'Товарно-транспортная накладная №:number успешно удалена'
                ],
                'restore' => [
                    'success' => 'Товарно-транспортная накладная №:number успешно восстановлена'
                ],
            ],
        ],
        'data' => [
            'production' => 'Продукция',
            'product_catalog_id' => 'Наименование',
            'series' => 'Серия',
            'quantity' => 'Кол-во',
            'price' => 'Цена с НДС',
            'nds' => 'НДС',
            'titles' => [
                'choose_products' => 'Выберите продукцию из счетов на оплату',
            ],
        ],
    ],
];
