<button id="collapse_button_{{$cardId}}"
        name="collapse_button"
        class="btn btn-primary add"
        title="{{__('form.titles.add')}}"
        data-bs-toggle="collapse"
        data-add="{{__('form.button.add')}}"
        data-hide="{{__('form.button.hide')}}"
        href="#{{$cardId}}"
        role="button"
        aria-expanded="true"
        aria-controls="{{$cardId}}">
    {{__('form.button.add')}}
</button>
<script>
    document.getElementById("collapse_button_{{$cardId}}").onclick = function() {
        const add = 'add';
        const hide = 'hide';

        const localization = {
            add: '{{__('form.button.add')}}',
            hide: '{{__('form.button.hide')}}',
        };

        if (this.classList.contains(add)) {
            this.classList.remove(add);
            this.classList.add(hide);
            this.innerHTML = localization.hide;
        } else {
            this.classList.remove(hide);
            this.classList.add(add);
            this.innerHTML = localization.add;
        }
    };
</script>
