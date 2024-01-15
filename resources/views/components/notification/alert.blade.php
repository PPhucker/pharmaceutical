<div class="col-12">
    @if (session('success'))
        <div class="alert alert-success m-2"
             role="alert">
            <svg class="bi flex-shrink-0"
                 width="16" height="16"
                 role="img"
                 aria-label="Success:">
                <use xlink:href="#check-circle-fill"/>
            </svg>
            {{ __(session('success')) }}
            <button type="button"
                    class="btn-close btn-sm align-middle"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif
    @error('fail')

    <div class="alert alert-danger m-2"
         role="alert">
        <svg class="bi flex-shrink-0"
             width="16"
             height="16"
             role="img"
             aria-label="Dunger:">
            <use xlink:href="#exclamation-triangle-fill"/>
        </svg>
        {{ $message }}
        <button type="button"
                class="btn-close btn-sm align-middle"
                data-bs-dismiss="alert"
                aria-label="Close"></button>
    </div>

    @enderror
    @if($errors->has('alert-errors'))
        @foreach($errors->get('alert-errors') as $error)
            <div class="alert alert-danger m-2"
                 role="alert">
                <svg class="bi flex-shrink-0"
                     width="16"
                     height="16"
                     role="img"
                     aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill"/>
                </svg>
                {{ $error }}
                <button type="button"
                        class="btn-close btn-sm align-middle"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        @endforeach
    @endif

</div>
