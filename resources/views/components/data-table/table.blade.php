@aware(['title'])
@props([
    'id',
    'type' => 'table',
    'title' => '',
    'class' => null,
    'targets' => null,
    'domOrderType' => null,
    'pageLength' => 50
    ])

<div id="localization-data"
     data-localization='@json(__('datatable'))'>
</div>
<div class="table-responsive p-0">
    <div class="list-inline">
        <x-data-table.filter.data-table-filter tableId="{{$id}}">
            @if (isset($filter))
                {{$filter}}
            @endif
        </x-data-table.filter.data-table-filter>
    </div>
    <input id="tableId_{{$id}}"
           type="hidden"
           value="{{$id}}">
    <input id="targets_{{$id}}"
           type="hidden"
           value="{{$targets}}">
    <input id="orderType_{{$id}}"
           type="hidden"
           value="{{$domOrderType}}">
    <input id="tableType_{{$id}}"
           type="hidden"
           value="{{$type}}">
    <input id="pageLength_{{$id}}"
           type="hidden"
           value="{{$pageLength}}">
    <table id="{{$id}}"
           class="table table-hover {{$class}}">
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
        const table = {{$id}};
        const settings = DataTableManager.getSettings(table.id);
        const dt = new DataTableConfig(settings);

        dt.render();

        const wrapper = document.getElementById(
            table.id + '_' + 'wrapper');

        const listInline = wrapper.getElementsByClassName('list-inline')[0];

        const filter = document.getElementById('filter_' + table.id);

        listInline.append(filter);
    });
</script>
