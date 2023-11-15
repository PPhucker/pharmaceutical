@roles(['admin'])
<div class="card border-0">
    <div class="card-header d-grid gap-2 bg-white p-1 border-0">
        <button class="btn text-primary dropdown-toggle text-start"
                type="button"
                data-bs-toggle="collapse"
                href="#admin"
                role="button"
                aria-expanded="false"
                aria-controls="admin">
            {{mb_strtoupper(__('sidebar.administrator'))}}
        </button>
    </div>
    <div class="card-body pt-1 pb-1 show" id="admin">
        <x-sidebar.menu.dropdown.item icon="bi bi-people"
                                      title="{{__('users.users')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('users.index')}}"/>
            <x-sidebar.menu.dropdown.link title="{{__('auth.register.action')}}"
                                          route="{{route('users.register')}}"/>
        </x-sidebar.menu.dropdown.item>
        <x-sidebar.menu.dropdown.item icon="bi bi-building"
                                      title="{{__('contractors.organizations.organizations')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                          route="{{route('organizations.create')}}"/>
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('organizations.index')}}"/>
        </x-sidebar.menu.dropdown.item>
        <x-sidebar.menu.dropdown.item icon="bi bi-webcam"
                                      title="{{__('logs.logs')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('logs.index')}}"/>
        </x-sidebar.menu.dropdown.item>
    </div>
</div>
@end_roles
