@include(
    'layouts.sidebar.dropdown-item',
     [
         'icon' => 'bi bi-journals',
         'title' => __('Consignment Notes'),
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
