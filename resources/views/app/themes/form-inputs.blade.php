@php $editing = isset($theme) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $theme->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $theme->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="theme_package"
            label="Theme Package"
            :value="old('theme_package', ($editing ? $theme->theme_package : ''))"
            maxlength="255"
            placeholder="Theme Package"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="themeable_id"
            label="Themeable Id"
            :value="old('themeable_id', ($editing ? $theme->themeable_id : ''))"
            maxlength="255"
            placeholder="Themeable Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="themeable_type"
            label="Themeable Type"
            :value="old('themeable_type', ($editing ? $theme->themeable_type : ''))"
            maxlength="255"
            placeholder="Themeable Type"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
