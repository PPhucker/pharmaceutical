@aware(['id'])
@permissions(['restoring'])
<div class="ms-auto ">
    <div class="form-check form-switch mt-2 form-check-inline align-middle">
        <input class="form-check-input"
               type="radio"
               name="inlineRadioOptions"
               id="workItems"
               value="1"
               onclick='Filter.showTrashed("{{$id}}", "working")'
               checked>
        <label class="form-check-label text-primary"
               for="workItems">
            {{__('datatable.entries.working')}}
        </label>
    </div>
    <div class="form-check form-switch mt-2 form-check-inline align-middle">
        <input class="form-check-input"
               type="radio"
               name="inlineRadioOptions"
               id="trashItems"
               value="1"
               onclick='Filter.showTrashed("{{$id}}", "trashed")'>
        <label class="form-check-label text-primary"
               for="trashItems">
            {{__('datatable.entries.trashed')}}
        </label>
    </div>
</div>
@end_permissions
