@php $editing = isset($content) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select
            name="content_element_id"
            label="Content Element"
            required
        >
            @php $selected = old('content_element_id', ($editing ? $content->content_element_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Content Element</option>
            @foreach($contentElements as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $content->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $content->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="data" label="Data" maxlength="255" required
            >{{ old('data', ($editing ? json_encode($content->data) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="settings"
            label="Settings"
            maxlength="255"
            required
            >{{ old('settings', ($editing ? json_encode($content->settings) :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
