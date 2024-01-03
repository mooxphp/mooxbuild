<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.items.index_title')
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
                            @can('create', App\Models\Item::class)
                            <a
                                href="{{ route('items.create') }}"
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
                                    @lang('crud.items.inputs.uid')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.main_category_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.slug')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.short')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.content')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.data')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.image')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.thumbnail')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.author_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.created_by_user_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.created_by_user_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.edited_by_user_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.edited_by_user_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.language_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.translation_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.items.inputs.published_at')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $item->uid ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($item->mainCategory)->title ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->slug ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->short ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->content ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($item->data) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $item->image ? \Storage::url($item->image) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $item->thumbnail ? \Storage::url($item->thumbnail) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($item->author)->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->created_by_user_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->created_by_user_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->edited_by_user_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->edited_by_user_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($item->language)->title ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($item->translation)->title ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $item->published_at ?? '-' }}
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
                                        @can('update', $item)
                                        <a
                                            href="{{ route('items.edit', $item) }}"
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
                                        @endcan @can('view', $item)
                                        <a
                                            href="{{ route('items.show', $item) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $item)
                                        <form
                                            action="{{ route('items.destroy', $item) }}"
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
                                <td colspan="18">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="18">
                                    <div class="mt-10 px-4">
                                        {!! $items->render() !!}
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
