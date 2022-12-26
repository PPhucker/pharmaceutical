@include(
    'layouts.account.item',
    [
        'icon' => 'bi bi-door-open-fill',
        'title' => __('Logout'),
        'route' => route('logout'),
        'form' => 'logout-form',
    ]
)
