<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.expiry_monitors.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('expiry-monitors.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.expiry_monitors.inputs.title')
                        </h5>
                        <span>{{ $expiryMonitor->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.expiry_monitors.inputs.slug')
                        </h5>
                        <span>{{ $expiryMonitor->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.expiry_monitors.inputs.description')
                        </h5>
                        <span>{{ $expiryMonitor->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.expiry_monitors.inputs.runs')
                        </h5>
                        <span>{{ $expiryMonitor->runs ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.expiry_monitors.inputs.monitors')
                        </h5>
                        <span>{{ $expiryMonitor->monitors ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.expiry_monitors.inputs.executes')
                        </h5>
                        <span>{{ $expiryMonitor->executes ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.expiry_monitors.inputs.notifies')
                        </h5>
                        <span>{{ $expiryMonitor->notifies ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.expiry_monitors.inputs.escalates')
                        </h5>
                        <span>{{ $expiryMonitor->escalates ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('expiry-monitors.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\ExpiryMonitor::class)
                    <a
                        href="{{ route('expiry-monitors.create') }}"
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
