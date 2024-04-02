<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.expiries.index_title')
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
                            @can('create', App\Models\Expiry::class)
                            <a
                                href="{{ route('expiries.create') }}"
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
                                    @lang('crud.expiries.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.slug')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.item')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.link')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.expired_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.notified_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.notified_to')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.escalated_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.escalated_to')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.handled_by')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.done_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.expiries.inputs.expiry_monitor_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($expiries as $expiry)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->slug ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->item ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->link ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->expired_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->notified_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->notified_to ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->escalated_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->escalated_to ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->handled_by ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $expiry->done_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($expiry->expiryMonitor)->title
                                    ?? '-' }}
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
                                        @can('update', $expiry)
                                        <a
                                            href="{{ route('expiries.edit', $expiry) }}"
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
                                        @endcan @can('view', $expiry)
                                        <a
                                            href="{{ route('expiries.show', $expiry) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $expiry)
                                        <form
                                            action="{{ route('expiries.destroy', $expiry) }}"
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
                                        {!! $expiries->render() !!}
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
