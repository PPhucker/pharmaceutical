<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="offcanvasRight"
     aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header pb-2">
        <h4 class="offcanvas-title text-primary"
            id="offcanvasExampleLabel">
            {{__('Account')}}
        </h4>
        <button type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close">
        </button>
    </div>
    <div class="offcanvas-body ps-2 pe-2 pt-0">
        @foreach(
            [
                'logout'
            ] as $item
        )
            @include('layouts.account.items.' . $item)
        @endforeach
    </div>
</div>
