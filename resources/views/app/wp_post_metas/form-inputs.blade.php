@php $editing = isset($wpPostMeta) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="post_id"
            label="Post Id"
            :value="old('post_id', ($editing ? $wpPostMeta->post_id : '0'))"
            maxlength="255"
            placeholder="Post Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="meta_key"
            label="Meta Key"
            :value="old('meta_key', ($editing ? $wpPostMeta->meta_key : ''))"
            maxlength="255"
            placeholder="Meta Key"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="meta_value" label="Meta Value" maxlength="255"
            >{{ old('meta_value', ($editing ? $wpPostMeta->meta_value : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
