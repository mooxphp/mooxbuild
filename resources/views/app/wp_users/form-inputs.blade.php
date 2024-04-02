@php $editing = isset($wpUser) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_login"
            label="User Login"
            :value="old('user_login', ($editing ? $wpUser->user_login : ''))"
            maxlength="60"
            placeholder="User Login"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_pass"
            label="User Pass"
            :value="old('user_pass', ($editing ? $wpUser->user_pass : ''))"
            maxlength="255"
            placeholder="User Pass"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_nicename"
            label="User Nicename"
            :value="old('user_nicename', ($editing ? $wpUser->user_nicename : ''))"
            maxlength="50"
            placeholder="User Nicename"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_email"
            label="User Email"
            :value="old('user_email', ($editing ? $wpUser->user_email : ''))"
            maxlength="100"
            placeholder="User Email"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_url"
            label="User Url"
            :value="old('user_url', ($editing ? $wpUser->user_url : ''))"
            maxlength="100"
            placeholder="User Url"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime
            name="user_registered"
            label="User Registered"
            value="{{ old('user_registered', ($editing ? optional($wpUser->user_registered)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="user_activation_key"
            label="User Activation Key"
            :value="old('user_activation_key', ($editing ? $wpUser->user_activation_key : ''))"
            maxlength="255"
            placeholder="User Activation Key"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="user_status"
            label="User Status"
            :value="old('user_status', ($editing ? $wpUser->user_status : '0'))"
            max="255"
            placeholder="User Status"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="display_name"
            label="Display Name"
            :value="old('display_name', ($editing ? $wpUser->display_name : ''))"
            maxlength="255"
            placeholder="Display Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="spam"
            label="Spam"
            :checked="old('spam', ($editing ? $wpUser->spam : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="deleted"
            label="Deleted"
            :checked="old('deleted', ($editing ? $wpUser->deleted : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
