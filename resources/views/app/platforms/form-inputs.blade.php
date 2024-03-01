@php $editing = isset($platform) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $platform->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $platform->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="domain"
            label="Domain"
            :value="old('domain', ($editing ? $platform->domain : ''))"
            maxlength="255"
            placeholder="Domain"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="selection"
            label="Selection"
            :checked="old('selection', ($editing ? $platform->selection : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="order"
            label="Order"
            :value="old('order', ($editing ? $platform->order : ''))"
            maxlength="255"
            placeholder="Order"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="locked"
            label="Locked"
            :checked="old('locked', ($editing ? $platform->locked : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="master"
            label="Master"
            :checked="old('master', ($editing ? $platform->master : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $platform->thumbnail ? \Storage::url($platform->thumbnail) : '' }}')"
        >
            <x-inputs.partials.label
                name="thumbnail"
                label="Thumbnail"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="thumbnail"
                    id="thumbnail"
                    @change="fileChosen"
                />
            </div>

            @error('thumbnail') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="platformable_id"
            label="Platformable Id"
            :value="old('platformable_id', ($editing ? $platform->platformable_id : ''))"
            maxlength="255"
            placeholder="Platformable Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="platformable_type"
            label="Platformable Type"
            :value="old('platformable_type', ($editing ? $platform->platformable_type : ''))"
            maxlength="255"
            placeholder="Platformable Type"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
