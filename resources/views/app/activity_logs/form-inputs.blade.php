@php $editing = isset($activityLog) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="log_name"
            label="Log Name"
            :value="old('log_name', ($editing ? $activityLog->log_name : ''))"
            maxlength="255"
            placeholder="Log Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $activityLog->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="subject_type"
            label="Subject Type"
            :value="old('subject_type', ($editing ? $activityLog->subject_type : ''))"
            maxlength="255"
            placeholder="Subject Type"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="event"
            label="Event"
            :value="old('event', ($editing ? $activityLog->event : ''))"
            maxlength="255"
            placeholder="Event"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="subject_id"
            label="Subject Id"
            :value="old('subject_id', ($editing ? $activityLog->subject_id : ''))"
            maxlength="255"
            placeholder="Subject Id"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="causer_type"
            label="Causer Type"
            :value="old('causer_type', ($editing ? $activityLog->causer_type : ''))"
            maxlength="255"
            placeholder="Causer Type"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="causer_id"
            label="Causer Id"
            :value="old('causer_id', ($editing ? $activityLog->causer_id : ''))"
            maxlength="255"
            placeholder="Causer Id"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="properties" label="Properties" maxlength="255"
            >{{ old('properties', ($editing ?
            json_encode($activityLog->properties) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="batch_uuid"
            label="Batch Uuid"
            :value="old('batch_uuid', ($editing ? $activityLog->batch_uuid : ''))"
            maxlength="255"
            placeholder="Batch Uuid"
        ></x-inputs.text>
    </x-inputs.group>
</div>
