@aware(['organizations'])
<div class="offcanvas-header pt-2 pb-2 ps-2">
    <h5 class="offcanvas-title text-primary">
        <a class="btn-link"
           data-bs-toggle="collapse"
           href="#documents-shipment"
           role="button"
           aria-expanded="false"
           aria-controls="documents-shipment">
            {{__('Docs')}} ({{__('Shipment')}})
        </a>
    </h5>
</div>
<div class="collapsed" id="documents-shipment">
    <x-sidebar.menu.dropdown.item icon="bi bi-clipboard-check"
                                  title="Approval">
        @foreach($organizations as $organization)
            <x-sidebar.menu.dropdown.link title="{{$organization->name}}"
                                          route="{{$organization->id}}"/>
        @endforeach

    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.dropdown.item icon="bi bi-journals"
                                  title="Invoices For Payment">
        @foreach($organizations as $organization)
            <x-sidebar.menu.dropdown.link title="{{$organization->name}}"
                                          route="{{$organization->id}}"/>
        @endforeach
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.dropdown.item icon="bi bi-journals"
                                  title="Consignment Notes">
        @foreach($organizations as $organization)
            <x-sidebar.menu.dropdown.link title="{{$organization->name}}"
                                          route="{{$organization->id}}"/>
        @endforeach
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.dropdown.item icon="bi bi-journals"
                                  title="Waybills">
        @foreach($organizations as $organization)
            <x-sidebar.menu.dropdown.link title="{{$organization->name}}"
                                          route="{{$organization->id}}"/>
        @endforeach
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.dropdown.item icon="bi bi-journals"
                                  title="Appendixes">
        @foreach($organizations as $organization)
            <x-sidebar.menu.dropdown.link title="{{$organization->name}}"
                                          route="{{$organization->id}}"/>
        @endforeach
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.dropdown.item icon="bi bi-journals"
                                  title="Protocols">
        @foreach($organizations as $organization)
            <x-sidebar.menu.dropdown.link title="{{$organization->name}}"
                                          route="{{$organization->id}}"/>
        @endforeach
    </x-sidebar.menu.dropdown.item>
</div>
