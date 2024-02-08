@php $editing = isset($jobManager) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="job_id"
            label="Job Id"
            :value="old('job_id', ($editing ? $jobManager->job_id : ''))"
            maxlength="255"
            placeholder="Job Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $jobManager->name : ''))"
            maxlength="255"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="queue"
            label="Queue"
            :value="old('queue', ($editing ? $jobManager->queue : ''))"
            maxlength="255"
            placeholder="Queue"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="available_at"
            label="Available At"
            value="{{ old('available_at', ($editing ? optional($jobManager->available_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="started_at"
            label="Started At"
            value="{{ old('started_at', ($editing ? optional($jobManager->started_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="finished_at"
            label="Finished At"
            value="{{ old('finished_at', ($editing ? optional($jobManager->finished_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="failed"
            label="Failed"
            :checked="old('failed', ($editing ? $jobManager->failed : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="attempt"
            label="Attempt"
            :value="old('attempt', ($editing ? $jobManager->attempt : ''))"
            max="255"
            placeholder="Attempt"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="progress"
            label="Progress"
            :value="old('progress', ($editing ? $jobManager->progress : ''))"
            max="255"
            placeholder="Progress"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="exception_message"
            label="Exception Message"
            maxlength="255"
            >{{ old('exception_message', ($editing ?
            $jobManager->exception_message : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $jobManager->status : ''))"
            maxlength="255"
            placeholder="Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select
            name="job_queue_worker_id"
            label="Job Queue Worker"
            required
        >
            @php $selected = old('job_queue_worker_id', ($editing ? $jobManager->job_queue_worker_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Job Queue Worker</option>
            @foreach($jobQueueWorkers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
