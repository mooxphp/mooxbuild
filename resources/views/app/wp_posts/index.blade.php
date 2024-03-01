<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.wp_posts.index_title')
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
                            @can('create', App\Models\WpPost::class)
                            <a
                                href="{{ route('wp-posts.create') }}"
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
                                    @lang('crud.wp_posts.inputs.post_author')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_date_gmt')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_content')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_excerpt')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.comment_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.ping_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_password')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.to_ping')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.pinged')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_modified')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_modified_gmt')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_content_filtered')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_parent')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.guid')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.wp_posts.inputs.menu_order')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_type')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.post_mime_type')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_posts.inputs.comment_count')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($wpPosts as $wpPost)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_author ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_date_gmt ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_content ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_excerpt ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->comment_status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->ping_status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_password ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->to_ping ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->pinged ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_modified ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_modified_gmt ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_content_filtered ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_parent ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->guid ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $wpPost->menu_order ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_type ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->post_mime_type ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpPost->comment_count ?? '-' }}
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
                                        @can('update', $wpPost)
                                        <a
                                            href="{{ route('wp-posts.edit', $wpPost) }}"
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
                                        @endcan @can('view', $wpPost)
                                        <a
                                            href="{{ route('wp-posts.show', $wpPost) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $wpPost)
                                        <form
                                            action="{{ route('wp-posts.destroy', $wpPost) }}"
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
                                <td colspan="23">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="23">
                                    <div class="mt-10 px-4">
                                        {!! $wpPosts->render() !!}
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
