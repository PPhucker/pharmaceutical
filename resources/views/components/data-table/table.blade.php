@aware(['title'])
@props(['id', 'targets', 'domOrderType' => null])
<div class="table-responsive p-0">
    <div class="list-inline">
        @if(isset($filter))
            <x-data-table.filters.data-table-filter :tableId="$id">
                @if (isset($filter))
                    {{$filter}}
                @endif
            </x-data-table.filters.data-table-filter>
        @endif
    </div>
    <input id="tableId_{{$id}}"
           type="hidden"
           value="{{$id}}">
    <input id="targets_{{$id}}"
           type="hidden"
           value="{{$targets}}">
    <input id="domOrderType_{{$id}}"
           type="hidden"
           value="{{$domOrderType}}">
    <table id="{{$id}}"
           class="table table-sm table-bordered table-hover text-nowrap w-100 mt-0">
        @if(isset($head))
            {{$head}}
        @endif
        {{$slot}}
        <caption id="caption_{{$id}}"
                 class="d-none d-print-none">
            {{$title}}
        </caption>
        <tfoot></tfoot>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const localization = {
            all: '{{__('datatable.entries.all')}}',
            entries: '{{__('datatable.entries.entries')}}',
            hide: '{{__('datatable.buttons.hide')}}',
            noEntries: '{{__('datatable.entries.no')}}',
            noEntriesToFind: '{{__('datatable.entries.no_to_find')}}',
            of: '{{__('datatable.entries.of')}}',
            saveAs: '{{__('datatable.buttons.save_as')}}',
            search: '{{__('datatable.search')}}',
            show: '{{__('datatable.entries.show')}}',
            wait: '{{__('datatable.wait')}}',
        };
        const id = '{{$id}}';

        function initializeDataTable() {
            const tableId = document.getElementById(`tableId_${id}`).value;
            const targets = document.getElementById(`targets_${id}`).value;
            const domOrderType = document.getElementById(`domOrderType_${id}`).value;
            const targetsArray = targets ? targets.split(',').map(Number) : null;

            const dt = new DataTable(tableId, domOrderType, targetsArray, localization);
            dt.render();
        }

        function appendFilterToWrapper() {
            const wrapper = document.getElementById(`${id}_wrapper`);
            const listInline = wrapper.querySelector('.list-inline');
            const filter = document.getElementById(`filter_${id}`);

            listInline.appendChild(filter);
        }

        function setPrintCaption() {
            const caption = document.getElementById(`caption_${id}`);
            caption.textContent = `{{$title}}`;
            caption.classList.remove('d-none', 'd-print-none');
        }

        try {
            initializeDataTable();
            appendFilterToWrapper();
            setPrintCaption();
        } catch (error) {
            console.error('An error occurred:', error);
        }
    });
</script>
