@php $editing = isset($wpOption) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="option_name"
            label="Option Name"
            :value="old('option_name', ($editing ? $wpOption->option_name : ''))"
            maxlength="191"
            placeholder="Option Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="option_value"
            label="Option Value"
            maxlength="255"
            required
            >{{ old('option_value', ($editing ? $wpOption->option_value : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="autoload"
            label="Autoload"
            :value="old('autoload', ($editing ? $wpOption->autoload : '20'))"
            maxlength="255"
            placeholder="Autoload"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
