<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.tags.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('tags.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.uid')
                        </h5>
                        <span>{{ $tag->uid ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.title')
                        </h5>
                        <span>{{ $tag->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.slug')
                        </h5>
                        <span>{{ $tag->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.content')
                        </h5>
                        <span>{{ $tag->content ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.data')
                        </h5>
                        <pre>{{ json_encode($tag->data) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $tag->image ? \Storage::url($tag->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.thumbnail')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $tag->thumbnail ? \Storage::url($tag->thumbnail) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.weight')
                        </h5>
                        <span>{{ $tag->weight ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.model')
                        </h5>
                        <span>{{ $tag->model ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.created_by_user_id')
                        </h5>
                        <span>{{ $tag->created_by_user_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.created_by_user_name')
                        </h5>
                        <span>{{ $tag->created_by_user_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.edited_by_user_id')
                        </h5>
                        <span>{{ $tag->edited_by_user_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.edited_by_user_name')
                        </h5>
                        <span>{{ $tag->edited_by_user_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.translation_id')
                        </h5>
                        <span
                            >{{ optional($tag->translation)->title ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.tags.inputs.published_at')
                        </h5>
                        <span>{{ $tag->published_at ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('tags.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Tag::class)
                    <a href="{{ route('tags.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
