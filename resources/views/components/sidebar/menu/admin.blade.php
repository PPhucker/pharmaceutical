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
<div class="collapsed" id="admin">
    <x-sidebar.menu.dropdown.item icon="bi bi-people-fill"
                                  title="Users">
        <x-sidebar.menu.dropdown.link title="List"
                                      route="{{route('users.index')}}"/>
        <x-sidebar.menu.dropdown.link title="Register"
                                      route="{{route('users.register')}}"/>
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.dropdown.item icon="bi bi-person-vcard-fill"
                                  title="Counterparties">
        <x-sidebar.menu.dropdown.link title="Add"
                                      route="#"/>
        <x-sidebar.menu.dropdown.link title="List"
                                      route="#"/>
        <x-sidebar.menu.dropdown.link title="Legal Forms"
                                      route="#"/>
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.dropdown.item icon="bi bi-building-fill"
                                  title="Organizations">
        <x-sidebar.menu.dropdown.link title="Add"
                                      route="#"/>
        <x-sidebar.menu.dropdown.link title="List"
                                      route="#"/>
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.link title="Logs"
                         route="{{route('logs.index')}}"
                         icon="bi bi-webcam-fill"/>
</div>
@end_admin
