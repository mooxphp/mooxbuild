@php $editing = isset($contentElement) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $contentElement->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $contentElement->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $contentElement->description :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="data_structure"
            label="Data Structure"
            maxlength="255"
            required
            >{{ old('data_structure', ($editing ?
            json_encode($contentElement->data_structure) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="template"
            label="Template"
            maxlength="255"
            required
            >{{ old('template', ($editing ? $contentElement->template : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="component"
            label="Component"
            :value="old('component', ($editing ? $contentElement->component : ''))"
            maxlength="255"
            placeholder="Component"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="theme_id" label="Theme" required>
            @php $selected = old('theme_id', ($editing ? $contentElement->theme_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Theme</option>
            @foreach($themes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
