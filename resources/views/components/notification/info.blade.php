@props(['text'])
<div class="alert alert-info d-flex align-items-lg-center mb-2" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="16" height="16" role="img" aria-label="Info:">
        <use xlink:href="#info-fill"/>
    </svg>
    {{$text}}
    {{$slot}}
</div>
