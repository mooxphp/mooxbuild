<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.platforms.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('platforms.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.platforms.inputs.title')
                        </h5>
                        <span>{{ $platform->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.platforms.inputs.slug')
                        </h5>
                        <span>{{ $platform->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.platforms.inputs.domain')
                        </h5>
                        <span>{{ $platform->domain ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.platforms.inputs.selectable')
                        </h5>
                        <span>{{ $platform->selectable ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.platforms.inputs.master')
                        </h5>
                        <span>{{ $platform->master ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.platforms.inputs.thumbnail')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $platform->thumbnail ? \Storage::url($platform->thumbnail) : '' }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('platforms.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Platform::class)
                    <a href="{{ route('platforms.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
