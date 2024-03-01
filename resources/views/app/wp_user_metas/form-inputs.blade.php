@php $editing = isset($wpUserMeta) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_id"
            label="User Id"
            :value="old('user_id', ($editing ? $wpUserMeta->user_id : '0'))"
            maxlength="255"
            placeholder="User Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="meta_key"
            label="Meta Key"
            :value="old('meta_key', ($editing ? $wpUserMeta->meta_key : ''))"
            maxlength="255"
            placeholder="Meta Key"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="meta_value" label="Meta Value" maxlength="255"
            >{{ old('meta_value', ($editing ? $wpUserMeta->meta_value : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
