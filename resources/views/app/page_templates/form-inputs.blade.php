@php $editing = isset($pageTemplate) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="page_id" label="Page" required>
            @php $selected = old('page_id', ($editing ? $pageTemplate->page_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Page</option>
            @foreach($pages as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $pageTemplate->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $pageTemplate->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="theme"
            label="Theme"
            :value="old('theme', ($editing ? $pageTemplate->theme : ''))"
            maxlength="255"
            placeholder="Theme"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="view"
            label="View"
            :value="old('view', ($editing ? $pageTemplate->view : ''))"
            maxlength="255"
            placeholder="View"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
