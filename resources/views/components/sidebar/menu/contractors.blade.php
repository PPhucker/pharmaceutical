@roles(['marketing', 'digital_communication', 'bookkeeping'])
<div class="card border-0">
    <div class="card-header d-grid gap-2 bg-white p-1 border-0">
        <button class="btn text-primary dropdown-toggle text-start"
                type="button"
                data-bs-toggle="collapse"
                href="#contractors"
                role="button"
                aria-expanded="false"
                aria-controls="admin">
            {{mb_strtoupper(__('contractors.contractors'))}}
        </button>
    </div>
    <div class="card-body pt-1 pb-1 show" id="contractors">
        <x-sidebar.menu.dropdown.item icon="bi bi-person-vcard"
                                      title="{{__('contractors.contractors')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                          route="{{route('contractors.create')}}"/>
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('contractors.index')}}"/>
        </x-sidebar.menu.dropdown.item>
    </div>
</div>
@end_roles
