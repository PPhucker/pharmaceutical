@props(['formId', 'cardId', 'text' => __('form.button.save'), 'class' => null])
<button id="submitButton_{{$formId}}"
        class="btn btn-primary ms-0 m-1 {{$class}}"
        onclick="FormUtils.submitForm('{{ $formId }}')">
    {{$text}}
</button>

