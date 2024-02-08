@php $editing = isset($jobBatch) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $jobBatch->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="total_jobs"
            label="Total Jobs"
            :value="old('total_jobs', ($editing ? $jobBatch->total_jobs : ''))"
            max="255"
            placeholder="Total Jobs"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="pending_jobs"
            label="Pending Jobs"
            :value="old('pending_jobs', ($editing ? $jobBatch->pending_jobs : ''))"
            max="255"
            placeholder="Pending Jobs"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="failed_jobs"
            label="Failed Jobs"
            :value="old('failed_jobs', ($editing ? $jobBatch->failed_jobs : ''))"
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
            >{{ old('failed_job_ids', ($editing ? $jobBatch->failed_job_ids :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="options" label="Options" maxlength="255"
            >{{ old('options', ($editing ? $jobBatch->options : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="cancelled_at"
            label="Cancelled At"
            :value="old('cancelled_at', ($editing ? $jobBatch->cancelled_at : ''))"
            max="255"
            placeholder="Cancelled At"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="created_at"
            label="Created At"
            :value="old('created_at', ($editing ? $jobBatch->created_at : ''))"
            max="255"
            placeholder="Created At"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="finished_at"
            label="Finished At"
            :value="old('finished_at', ($editing ? $jobBatch->finished_at : ''))"
            max="255"
            placeholder="Finished At"
        ></x-inputs.number>
    </x-inputs.group>
</div>
