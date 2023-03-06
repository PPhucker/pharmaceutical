@admin
<div class="offcanvas-header pt-2 pb-2 ps-2">
    <h5 class="offcanvas-title text-primary">
        <a class="btn-link"
           data-bs-toggle="collapse"
           href="#admin"
           role="button"
           aria-expanded="false"
           aria-controls="admin">
            {{'Administrator'}}
        </a>
    </h5>
</div>
<div class="show" id="admin">
    <x-sidebar.menu.dropdown.item icon="bi bi-people-fill"
                                  title="{{__('users.users')}}">
        <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                      route="{{route('users.index')}}"/>
        <x-sidebar.menu.dropdown.link title="{{__('auth.register.action')}}"
                                      route="{{route('users.register')}}"/>
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.dropdown.item icon="bi bi-building-fill"
                                  title="{{__('contractors.organizations.organizations')}}">
        <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                      route="{{route('organizations.create')}}"/>
        <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                      route="{{route('organizations.index')}}"/>
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.link title="{{__('logs.logs')}}"
                         route="{{route('logs.index')}}"
                         icon="bi bi-webcam-fill"/>
</div>
@end_admin
