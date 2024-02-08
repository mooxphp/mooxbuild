@php $editing = isset($jobBatchManager) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="batch_id"
            label="Batch Id"
            :value="old('batch_id', ($editing ? $jobBatchManager->batch_id : ''))"
            maxlength="255"
            placeholder="Batch Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $jobBatchManager->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="total_jobs"
            label="Total Jobs"
            :value="old('total_jobs', ($editing ? $jobBatchManager->total_jobs : ''))"
            max="255"
            placeholder="Total Jobs"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="pending_jobs"
            label="Pending Jobs"
            :value="old('pending_jobs', ($editing ? $jobBatchManager->pending_jobs : ''))"
            max="255"
            placeholder="Pending Jobs"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="failed_jobs"
            label="Failed Jobs"
            :value="old('failed_jobs', ($editing ? $jobBatchManager->failed_jobs : ''))"
            max="255"
            placeholder="Failed Jobs"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="failed_job_ids"
            label="Failed Job Ids"
            maxlength="255"
            required
            >{{ old('failed_job_ids', ($editing ?
            $jobBatchManager->failed_job_ids : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="options" label="Options" maxlength="255"
            >{{ old('options', ($editing ? $jobBatchManager->options : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="cancelled_at"
            label="Cancelled At"
            value="{{ old('cancelled_at', ($editing ? optional($jobBatchManager->cancelled_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="finished_at"
            label="Finished At"
            value="{{ old('finished_at', ($editing ? optional($jobBatchManager->finished_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $jobBatchManager->status : ''))"
            maxlength="255"
            placeholder="Status"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
