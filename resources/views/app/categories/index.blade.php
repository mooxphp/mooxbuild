<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.categories.index_title')
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
                            @can('create', App\Models\Category::class)
                            <a
                                href="{{ route('categories.create') }}"
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
                                    @lang('crud.categories.inputs.uid')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.slug')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.content')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.data')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.image')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.thumbnail')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.model')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.
                                    created_by_user_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.created_by_user_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.edited_by_user_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.edited_by_user_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.language_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.translation_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.categories.inputs.published_at')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $category->uid ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category->slug ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category->content ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($category->data) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $category->image ? \Storage::url($category->image) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $category->thumbnail ? \Storage::url($category->thumbnail) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category->model ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category-> created_by_user_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category->created_by_user_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category->edited_by_user_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category->edited_by_user_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($category->language)->title ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($category->translation)->title
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $category->published_at ?? '-' }}
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
                                        @can('update', $category)
                                        <a
                                            href="{{ route('categories.edit', $category) }}"
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
                                        @endcan @can('view', $category)
                                        <a
                                            href="{{ route('categories.show', $category) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $category)
                                        <form
                                            action="{{ route('categories.destroy', $category) }}"
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
                                <td colspan="16">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="16">
                                    <div class="mt-10 px-4">
                                        {!! $categories->render() !!}
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
