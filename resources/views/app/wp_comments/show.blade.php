<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.wp_comments.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('wp-comments.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_post_ID')
                        </h5>
                        <span>{{ $wpComment->comment_post_ID ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_author')
                        </h5>
                        <span>{{ $wpComment->comment_author ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_author_email')
                        </h5>
                        <span
                            >{{ $wpComment->comment_author_email ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_author_url')
                        </h5>
                        <span>{{ $wpComment->comment_author_url ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_author_IP')
                        </h5>
                        <span>{{ $wpComment->comment_author_IP ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_date')
                        </h5>
                        <span>{{ $wpComment->comment_date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_date_gmt')
                        </h5>
                        <span>{{ $wpComment->comment_date_gmt ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_content')
                        </h5>
                        <span>{{ $wpComment->comment_content ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_karma')
                        </h5>
                        <span>{{ $wpComment->comment_karma ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_approved')
                        </h5>
                        <span>{{ $wpComment->comment_approved ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_agent')
                        </h5>
                        <span>{{ $wpComment->comment_agent ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_type')
                        </h5>
                        <span>{{ $wpComment->comment_type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.comment_parent')
                        </h5>
                        <span>{{ $wpComment->comment_parent ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_comments.inputs.user_id')
                        </h5>
                        <span>{{ $wpComment->user_id ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('wp-comments.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\WpComment::class)
                    <a href="{{ route('wp-comments.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
