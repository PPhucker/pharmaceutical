<thead class="bg-secondary">
<tr class="text-primary">
    @foreach($columns as $column)
        <th scope="col"
            class="text-center align-middle"
            rowspan="{{$column['rowspan'] ?? ''}}"
            colspan="{{$column['colspan'] ?? ''}}">
            {{__($column['localKey'] ?? '')}}
        </th>
    @endforeach
</tr>
@if(isset($additionalRow))
    {{$additionalRow}}
@endif
</thead>
