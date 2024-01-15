@aware(['title'])
@props([
    'id',
    'type' => 'table',
    'title' => '',
    'targets' => null,
    'domOrderType' => null,
    'pageLength' => 20
    ])

<div id="localization-data"
     data-localization='@json(__('datatable'))'>
</div>

<div class="table-responsive p-0">
    <div class="list-inline">
        @if(isset($filter))
            <x-data-table.filter.data-table-filter :tableId="$id">
                {{$filter}}
            </x-data-table.filter.data-table-filter>
        @endif
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
           class="table table-hover">
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
    });
</script>
