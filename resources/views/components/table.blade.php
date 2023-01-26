<div class="table-responsive p-0">
    <div class="list-inline">
        <x-filter tableId="{{$id}}">
            @if (isset($filter))
                {{$filter}}
            @endif
        </x-filter>
    </div>
    <input id="tableId" type="hidden" value="{{$id}}">
    <table id="{{$id}}" class="table table-sm table-bordered table-hover text-nowrap w-100 mt-0">
        {{$slot}}
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

        const dt = new DataTable(
            document.getElementById('tableId').value,
            localization,
        );
        dt.render();

        const wrapper = document.getElementById(
            '{{$id}}' + '_' + 'wrapper');

        const listInline = wrapper.getElementsByClassName('list-inline')[0];

        const filter = document.getElementById('filter');

        listInline.append(filter);
    });
</script>
