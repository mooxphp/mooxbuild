<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.job_managers.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\JobManager::class)
                            <a
                                href="{{ route('job-managers.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.job_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.queue')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.available_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.started_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.finished_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.failed')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.job_managers.inputs.attempt')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.job_managers.inputs.progress')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.exception_message')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.job_managers.inputs.job_queue_worker_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($jobManagers as $jobManager)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->job_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->queue ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->available_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->started_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->finished_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->failed ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $jobManager->attempt ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $jobManager->progress ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->exception_message ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jobManager->status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{
                                    optional($jobManager->jobQueueWorker)->worker_pid
                                    ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $jobManager)
                                        <a
                                            href="{{ route('job-managers.edit', $jobManager) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $jobManager)
                                        <a
                                            href="{{ route('job-managers.show', $jobManager) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $jobManager)
                                        <form
                                            action="{{ route('job-managers.destroy', $jobManager) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="13">
                                    <div class="mt-10 px-4">
                                        {!! $jobManagers->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
