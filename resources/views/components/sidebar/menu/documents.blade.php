@roles(['marketing', 'bookkeeping'])
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
        {{-- Документы на отгрузку --}}
        <div class="card border-0">
            <div class="card-header d-grid gap-2 bg-white p-1 border-0">
                <button class="btn text-primary dropdown-toggle text-start fw-bold fs-6"
                        type="button"
                        data-bs-toggle="collapse"
                        href="#shipment"
                        role="button"
                        aria-expanded="false"
                        aria-controls="shipment">
                    {{__('documents.shipment.shipment')}}
                </button>
            </div>
            <div class="card-body pt-1 pb-1 collapse" id="shipment">
                <x-sidebar.menu.dropdown.item icon="bi bi-file-earmark-text"
                                              title="{{__('documents.shipment.packing_lists.packing_lists')}}">
                    <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                  route="{{route('packing_lists.index')}}"/>
                </x-sidebar.menu.dropdown.item>
                <x-sidebar.menu.dropdown.item icon="bi bi-file-earmark-text"
                                              title="{{__('documents.shipment.bills.bills')}}">
                    <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                  route="{{route('bills.index')}}"/>
                </x-sidebar.menu.dropdown.item>
            </div>

        </div>
    </div>
</div>
@end_roles
