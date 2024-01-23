<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.countries.index_title')
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
                            @can('create', App\Models\Country::class)
                            <a
                                href="{{ route('countries.create') }}"
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
                                    @lang('crud.countries.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.slug')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.continent_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.delivery')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.official')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.native_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.tld')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.independent')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.un_member')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.cca2')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.ccn3')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.cca3')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.countries.inputs.cioc')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($countries as $country)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $country->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->slug ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($country->continent)->title ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->delivery ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->official ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($country->native_name) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->tld ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->independent ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->un_member ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->cca2 ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->ccn3 ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->cca3 ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $country->cioc ?? '-' }}
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
                                        @can('update', $country)
                                        <a
                                            href="{{ route('countries.edit', $country) }}"
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
                                        @endcan @can('view', $country)
                                        <a
                                            href="{{ route('countries.show', $country) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $country)
                                        <form
                                            action="{{ route('countries.destroy', $country) }}"
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
                                        {!! $countries->render() !!}
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
