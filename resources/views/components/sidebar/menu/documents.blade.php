@roles(['marketing', 'bookkeeping', 'digital_communication'])
<div class="card border-0">
    <div class="card-header d-grid gap-2 bg-white p-1 border-0">
        <button class="btn text-primary dropdown-toggle text-start fw-bold fs-5"
                type="button"
                data-bs-toggle="collapse"
                href="#documents"
                role="button"
                aria-expanded="false"
                aria-controls="documents">
            {{__('sidebar.documents')}}
        </button>
    </div>
    <div class="card-body pt-1 pb-1 show" id="documents">
        <x-sidebar.menu.dropdown.item icon="bi bi-file-earmark-text"
                                      title="{{__('documents.invoices_for_payment.invoices_for_payment')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('invoices_for_payment.index')}}"/>
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                          route="{{route('contractors.index')}}"/>
        </x-sidebar.menu.dropdown.item>
    </div>
</div>
@end_roles
