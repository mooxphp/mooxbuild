@php $editing = isset($jobQueueWorker) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="worker_pid"
            label="Worker Pid"
            :value="old('worker_pid', ($editing ? $jobQueueWorker->worker_pid : ''))"
            maxlength="255"
            placeholder="Worker Pid"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="queue"
            label="Queue"
            :value="old('queue', ($editing ? $jobQueueWorker->queue : ''))"
            maxlength="255"
            placeholder="Queue"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="connection"
            label="Connection"
            :value="old('connection', ($editing ? $jobQueueWorker->connection : ''))"
            maxlength="255"
            placeholder="Connection"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="worker_server"
            label="Worker Server"
            :value="old('worker_server', ($editing ? $jobQueueWorker->worker_server : ''))"
            maxlength="255"
            placeholder="Worker Server"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="supervisor"
            label="Supervisor"
            :value="old('supervisor', ($editing ? $jobQueueWorker->supervisor : ''))"
            maxlength="255"
            placeholder="Supervisor"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $jobQueueWorker->status : ''))"
            maxlength="255"
            placeholder="Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="started_at"
            label="Started At"
            value="{{ old('started_at', ($editing ? optional($jobQueueWorker->started_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="stopped_at"
            label="Stopped At"
            value="{{ old('stopped_at', ($editing ? optional($jobQueueWorker->stopped_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>
</div>
