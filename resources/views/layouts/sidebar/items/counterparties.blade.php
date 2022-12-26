@include(
    'layouts.sidebar.dropdown-item',
     [
         'icon' => 'bi bi-person-vcard-fill',
         'title' => __('Counterparties'),
         'items' => [
             [
                 'route' => '#',
                 'subtitle' => __('Add')
             ],
             [
                 'route' => '#',
                 'subtitle' => __('List')
             ],
             [
                 'route' => '#',
                 'subtitle' => __('Legal Forms')
             ],
         ]
     ]
)
