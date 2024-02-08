@php $editing = isset($sync) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="syncable_id"
            label="Syncable Id"
            :value="old('syncable_id', ($editing ? $sync->syncable_id : ''))"
            maxlength="255"
            placeholder="Syncable Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="syncable_type"
            label="Syncable Type"
            :value="old('syncable_type', ($editing ? $sync->syncable_type : ''))"
            maxlength="255"
            placeholder="Syncable Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="source_platform_id"
            label="Source Platform"
            required
        >
            @php $selected = old('source_platform_id', ($editing ? $sync->source_platform_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Platform</option>
            @foreach($platforms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="target_platform_id"
            label="Target Platform"
            required
        >
            @php $selected = old('target_platform_id', ($editing ? $sync->target_platform_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Platform</option>
            @foreach($platforms as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="last_sync"
            label="Last Sync"
            value="{{ old('last_sync', ($editing ? optional($sync->last_sync)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
