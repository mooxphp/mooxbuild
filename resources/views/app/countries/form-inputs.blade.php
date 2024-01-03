@php $editing = isset($country) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="continent_id" label="Continent" required>
            @php $selected = old('continent_id', ($editing ? $country->continent_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Continent</option>
            @foreach($continents as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
