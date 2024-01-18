@props(['formId', 'cardId', 'text' => __('form.button.save')])
<button id="submitButton_{{$formId}}"
        class="btn btn-primary ms-0 m-1"
        onclick="FormUtils.submitForm('{{ $formId }}')">
    {{$text}}
</button>

