<div class="offcanvas-header pt-2 pb-2 ps-2">
    <h5 class="offcanvas-title text-primary">
        <a class="btn-link"
           data-bs-toggle="collapse"
           href="#contractors"
           role="button"
           aria-expanded="false"
           aria-controls='contractors'>
            {{__('contractors.contractors')}}
        </a>
    </h5>
</div>
<div class="show" id="contractors">
    <x-sidebar.menu.dropdown.item icon="bi bi-person-vcard-fill"
                                  title="{{__('contractors.contractors')}}">
        <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                      route="{{route('contractors.create')}}"/>
        <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                      route="{{route('contractors.index')}}"/>
    </x-sidebar.menu.dropdown.item>
</div>
