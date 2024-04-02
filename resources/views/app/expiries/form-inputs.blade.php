@php $editing = isset($expiry) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $expiry->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $expiry->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="item"
            label="Item"
            :value="old('item', ($editing ? $expiry->item : ''))"
            maxlength="255"
            placeholder="Item"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="link"
            label="Link"
            :value="old('link', ($editing ? $expiry->link : ''))"
            maxlength="255"
            placeholder="Link"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="expired_at"
            label="Expired At"
            value="{{ old('expired_at', ($editing ? optional($expiry->expired_at)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="notified_at"
            label="Notified At"
            value="{{ old('notified_at', ($editing ? optional($expiry->notified_at)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="notified_to"
            label="Notified To"
            :value="old('notified_to', ($editing ? $expiry->notified_to : ''))"
            maxlength="255"
            placeholder="Notified To"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="escalated_at"
            label="Escalated At"
            value="{{ old('escalated_at', ($editing ? optional($expiry->escalated_at)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="escalated_to"
            label="Escalated To"
            :value="old('escalated_to', ($editing ? $expiry->escalated_to : ''))"
            maxlength="255"
            placeholder="Escalated To"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="handled_by"
            label="Handled By"
            :value="old('handled_by', ($editing ? $expiry->handled_by : ''))"
            maxlength="255"
            placeholder="Handled By"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="done_at"
            label="Done At"
            value="{{ old('done_at', ($editing ? optional($expiry->done_at)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="expiry_monitor_id"
            label="Expiry Monitor"
            required
        >
            @php $selected = old('expiry_monitor_id', ($editing ? $expiry->expiry_monitor_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Expiry Monitor</option>
            @foreach($expiryMonitors as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
