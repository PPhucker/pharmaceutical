<?php

/**
 * Набор необходимых ролей для работы с моделью.
 */

return [
    'contractor' => [
        'bookkeeping',
        'digital_communication',
        'marketing',
    ],
    'classifier' => [
        'bank' => [
            'bookkeeping',
            'digital_communication',
            'marketing',
        ],
        'legal_form' => [
            'bookkeeping',
            'digital_communication',
            'marketing',
        ],
        'region' => [
            'bookkeeping',
            'digital_communication',
            'marketing',
        ],
    ],
];
