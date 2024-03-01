@php $editing = isset($wpCommentMeta) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment_id"
            label="Comment Id"
            :value="old('comment_id', ($editing ? $wpCommentMeta->comment_id : '0'))"
            maxlength="255"
            placeholder="Comment Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="meta_key"
            label="Meta Key"
            :value="old('meta_key', ($editing ? $wpCommentMeta->meta_key : ''))"
            maxlength="255"
            placeholder="Meta Key"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="meta_value"
            label="Meta Value"
            maxlength="255"
            required
            >{{ old('meta_value', ($editing ? $wpCommentMeta->meta_value : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
