<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.job_managers.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('job-managers.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.job_id')
                        </h5>
                        <span>{{ $jobManager->job_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.name')
                        </h5>
                        <span>{{ $jobManager->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.queue')
                        </h5>
                        <span>{{ $jobManager->queue ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.available_at')
                        </h5>
                        <span>{{ $jobManager->available_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.started_at')
                        </h5>
                        <span>{{ $jobManager->started_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.finished_at')
                        </h5>
                        <span>{{ $jobManager->finished_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.failed')
                        </h5>
                        <span>{{ $jobManager->failed ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.attempt')
                        </h5>
                        <span>{{ $jobManager->attempt ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.progress')
                        </h5>
                        <span>{{ $jobManager->progress ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.exception_message')
                        </h5>
                        <span>{{ $jobManager->exception_message ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.status')
                        </h5>
                        <span>{{ $jobManager->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.job_managers.inputs.job_queue_worker_id')
                        </h5>
                        <span
                            >{{
                            optional($jobManager->jobQueueWorker)->worker_pid ??
                            '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('job-managers.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\JobManager::class)
                    <a href="{{ route('job-managers.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
