@php $editing = isset($firewallRule) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="rule"
            label="Rule"
            :value="old('rule', ($editing ? $firewallRule->rule : ''))"
            maxlength="255"
            placeholder="Rule"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $firewallRule->type : '')) @endphp
            <option value="allow" {{ $selected == 'allow' ? 'selected' : '' }} >Allow</option>
            <option value="deny" {{ $selected == 'deny' ? 'selected' : '' }} >Deny</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="all_rule"
            label="All Rule"
            :checked="old('all_rule', ($editing ? $firewallRule->all_rule : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ip_address"
            label="Ip Address"
            :value="old('ip_address', ($editing ? $firewallRule->ip_address : ''))"
            maxlength="255"
            placeholder="Ip Address"
        ></x-inputs.text>
    </x-inputs.group>
</div>
