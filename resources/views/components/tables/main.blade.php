@aware(['title'])
<div class="table-responsive p-0">
    <div class="list-inline">
        <x-tables.filters.main tableId="{{$id}}">
            @if (isset($filter))
                {{$filter}}
            @endif
        </x-tables.filters.main>
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

        const tableId = document.getElementById('tableId_' + id).value;
        let targets = document.getElementById('targets_' + id).value;
        const domOrderType = document.getElementById('domOrderType_' + id).value;

        targets = targets ? targets.split(',').map(Number) : null;

        const dt = new DataTable(
            tableId,
            domOrderType,
            targets,
            localization,
        );
        dt.render();

        const wrapper = document.getElementById(
            id + '_' + 'wrapper');

        const listInline = wrapper.getElementsByClassName('list-inline')[0];

        const filter = document.getElementById('filter_' + id);

        listInline.append(filter);
    });
</script>
