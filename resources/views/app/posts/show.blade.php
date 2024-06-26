<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.posts.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('posts.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.uid')
                        </h5>
                        <span>{{ $post->uid ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.main_category_id')
                        </h5>
                        <span
                            >{{ optional($post->mainCategory)->title ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.title')
                        </h5>
                        <span>{{ $post->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.slug')
                        </h5>
                        <span>{{ $post->slug ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.short')
                        </h5>
                        <span>{{ $post->short ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.content')
                        </h5>
                        <span>{{ $post->content ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.data')
                        </h5>
                        <pre>{{ json_encode($post->data) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $post->image ? \Storage::url($post->image) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.thumbnail')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $post->thumbnail ? \Storage::url($post->thumbnail) : '' }}"
                            size="150"
                        />
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.author_id')
                        </h5>
                        <span>{{ optional($post->author)->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.created_by_user_id')
                        </h5>
                        <span>{{ $post->created_by_user_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.created_by_user_name')
                        </h5>
                        <span>{{ $post->created_by_user_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.edited_by_user_id')
                        </h5>
                        <span>{{ $post->edited_by_user_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.edited_by_user_name')
                        </h5>
                        <span>{{ $post->edited_by_user_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.translation_id')
                        </h5>
                        <span
                            >{{ optional($post->translation)->title ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.posts.inputs.published_at')
                        </h5>
                        <span>{{ $post->published_at ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('posts.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Post::class)
                    <a href="{{ route('posts.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
