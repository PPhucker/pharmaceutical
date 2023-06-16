@roles(['marketing', 'bookkeeping', 'digital_communication'])
<div class="card border-0">
    <div class="card-header d-grid gap-2 bg-white p-1 border-0">
        <button class="btn text-primary dropdown-toggle text-start fs-5"
                type="button"
                data-bs-toggle="collapse"
                href="#documents"
                role="button"
                aria-expanded="false"
                aria-controls="documents">
            {{mb_strtoupper(__('sidebar.documents'))}}
        </button>
    </div>
    <div class="card-body pt-1 pb-1 show" id="documents">
        @roles(['marketing', 'bookkeeping'])
        <x-sidebar.menu.dropdown.item icon="bi bi-file-earmark-text"
                                      title="{{__('documents.invoices_for_payment.invoices_for_payment')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('invoices_for_payment.index')}}"/>
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                          route="{{route('contractors.index')}}"/>
        </x-sidebar.menu.dropdown.item>
        <x-sidebar.menu.dropdown.item icon="bi bi-file-earmark-text"
                                      title="{{__('documents.acts.acts')}}">
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                          route="{{route('acts.index')}}"/>
            <x-sidebar.menu.dropdown.link title="{{__('form.titles.add')}}"
                                          route="{{route('acts.create')}}"/>
        </x-sidebar.menu.dropdown.item>
        @end_roles
        {{-- Документы на отгрузку --}}
        <div class="card border-0">
            <div class="card-header d-grid gap-2 bg-white p-1 border-0">
                <button class="btn text-primary dropdown-toggle text-start fs-6"
                        type="button"
                        data-bs-toggle="collapse"
                        href="#shipment"
                        role="button"
                        aria-expanded="false"
                        aria-controls="shipment">
                    {{mb_strtoupper(__('documents.shipment.shipment'))}}
                </button>
            </div>
            <div class="card-body pt-1 pb-1 collapse" id="shipment">
                <x-sidebar.menu.dropdown.item icon="bi bi-bag-check"
                                              title="{{__('documents.shipment.approval.approval')}}">
                    <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                  route="{{route('shipment.approval')}}"/>
                </x-sidebar.menu.dropdown.item>
                @roles(['marketing', 'bookkeeping'])
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
                <x-sidebar.menu.dropdown.item icon="bi bi-file-earmark-text"
                                              title="{{__('documents.shipment.appendixes.appendixes')}}">
                    <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                  route="{{route('appendixes.index')}}"/>
                </x-sidebar.menu.dropdown.item>
                <x-sidebar.menu.dropdown.item icon="bi bi-file-earmark-text"
                                              title="{{__('documents.shipment.protocols.protocols')}}">
                    <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                  route="{{route('protocols.index')}}"/>
                </x-sidebar.menu.dropdown.item>
                <x-sidebar.menu.dropdown.item icon="bi bi-file-earmark-text"
                                              title="{{__('documents.shipment.waybills.waybills')}}">
                    <x-sidebar.menu.dropdown.link title="{{__('form.titles.list')}}"
                                                  route="{{route('waybills.index')}}"/>
                </x-sidebar.menu.dropdown.item>
                @end_roles
            </div>
        </div>
    </div>
</div>
@end_roles
