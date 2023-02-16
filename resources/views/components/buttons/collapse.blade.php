<button id="collapse_button_{{$formId}}"
        name="collapse_button"
        class="btn btn-sm btn-primary"
        title="{{__('form.titles.add')}}"
        data-bs-toggle="collapse"
        data-add="{{__('form.button.add')}}"
        data-hide="{{__('form.button.hide')}}"
        href="#{{$formId}}"
        role="button"
        aria-expanded="false"
        aria-controls="{{$formId}}">
    <i class="bi bi-plus align-middle fw-bolder"></i>
</button>
<script>
    document.getElementById("collapse_button_{{$formId}}").onclick = function() {
        const addIcon = 'bi-plus';
        const hideIcon = 'bi-eye-slash';

        for (const i of this.getElementsByTagName('i')) {
            if (i.classList.contains(addIcon)) {
                i.classList.remove(addIcon);
                i.classList.add(hideIcon);
                this.title = this.dataset.hide;
            } else {
                i.classList.remove(hideIcon);
                i.classList.add(addIcon);
                this.title = this.dataset.add;
            }
        }
    };
</script>
