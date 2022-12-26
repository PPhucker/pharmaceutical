@include(
    'layouts.sidebar.dropdown-item',
     [
         'icon' => 'bi bi-clipboard-check',
         'title' => __('Approval'),
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
