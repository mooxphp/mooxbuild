@php $editing = isset($timezone) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="zone_name"
            label="Zone Name"
            :value="old('zone_name', ($editing ? $timezone->zone_name : ''))"
            maxlength="255"
            placeholder="Zone Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="country_code"
            label="Country Code"
            :value="old('country_code', ($editing ? $timezone->country_code : ''))"
            maxlength="2"
            placeholder="Country Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="abbreviation"
            label="Abbreviation"
            :value="old('abbreviation', ($editing ? $timezone->abbreviation : ''))"
            maxlength="6"
            placeholder="Abbreviation"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="time_start"
            label="Time Start"
            :value="old('time_start', ($editing ? $timezone->time_start : ''))"
            max="255"
            placeholder="Time Start"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="gmt_offset"
            label="Gmt Offset"
            :value="old('gmt_offset', ($editing ? $timezone->gmt_offset : ''))"
            max="255"
            placeholder="Gmt Offset"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="dst"
            label="Dst"
            :checked="old('dst', ($editing ? $timezone->dst : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
