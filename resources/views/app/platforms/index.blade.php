<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.platforms.index_title')
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
                            @can('create', App\Models\Platform::class)
                            <a
                                href="{{ route('platforms.create') }}"
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
                                    @lang('crud.platforms.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.slug')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.domain')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.selection')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.order')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.locked')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.master')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.thumbnail')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.platformable_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.platforms.inputs.platformable_type')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($platforms as $platform)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->slug ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->domain ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->selection ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->order ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->locked ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->master ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <x-partials.thumbnail
                                        src="{{ $platform->thumbnail ? \Storage::url($platform->thumbnail) : '' }}"
                                    />
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->platformable_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $platform->platformable_type ?? '-' }}
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
                                        @can('update', $platform)
                                        <a
                                            href="{{ route('platforms.edit', $platform) }}"
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
                                        @endcan @can('view', $platform)
                                        <a
                                            href="{{ route('platforms.show', $platform) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $platform)
                                        <form
                                            action="{{ route('platforms.destroy', $platform) }}"
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
                                <td colspan="11">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="11">
                                    <div class="mt-10 px-4">
                                        {!! $platforms->render() !!}
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
