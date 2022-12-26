@include(
    'layouts.sidebar.dropdown-item',
     [
         'icon' => 'bi bi-people-fill',
         'title' => __('Users'),
         'items' => [
             [
                 'route' => '#',
                 'subtitle' => __('List')
             ],
             [
                 'route' => route('users.register'),
                 'subtitle' => __('Register')
             ],
         ]
     ]
)
