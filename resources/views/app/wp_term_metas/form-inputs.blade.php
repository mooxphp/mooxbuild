@php $editing = isset($wpTermMeta) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="term_id"
            label="Term Id"
            :value="old('term_id', ($editing ? $wpTermMeta->term_id : '0'))"
            maxlength="255"
            placeholder="Term Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="meta_key"
            label="Meta Key"
            :value="old('meta_key', ($editing ? $wpTermMeta->meta_key : ''))"
            maxlength="255"
            placeholder="Meta Key"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="meta_value" label="Meta Value" maxlength="255"
            >{{ old('meta_value', ($editing ? $wpTermMeta->meta_value : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
