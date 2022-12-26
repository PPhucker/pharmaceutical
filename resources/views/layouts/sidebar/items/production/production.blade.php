@include(
    'layouts.sidebar.dropdown-item',
     [
         'icon' => 'bi bi-bandaid',
         'title' => __('Nomenclature'),
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
