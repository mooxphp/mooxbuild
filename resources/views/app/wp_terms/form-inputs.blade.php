@php $editing = isset($wpTerm) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $wpTerm->name : ''))"
            maxlength="200"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $wpTerm->slug : ''))"
            maxlength="200"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="term_group"
            label="Term Group"
            :value="old('term_group', ($editing ? $wpTerm->term_group : '0'))"
            maxlength="255"
            placeholder="Term Group"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
