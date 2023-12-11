<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.revisions.index_title')
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
                            @can('create', App\Models\Revision::class)
                            <a
                                href="{{ route('revisions.create') }}"
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
                                    @lang('crud.revisions.inputs.revname')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.revcomment')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.revretention')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.uid')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.main_category_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.slug')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.short')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.content')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.data')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.image')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.thumbnail')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.author_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.language_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.translation_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.categories')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.revisions.inputs.tags')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($revisions as $revision)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->revname ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->revcomment ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->revretention ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->uid ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->main_category_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->slug ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->short ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->content ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($revision->data) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $revision->image ? \Storage::url($revision->image) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $revision->thumbnail ? \Storage::url($revision->thumbnail) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->author_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->language_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $revision->translation_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($revision->categories) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($revision->tags) ?? '-' }}</pre
                                    >
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
                                        @can('update', $revision)
                                        <a
                                            href="{{ route('revisions.edit', $revision) }}"
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
                                        @endcan @can('view', $revision)
                                        <a
                                            href="{{ route('revisions.show', $revision) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $revision)
                                        <form
                                            action="{{ route('revisions.destroy', $revision) }}"
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
                                        {!! $revisions->render() !!}
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
