<div class="list-inline-item pb-2">
    <div class="input-group input-group-sm">
        <span class="input-group-text">
            {{__('datatable.interval')}}
        </span>
        <input type="date"
               value="{{$fromDate}}"
               class="form-control form-control-sm align-middle"
               id="fromDate"
               name="fromDate">
        <input type="date"
               value="{{$toDate}}"
               class="form-control form-control-sm align-middle"
               id="toDate"
               name="toDate">
        <span class="input-group-text alert alert-primary mb-0">
            {{__('filters.date.default')}}
        </span>
    </div>
</div>
