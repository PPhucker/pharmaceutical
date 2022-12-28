<div class="offcanvas offcanvas-start"
     tabindex="-1"
     id="offcanvasExample"
     aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header pb-2">
        <h5 class="offcanvas-title text-primary"
            id="offcanvasExampleLabel">
            {{__('Main Menu')}}
        </h5>
        <button type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close">
        </button>
    </div>
    <div class="offcanvas-body ps-2 pe-2 pt-0">
        @admin
        @foreach(
            [
                'users',
                'organizations',
                'counterparties'
            ] as $item)
            @include('layouts.sidebar.items.' . $item)
        @endforeach
        @end_admin
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
        <div class="collapse" id="documents-shipment">
            @foreach(
        [
            'approval',
            'invoices-for-payment',
            'invoices',
            'consignment-notes',
            'waybills',
            'appendixes',
            'protocols'
        ] as $item)
                @include('layouts.sidebar.items.documents.shipment.' . $item)
            @endforeach
        </div>
        <div class="offcanvas-header pt-2 pb-2 ps-2">
            <h5 class="offcanvas-title text-primary">
                <a class="btn-link"
                   data-bs-toggle="collapse"
                   href="#production"
                   role="button"
                   aria-expanded="false"
                   aria-controls="production">
                    {{__('Production')}}
                </a>
            </h5>
        </div>
        <div class="collapse" id="production">
            @foreach(
        [
            'production',
            'international-names',
            'classifier-of-metrics-units',
            'classifier-by-economic-activity',
            'registration-numbers',
            'types-of-packages',
            'types-of-products'
        ] as $item)
                @include('layouts.sidebar.items.production.' . $item)
            @endforeach
        </div>
    </div>
</div>
