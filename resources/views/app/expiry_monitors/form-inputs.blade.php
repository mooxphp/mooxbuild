@php $editing = isset($expiryMonitor) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="title"
            label="Title"
            :value="old('title', ($editing ? $expiryMonitor->title : ''))"
            maxlength="255"
            placeholder="Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="slug"
            label="Slug"
            :value="old('slug', ($editing ? $expiryMonitor->slug : ''))"
            maxlength="255"
            placeholder="Slug"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $expiryMonitor->description :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="runs" label="Runs">
            @php $selected = old('runs', ($editing ? $expiryMonitor->runs : '')) @endphp
            <option value="weekly" {{ $selected == 'weekly' ? 'selected' : '' }} >Weekly</option>
            <option value="daily" {{ $selected == 'daily' ? 'selected' : '' }} >Daily</option>
            <option value="hourly" {{ $selected == 'hourly' ? 'selected' : '' }} >Hourly</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="monitors"
            label="Monitors"
            :value="old('monitors', ($editing ? $expiryMonitor->monitors : ''))"
            maxlength="255"
            placeholder="Monitors"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="executes"
            label="Executes"
            :value="old('executes', ($editing ? $expiryMonitor->executes : ''))"
            maxlength="255"
            placeholder="Executes"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="notifies"
            label="Notifies"
            :value="old('notifies', ($editing ? $expiryMonitor->notifies : ''))"
            maxlength="255"
            placeholder="Notifies"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="escalates"
            label="Escalates"
            :value="old('escalates', ($editing ? $expiryMonitor->escalates : ''))"
            maxlength="255"
            placeholder="Escalates"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
