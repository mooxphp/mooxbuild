@php $editing = isset($failedJob) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="uuid"
            label="Uuid"
            :value="old('uuid', ($editing ? $failedJob->uuid : ''))"
            maxlength="255"
            placeholder="Uuid"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="connection"
            label="Connection"
            maxlength="255"
            required
            >{{ old('connection', ($editing ? $failedJob->connection : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="queue" label="Queue" maxlength="255" required
            >{{ old('queue', ($editing ? $failedJob->queue : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="payload"
            label="Payload"
            maxlength="255"
            required
            >{{ old('payload', ($editing ? $failedJob->payload : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="exception"
            label="Exception"
            maxlength="255"
            required
            >{{ old('exception', ($editing ? $failedJob->exception : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="failed_at"
            label="Failed At"
            value="{{ old('failed_at', ($editing ? optional($failedJob->failed_at)->format('Y-m-d') : 'CURRENT_TIMESTAMP')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
