@props(['title', 'back' => null, 'footer' => null])
<div class="d-flex justify-content-center m-2">
    <div class="card shadow w-100">
        <ul class="card-header bg-primary">
            <li class="list-inline-item align-middle">
                <a class="btn btn-sm btn-primary text-white"
                   href="{{$back}}"
                   title="{{__('form.button.back')}}">
                    <i class="bi bi-arrow-90deg-left align-middle"></i>
                </a>
            </li>
            <li class="list-inline-item">
                <span class="align-middle text-white fs-5 text-uppercase">
                    {{$title}}
                </span>
            </li>
        </ul>
        <div class="card-body p-1">
            <div class="row gx-2">
                <div class="tab-content"
                     id="nav-card">
                    {{$slot}}
                </div>
            </div>
        </div>
        @if(isset($footer))
            <div class="card-footer sticky-bottom bg-secondary">
                {{$footer}}
            </div>
        @endif
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.getElementsByClassName('nav-link');
        Array.from(navLinks).forEach(function(navLink) {
            navLink.addEventListener('click', function() {
                const textareas = document.getElementsByClassName('auto-expand');
                Array.from(textareas).forEach(function(textarea) {
                    autoExpand(textarea);
                });
            });
        });
    });

    function autoExpand(textarea) {
        textarea.style.height = '1px';
        textarea.style.height = textarea.scrollHeight + 'px';
    }
</script>


