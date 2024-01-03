@php $editing = isset($whitelist) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="comment"
            label="Comment"
            :value="old('comment', ($editing ? $whitelist->comment : ''))"
            maxlength="255"
            placeholder="Comment"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ip-address"
            label="Ip Address"
            :value="old('ip-address', ($editing ? $whitelist->ip-address : ''))"
            maxlength="255"
            placeholder="Ip Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="lookup"
            label="Lookup"
            :value="old('lookup', ($editing ? $whitelist->lookup : ''))"
            maxlength="255"
            placeholder="Lookup"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="expires"
            label="Expires"
            value="{{ old('expires', ($editing ? optional($whitelist->expires)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>
</div>
