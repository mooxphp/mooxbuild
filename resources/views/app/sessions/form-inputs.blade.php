@php $editing = isset($session) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ip_address"
            label="Ip Address"
            :value="old('ip_address', ($editing ? $session->ip_address : ''))"
            maxlength="255"
            placeholder="Ip Address"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_agent"
            label="User Agent"
            :value="old('user_agent', ($editing ? $session->user_agent : ''))"
            maxlength="255"
            placeholder="User Agent"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="payload"
            label="Payload"
            maxlength="255"
            required
            >{{ old('payload', ($editing ? $session->payload : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="last_activity"
            label="Last Activity"
            :value="old('last_activity', ($editing ? $session->last_activity : ''))"
            max="255"
            placeholder="Last Activity"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $session->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
