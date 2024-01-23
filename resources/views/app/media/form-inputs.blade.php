@php $editing = isset($media) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="uuid"
            label="Uuid"
            :value="old('uuid', ($editing ? $media->uuid : ''))"
            maxlength="255"
            placeholder="Uuid"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="collection_name"
            label="Collection Name"
            :value="old('collection_name', ($editing ? $media->collection_name : ''))"
            maxlength="255"
            placeholder="Collection Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $media->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="file_name"
            label="File Name"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="file_name"
            id="file_name"
            class="form-control-file"
        />

        @if($editing && $media->file_name)
        <div class="mt-2">
            <a href="{{ \Storage::url($media->file_name) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('file_name') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="mime_type"
            label="Mime Type"
            :value="old('mime_type', ($editing ? $media->mime_type : ''))"
            maxlength="255"
            placeholder="Mime Type"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="disk"
            label="Disk"
            :value="old('disk', ($editing ? $media->disk : ''))"
            maxlength="255"
            placeholder="Disk"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="conversions_disk"
            label="Conversions Disk"
            :value="old('conversions_disk', ($editing ? $media->conversions_disk : ''))"
            maxlength="255"
            placeholder="Conversions Disk"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="size"
            label="Size"
            :value="old('size', ($editing ? $media->size : ''))"
            maxlength="255"
            placeholder="Size"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="manipulations"
            label="Manipulations"
            maxlength="255"
            required
            >{{ old('manipulations', ($editing ?
            json_encode($media->manipulations) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="custom_properties"
            label="Custom Properties"
            maxlength="255"
            required
            >{{ old('custom_properties', ($editing ?
            json_encode($media->custom_properties) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="generated_conversions"
            label="Generated Conversions"
            maxlength="255"
            required
            >{{ old('generated_conversions', ($editing ?
            json_encode($media->generated_conversions) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="responsive_images"
            label="Responsive Images"
            maxlength="255"
            required
            >{{ old('responsive_images', ($editing ?
            json_encode($media->responsive_images) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="order_column"
            label="Order Column"
            :value="old('order_column', ($editing ? $media->order_column : ''))"
            maxlength="255"
            placeholder="Order Column"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="model_id"
            label="Model Id"
            :value="old('model_id', ($editing ? $media->model_id : ''))"
            maxlength="255"
            placeholder="Model Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="model_type"
            label="Model Type"
            :value="old('model_type', ($editing ? $media->model_type : ''))"
            maxlength="255"
            placeholder="Model Type"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
