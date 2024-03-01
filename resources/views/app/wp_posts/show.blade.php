<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.wp_posts.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('wp-posts.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_author')
                        </h5>
                        <span>{{ $wpPost->post_author ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_date')
                        </h5>
                        <span>{{ $wpPost->post_date ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_date_gmt')
                        </h5>
                        <span>{{ $wpPost->post_date_gmt ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_content')
                        </h5>
                        <span>{{ $wpPost->post_content ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_title')
                        </h5>
                        <span>{{ $wpPost->post_title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_excerpt')
                        </h5>
                        <span>{{ $wpPost->post_excerpt ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_status')
                        </h5>
                        <span>{{ $wpPost->post_status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.comment_status')
                        </h5>
                        <span>{{ $wpPost->comment_status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.ping_status')
                        </h5>
                        <span>{{ $wpPost->ping_status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_password')
                        </h5>
                        <span>{{ $wpPost->post_password ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_name')
                        </h5>
                        <span>{{ $wpPost->post_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.to_ping')
                        </h5>
                        <span>{{ $wpPost->to_ping ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.pinged')
                        </h5>
                        <span>{{ $wpPost->pinged ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_modified')
                        </h5>
                        <span>{{ $wpPost->post_modified ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_modified_gmt')
                        </h5>
                        <span>{{ $wpPost->post_modified_gmt ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_content_filtered')
                        </h5>
                        <span>{{ $wpPost->post_content_filtered ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_parent')
                        </h5>
                        <span>{{ $wpPost->post_parent ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.guid')
                        </h5>
                        <span>{{ $wpPost->guid ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.menu_order')
                        </h5>
                        <span>{{ $wpPost->menu_order ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_type')
                        </h5>
                        <span>{{ $wpPost->post_type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.post_mime_type')
                        </h5>
                        <span>{{ $wpPost->post_mime_type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_posts.inputs.comment_count')
                        </h5>
                        <span>{{ $wpPost->comment_count ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('wp-posts.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\WpPost::class)
                    <a href="{{ route('wp-posts.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
