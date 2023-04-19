@if (session('success'))
    <div class="alert alert-success mb-2" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill"/>
        </svg>
        <small>{{ __(session('success')) }}</small>
        <button type="button" class="btn-close btn-sm align-middle" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif
@if (session('fail'))
    <div class="alert alert-danger mb-2" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img" aria-label="Dunger:">
            <use xlink:href="#check-circle-fill"/>
        </svg>
        <small>{{ __(session('fail')) }}</small>
        <button type="button" class="btn-close btn-sm align-middle" data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>
@endif
@error('fail')
<div class="alert alert-danger mb-2" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill"/>
    </svg>
    <small>{{ $message }}</small>
    <button type="button" class="btn-close btn-sm align-middle" data-bs-dismiss="alert"
            aria-label="Close"></button>
</div>
@enderror
