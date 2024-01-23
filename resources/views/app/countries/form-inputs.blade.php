@php $editing = isset($country) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $country->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $country->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="continent_id" label="Continent" required>
            @php $selected = old('continent_id', ($editing ? $country->continent_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Continent</option>
            @foreach($continents as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="delivery"
            label="Delivery"
            :checked="old('delivery', ($editing ? $country->delivery : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="official"
            label="Official"
            :value="old('official', ($editing ? $country->official : ''))"
            maxlength="255"
            placeholder="Official"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="native_name"
            label="Native Name"
            maxlength="255"
            required
            >{{ old('native_name', ($editing ?
            json_encode($country->native_name) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="tld"
            label="Tld"
            :value="old('tld', ($editing ? $country->tld : ''))"
            maxlength="255"
            placeholder="Tld"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="independent"
            label="Independent"
            :checked="old('independent', ($editing ? $country->independent : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="un_member"
            label="Un Member"
            :checked="old('un_member', ($editing ? $country->un_member : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $country->status : '')) @endphp
            <option value="officially-assigned" {{ $selected == 'officially-assigned' ? 'selected' : '' }} >Officially assigned</option>
            <option value="user-assigned" {{ $selected == 'user-assigned' ? 'selected' : '' }} >User assigned</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="cca2"
            label="Cca2"
            :value="old('cca2', ($editing ? $country->cca2 : ''))"
            maxlength="255"
            placeholder="Cca2"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ccn3"
            label="Ccn3"
            :value="old('ccn3', ($editing ? $country->ccn3 : ''))"
            maxlength="255"
            placeholder="Ccn3"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="cca3"
            label="Cca3"
            :value="old('cca3', ($editing ? $country->cca3 : ''))"
            maxlength="255"
            placeholder="Cca3"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="cioc"
            label="Cioc"
            :value="old('cioc', ($editing ? $country->cioc : ''))"
            maxlength="255"
            placeholder="Cioc"
        ></x-inputs.text>
    </x-inputs.group>
</div>
