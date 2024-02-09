@props(['startDate', 'endDate'])
<div class="list-inline-item pb-2">
    <div class="input-group input-group-sm">
        <span class="input-group-text alert alert-primary mb-0">
            {{__('datatable.interval')}}
        </span>
        <input type="date"
               value="{{$startDate}}"
               class="form-control form-control-sm align-middle"
               id="start_date"
               name="start_date">
        <input type="date"
               value="{{$endDate}}"
               class="form-control form-control-sm align-middle"
               id="end_date"
               name="to_date">
        <span class="input-group-text alert alert-primary mb-0">
            {{__('filters.date.default')}}
        </span>
    </div>
</div>
