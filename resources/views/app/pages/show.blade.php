<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.pages.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('pages.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.uid')
                        </h5>
                        <span>{{ $page->uid ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.main_category_id')
                        </h5>
                        <span
                            >{{ optional($page->mainCategory)->title ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.title')
                        </h5>
                        <span>{{ $page->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.slug')
                        </h5>
                        <span>{{ $page->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.short')
                        </h5>
                        <span>{{ $page->short ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.content')
                        </h5>
                        <span>{{ $page->content ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.data')
                        </h5>
                        <pre>{{ json_encode($page->data) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $page->image ? \Storage::url($page->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.thumbnail')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $page->thumbnail ? \Storage::url($page->thumbnail) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.author_id')
                        </h5>
                        <span>{{ optional($page->author)->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.created_by_user_id')
                        </h5>
                        <span>{{ $page->created_by_user_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.created_by_user_name')
                        </h5>
                        <span>{{ $page->created_by_user_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.edited_by_user_id')
                        </h5>
                        <span>{{ $page->edited_by_user_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.edited_by_user_name')
                        </h5>
                        <span>{{ $page->edited_by_user_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.language_id')
                        </h5>
                        <span
                            >{{ optional($page->language)->title ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.translation_id')
                        </h5>
                        <span
                            >{{ optional($page->translation)->title ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.pages.inputs.published_at')
                        </h5>
                        <span>{{ $page->published_at ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('pages.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Page::class)
                    <a href="{{ route('pages.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
