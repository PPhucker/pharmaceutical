@extends('layouts.app')
@section('content')
    <x-notification.alert/>
    <x-card
        :title="$material->name"
        :back="route('materials.index')">
        <x-form
            :route="route('materials.update', ['material' => $material->id])"
            method="PATCH"
            formId="material_edit_form">
            <input type="hidden"
                   name="id"
                   value="{{$material->id}}">
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="short_name"
                        :text="__('classifiers.nomenclature.materials.name')"/>
                </x-slot>
                <x-form.element.input
                    id="name"
                    name="name"
                    :value="$material->name"
                    :required="true"
                    max="150"/>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="short_name"
                        :text="__('classifiers.nomenclature.materials.type_id')"/>
                </x-slot>
                <x-form.element.select
                    id="type_id"
                    name="type_id">
                    @foreach($typesOfMaterials as $key => $type)
                        <x-form.element.option
                            :text="$type->name"
                            :value="$type->id"
                            :selected="$material->type_id === $type->id"/>
                    @endforeach
                </x-form.element.select>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="short_name"
                        :text="__('classifiers.nomenclature.materials.okei_code')"/>
                </x-slot>
                <x-form.element.select
                    id="okei_code"
                    name="okei_code">
                    @foreach($okeiClassifier as $key => $okei)
                        <x-form.element.option
                            :text="$okei->symbol"
                            :value="$okei->code"
                            :selected="$material->okei_code === $okei->code"/>
                    @endforeach
                </x-form.element.select>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="price"
                        :text="__('classifiers.nomenclature.materials.price') . ' ' .  __('currency.rub')"/>
                </x-slot>
                <x-form.element.input
                    id="price"
                    name="price"
                    :value="$material->price"/>
            </x-form.row>
            <x-form.row>
                <x-slot name="label">
                    <x-form.label
                        forId="nds"
                        :text="__('classifiers.nomenclature.materials.nds') . ' ' . '%'"/>
                </x-slot>
                <x-form.element.input
                    id="nds"
                    name="nds"
                    :value="$material->nds * 100"
                    max="100"/>
            </x-form.row>
            <footer class="mt-auto me-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <x-form.button.save formId="materials_edit_form"/>
                    </li>
                </ul>
            </footer>
        </x-form>
    </x-card>
@endsection
