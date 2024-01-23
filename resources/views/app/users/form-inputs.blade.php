@php $editing = isset($user) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $user->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="profile_photo_path"
            label="Profile Photo Path"
            :value="old('profile_photo_path', ($editing ? $user->profile_photo_path : ''))"
            maxlength="255"
            placeholder="Profile Photo Path"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="bypass_token"
            label="Bypass Token"
            :value="old('bypass_token', ($editing ? $user->bypass_token : ''))"
            maxlength="255"
            placeholder="Bypass Token"
        ></x-inputs.text>
    </x-inputs.group>
</div>
