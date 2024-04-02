@php $editing = isset($item) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="uid"
            label="Uid"
            :value="old('uid', ($editing ? $item->uid : ''))"
            maxlength="255"
            placeholder="Uid"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="main_category_id" label="Main Category">
            @php $selected = old('main_category_id', ($editing ? $item->main_category_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Category</option>
            @foreach($categories as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $item->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $item->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="short" label="Short" maxlength="255"
            >{{ old('short', ($editing ? $item->short : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="content" label="Content" maxlength="255"
            >{{ old('content', ($editing ? $item->content : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="data" label="Data" maxlength="255"
            >{{ old('data', ($editing ? json_encode($item->data) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $item->image ? \Storage::url($item->image) : '' }}')"
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
            x-data="imageViewer('{{ $editing && $item->thumbnail ? \Storage::url($item->thumbnail) : '' }}')"
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
        <x-inputs.select name="author_id" label="Author" required>
            @php $selected = old('author_id', ($editing ? $item->author_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Author</option>
            @foreach($authors as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="created_by_user_id"
            label="Created By User Id"
            :value="old('created_by_user_id', ($editing ? $item->created_by_user_id : ''))"
            maxlength="255"
            placeholder="Created By User Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="created_by_user_name"
            label="Created By User Name"
            :value="old('created_by_user_name', ($editing ? $item->created_by_user_name : ''))"
            maxlength="255"
            placeholder="Created By User Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="edited_by_user_id"
            label="Edited By User Id"
            :value="old('edited_by_user_id', ($editing ? $item->edited_by_user_id : ''))"
            maxlength="255"
            placeholder="Edited By User Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="edited_by_user_name"
            label="Edited By User Name"
            :value="old('edited_by_user_name', ($editing ? $item->edited_by_user_name : ''))"
            maxlength="255"
            placeholder="Edited By User Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="translation_id" label="Translation">
            @php $selected = old('translation_id', ($editing ? $item->translation_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Item</option>
            @foreach($items as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="published_at"
            label="Published At"
            value="{{ old('published_at', ($editing ? optional($item->published_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>
</div>
