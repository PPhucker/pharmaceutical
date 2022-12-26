@include(
    'layouts.sidebar.dropdown-item',
     [
         'icon' => 'bi bi-building-fill',
         'title' => __('Organizations'),
         'items' => [
             [
                 'route' => '#',
                 'subtitle' => __('Add')
             ],
             [
                 'route' => '#',
                 'subtitle' => __('List')
             ],
         ]
     ]
)
