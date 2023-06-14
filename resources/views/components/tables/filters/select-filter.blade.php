<div class="list-inline-item pb-2">
    <div class="input-group input-group-sm">
        <span class="input-group-text">
            {{$title}}
        </span>
        <select name="{{$name}}"
                class="form-control form-control-sm">
            <option value="{{null}}">
                {{__('datatable.entries.all')}}
            </option>
            {{$slot}}
        </select>
    </div>
</div>
