@php $editing = isset($tag) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="uid"
            label="Uid"
            :value="old('uid', ($editing ? $tag->uid : ''))"
            maxlength="255"
            placeholder="Uid"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $tag->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $tag->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="content" label="Content" maxlength="255"
            >{{ old('content', ($editing ? $tag->content : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="data" label="Data" maxlength="255"
            >{{ old('data', ($editing ? json_encode($tag->data) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $tag->image ? \Storage::url($tag->image) : '' }}')"
        >
            <x-inputs.partials.label
                name="image"
                label="Image"
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
                    name="image"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $tag->thumbnail ? \Storage::url($tag->thumbnail) : '' }}')"
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
        <x-inputs.number
            name="weight"
            label="Weight"
            :value="old('weight', ($editing ? $tag->weight : ''))"
            max="255"
            placeholder="Weight"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="model"
            label="Model"
            :value="old('model', ($editing ? $tag->model : ''))"
            maxlength="255"
            placeholder="Model"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="created_by_user_id"
            label="Created By User Id"
            :value="old('created_by_user_id', ($editing ? $tag->created_by_user_id : ''))"
            maxlength="255"
            placeholder="Created By User Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="created_by_user_name"
            label="Created By User Name"
            :value="old('created_by_user_name', ($editing ? $tag->created_by_user_name : ''))"
            maxlength="255"
            placeholder="Created By User Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="edited_by_user_id"
            label="Edited By User Id"
            :value="old('edited_by_user_id', ($editing ? $tag->edited_by_user_id : ''))"
            maxlength="255"
            placeholder="Edited By User Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="edited_by_user_name"
            label="Edited By User Name"
            :value="old('edited_by_user_name', ($editing ? $tag->edited_by_user_name : ''))"
            maxlength="255"
            placeholder="Edited By User Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="translation_id" label="Translation">
            @php $selected = old('translation_id', ($editing ? $tag->translation_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Tag</option>
            @foreach($tags as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="published_at"
            label="Published At"
            value="{{ old('published_at', ($editing ? optional($tag->published_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>
</div>
