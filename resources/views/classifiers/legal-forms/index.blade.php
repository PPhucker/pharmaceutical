@extends('layouts.app')
@section('content')
    <div class="ps-2 pe-2">
        <x-notification.alert/>
    </div>
    <x-token.dadata-token/>
    @include('classifiers.legal-forms.create')
    <x-card
        :title="__('classifiers.legal_forms.legal_forms')">
        <x-form
            :route="route('legal_forms.update', ['legal_form' => $legalForms->first()->abbreviation ?? 1])"
            formId="legal_forms_edit_form"
            method="PATCH">
            <x-data-table.table
                id="legal_forms_table"
                class="table-bordered"
                type="index"
                pageLength="15"
                :domOrderType="true">
                <x-data-table.head>
                    <x-data-table.th
                        class="col-md-2 col-auto"
                        :text="__('classifiers.legal_forms.abbreviation')"/>
                    <x-data-table.th
                        class="col-md col-auto"
                        :text="__('classifiers.legal_forms.decoding')"/>
                </x-data-table.head>
                <x-data-table.body>
                    @foreach($legalForms as $key => $legalForm)
                        <x-data-table.tr>
                            <x-data-table.td>
                                <input type="hidden"
                                       name="legal_forms[{{$key}}][original_abbreviation]"
                                       value="{{$legalForm->abbreviation}}"/>
                                <x-form.element.input
                                    name="legal_forms[{{$key}}][abbreviation]"
                                    :value="$legalForm->abbreviation"
                                    :required="true"
                                    max="15"/>
                            </x-data-table.td>
                            <x-data-table.td>
                                <x-form.element.input
                                    name="legal_forms[{{$key}}][decoding]"
                                    :value="$legalForm->decoding"
                                    max="120"/>
                            </x-data-table.td>
                        </x-data-table.tr>
                    @endforeach
                </x-data-table.body>
            </x-data-table.table>
            <footer class="mt-auto sticky-bottom">
                <ul class="list-inline mb-0">
                    @if(count($legalForms) > 0)
                        <li class="list-inline-item">
                            <x-form.button.save formId="legal_forms_edit_form"/>
                        </li>
                    @endif
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
