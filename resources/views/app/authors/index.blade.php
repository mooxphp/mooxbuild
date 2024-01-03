<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.authors.index_title')
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
                            @can('create', App\Models\Author::class)
                            <a
                                href="{{ route('authors.create') }}"
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
                                    @lang('crud.authors.inputs.user_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.salutation')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.full_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.first_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.last_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.mail_address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.website')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.social')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.authors.inputs.published_at')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($authors as $author)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ optional($author->user)->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->salutation ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->full_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->first_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->last_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->mail_address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->website ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($author->social) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $author->published_at ?? '-' }}
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
                                        @can('update', $author)
                                        <a
                                            href="{{ route('authors.edit', $author) }}"
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
                                        @endcan @can('view', $author)
                                        <a
                                            href="{{ route('authors.show', $author) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $author)
                                        <form
                                            action="{{ route('authors.destroy', $author) }}"
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
                                <td colspan="13">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="13">
                                    <div class="mt-10 px-4">
                                        {!! $authors->render() !!}
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
