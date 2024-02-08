<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.job_queue_workers.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('job-queue-workers.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_queue_workers.inputs.worker_pid')
                        </h5>
                        <span>{{ $jobQueueWorker->worker_pid ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_queue_workers.inputs.queue')
                        </h5>
                        <span>{{ $jobQueueWorker->queue ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_queue_workers.inputs.worker_server')
                        </h5>
                        <span>{{ $jobQueueWorker->worker_server ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_queue_workers.inputs.supervisor')
                        </h5>
                        <span>{{ $jobQueueWorker->supervisor ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_queue_workers.inputs.status')
                        </h5>
                        <span>{{ $jobQueueWorker->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_queue_workers.inputs.started_at')
                        </h5>
                        <span>{{ $jobQueueWorker->started_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_queue_workers.inputs.stopped_at')
                        </h5>
                        <span>{{ $jobQueueWorker->stopped_at ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('job-queue-workers.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\JobQueueWorker::class)
                    <a
                        href="{{ route('job-queue-workers.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
