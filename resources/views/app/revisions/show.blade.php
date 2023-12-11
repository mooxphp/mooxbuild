<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.revisions.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('revisions.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.revname')
                        </h5>
                        <span>{{ $revision->revname ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.revcomment')
                        </h5>
                        <span>{{ $revision->revcomment ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.revretention')
                        </h5>
                        <span>{{ $revision->revretention ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.uid')
                        </h5>
                        <span>{{ $revision->uid ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.main_category_id')
                        </h5>
                        <span>{{ $revision->main_category_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.title')
                        </h5>
                        <span>{{ $revision->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.slug')
                        </h5>
                        <span>{{ $revision->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.short')
                        </h5>
                        <span>{{ $revision->short ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.content')
                        </h5>
                        <span>{{ $revision->content ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.data')
                        </h5>
                        <pre>{{ json_encode($revision->data) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $revision->image ? \Storage::url($revision->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.thumbnail')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $revision->thumbnail ? \Storage::url($revision->thumbnail) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.author_id')
                        </h5>
                        <span>{{ $revision->author_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.language_id')
                        </h5>
                        <span>{{ $revision->language_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.translation_id')
                        </h5>
                        <span>{{ $revision->translation_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.categories')
                        </h5>
                        <pre>
{{ json_encode($revision->categories) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.revisions.inputs.tags')
                        </h5>
                        <pre>{{ json_encode($revision->tags) ?? '-' }}</pre>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('revisions.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Revision::class)
                    <a href="{{ route('revisions.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
