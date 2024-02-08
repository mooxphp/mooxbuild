@php $editing = isset($job) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="queue"
            label="Queue"
            :value="old('queue', ($editing ? $job->queue : ''))"
            maxlength="255"
            placeholder="Queue"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="payload"
            label="Payload"
            maxlength="255"
            required
            >{{ old('payload', ($editing ? $job->payload : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="attempts"
            label="Attempts"
            :value="old('attempts', ($editing ? $job->attempts : ''))"
            maxlength="255"
            placeholder="Attempts"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="reserved_at"
            label="Reserved At"
            :value="old('reserved_at', ($editing ? $job->reserved_at : ''))"
            maxlength="255"
            placeholder="Reserved At"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="available_at"
            label="Available At"
            :value="old('available_at', ($editing ? $job->available_at : ''))"
            maxlength="255"
            placeholder="Available At"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="created_at"
            label="Created At"
            :value="old('created_at', ($editing ? $job->created_at : ''))"
            maxlength="255"
            placeholder="Created At"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
