<link href="{{ asset('css/templates/documents/shipment/packing_list.css') }}" rel="stylesheet">
<div class="table-responsive">
    <div id="document-template" style="zoom: 100%">
        @include('templates.documents.shipment.packing-list.header')
        @include('templates.documents.shipment.packing-list.production')
        @include('templates.documents.shipment.packing-list.footer')
    </div>
</div>
