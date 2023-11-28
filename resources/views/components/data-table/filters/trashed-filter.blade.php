@aware(['id'])
@permissions(['restoring'])
<div class="form-check form-switch form-check-inline me-2">
    <input class="form-check-input"
           type="radio"
           name="inlineRadioOptions"
           id="workItems"
           value="1"
           onclick='Filter.showTrashed("{{$id}}", "working")'
           checked>
    <label class="form-check-label"
           for="workItems">
        {{__('datatable.entries.working')}}
    </label>
</div>
<div class="form-check form-switch form-check-inline me-2">
    <input class="form-check-input"
           type="radio"
           name="inlineRadioOptions"
           id="trashItems"
           value="1"
           onclick='Filter.showTrashed("{{$id}}", "trashed")'>
    <label class="form-check-label"
           for="trashItems">
        {{__('datatable.entries.trashed')}}
    </label>
</div>
@end_permissions
