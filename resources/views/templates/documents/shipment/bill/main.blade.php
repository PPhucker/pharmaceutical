<div  class="print table-responsive">
    {{--{{dd($data)}}--}}
    <div id="document-template"
         style="zoom: 100%">
        <link href="{{ asset('css/templates/documents/shipment/bill.css') }}"
              rel="stylesheet">
        @include('templates.documents.shipment.bill.header')
        @include('templates.documents.shipment.bill.production')
        @include('templates.documents.shipment.bill.footer')
    </div>
</div>
