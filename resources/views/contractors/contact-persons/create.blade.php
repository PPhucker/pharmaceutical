<x-forms.collapse.creation cardId="div_add_contact_person"
                           errorName="contact_person.*">
    <x-slot name="cardBody">
        <form id="form_add_contact_person"
              method="POST"
              action="{{route('contact_persons.store')}}">
            @csrf
            <input type="hidden"
                   name="contact_person[contractor_id]"
                   value="{{$contractor->id}}">
            <x-forms.row id="contact-person-name"
                         label="{{__('contractors.contact_persons.name')}}">
                <input type="text"
                       name="contact_person[name]"
                       id="contact-person-name"
                       value="{{old('contact_person.name')}}"
                       class="form-control form-control-sm text-primary
                       @error('contact_person.name') is-invalid @enderror"
                       required>
                <x-forms.span-error name="contact_person.name"/>
            </x-forms.row>
            <x-forms.row id="contact-person-post"
                         label="{{__('contractors.contact_persons.post')}}">
                <input type="text"
                       name="contact_person[post]"
                       id="contact-person-post"
                       value="{{old('contact_person.post')}}"
                       class="form-control form-control-sm text-primary
                       @error('contact_person.post') is-invalid @enderror">
                <x-forms.span-error name="contact_person.post"/>
            </x-forms.row>
            <x-forms.row id="contact-person-phone"
                         label="{{__('contractors.contact_persons.phone')}}">
                <input type="text"
                       name="contact_person[phone]"
                       id="contact-person-phone"
                       value="{{old('contact_person.phone')}}"
                       class="form-control form-control-sm text-primary
                       @error('contact_person.phone') is-invalid @enderror">
                <x-forms.span-error name="contact_person.phone"/>
            </x-forms.row>
            <x-forms.row id="contact-person-email"
                         label="{{__('contractors.contact_persons.email')}}">
                <input type="text"
                       name="contact_person[email]"
                       id="contact-person-email"
                       value="{{old('contact_person.email')}}"
                       class="form-control form-control-sm text-primary
                       @error('contact_person.email') is-invalid @enderror">
                <x-forms.span-error name="contact_person.email"/>
            </x-forms.row>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-buttons.save formId="form_add_contact_person"/>
    </x-slot>
</x-forms.collapse.creation>
