<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.wp_comments.index_title')
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
                            @can('create', App\Models\WpComment::class)
                            <a
                                href="{{ route('wp-comments.create') }}"
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
                                    @lang('crud.wp_comments.inputs.comment_post_ID')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_author')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_author_email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_author_url')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_author_IP')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_date_gmt')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_content')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.wp_comments.inputs.comment_karma')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_approved')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_agent')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_type')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.comment_parent')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_comments.inputs.user_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($wpComments as $wpComment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_post_ID ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_author ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_author_email ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_author_url ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_author_IP ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_date_gmt ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_content ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $wpComment->comment_karma ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_approved ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_agent ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_type ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->comment_parent ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpComment->user_id ?? '-' }}
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
                                        @can('update', $wpComment)
                                        <a
                                            href="{{ route('wp-comments.edit', $wpComment) }}"
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
                                        @endcan @can('view', $wpComment)
                                        <a
                                            href="{{ route('wp-comments.show', $wpComment) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $wpComment)
                                        <form
                                            action="{{ route('wp-comments.destroy', $wpComment) }}"
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
                                <td colspan="15">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="15">
                                    <div class="mt-10 px-4">
                                        {!! $wpComments->render() !!}
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
