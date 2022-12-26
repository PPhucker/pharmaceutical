@include(
    'layouts.sidebar.dropdown-item',
     [
         'icon' => 'bi bi-journals',
         'title' => __('Appendixes'),
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
