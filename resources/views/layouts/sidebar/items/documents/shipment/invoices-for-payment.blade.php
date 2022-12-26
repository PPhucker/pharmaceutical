@include(
    'layouts.sidebar.dropdown-item',
     [
         'icon' => 'bi bi-journals',
         'title' => __('Invoices For Payment'),
         'items' => [
             [
                 'route' => '#',
                 'subtitle' => __('RB')
             ],
             [
                 'route' => '#',
                 'subtitle' => __('FT')
             ],
         ]
     ]
)
