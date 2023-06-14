<div class="offcanvas-header pt-2 pb-2 ps-2">
    <h5 class="offcanvas-title text-primary">
        <a class="btn-link"
           data-bs-toggle="collapse"
           href="#production"
           role="button"
           aria-expanded="false"
           aria-controls="production">
            {{__('Production')}}
        </a>
    </h5>
</div>
<div class="collapsed" id="production">
    <x-sidebar.menu.dropdown.item icon="bi bi-bandaid"
                                  title="Nomenclature">
        <x-sidebar.menu.dropdown.link title="Add"
                                      route="#"/>
        <x-sidebar.menu.dropdown.link title="List"
                                      route="#"/>
    </x-sidebar.menu.dropdown.item>
    <x-sidebar.menu.link route="#"
                         icon="bi bi-journal-text"
                         title="International Names"/>
    <x-sidebar.menu.link route="#"
                         icon="bi bi-journal-text"
                         title="Classifier Of Metrics Units"/>
    <x-sidebar.menu.link route="#"
                         icon="bi bi-journal-text"
                         title="Classifier By Economic Activity"/>
    <x-sidebar.menu.link route="#"
                         icon="bi bi-journal-text"
                         title="Registration Numbers"/>
    <x-sidebar.menu.link route="#"
                         icon="bi bi-journal-text"
                         title="Types Of Packages"/>
    <x-sidebar.menu.link route="#"
                         icon="bi bi-journal-text"
                         title="Types Of Products"/>
</div>
