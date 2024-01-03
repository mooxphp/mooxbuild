<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.seos.index_title')
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
                            @can('create', App\Models\Seo::class)
                            <a
                                href="{{ route('seos.create') }}"
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
                                    @lang('crud.seos.inputs.seoable_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.seoable_type')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.meta_title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.meta_description')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.meta_keywords')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.og_title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.og_description')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.og_image')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.twitter_card')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.twitter_site')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.twitter_creator')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.schema_markup')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.breadcrumb_title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.canonical_url')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.redirect_url')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.focus_keyphrases')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.focus_keyphrase')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.seo_scores')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.seos.inputs.seo_score')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.seos.inputs.readability_score')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.fav_icon')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.app_icon')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.app_color')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.web_manifest')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.noindex')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.seos.inputs.nofollow')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($seos as $seo)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->seoable_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->seoable_type ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->meta_title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->meta_description ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->meta_keywords ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->og_title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->og_description ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->og_image ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->twitter_card ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->twitter_site ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->twitter_creator ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($seo->schema_markup) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->breadcrumb_title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->canonical_url ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->redirect_url ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($seo->focus_keyphrases) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->focus_keyphrase ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($seo->seo_scores) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $seo->seo_score ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $seo->readability_score ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->fav_icon ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->app_icon ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->app_color ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($seo->web_manifest) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->noindex ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $seo->nofollow ?? '-' }}
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
                                        @can('update', $seo)
                                        <a
                                            href="{{ route('seos.edit', $seo) }}"
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
                                        @endcan @can('view', $seo)
                                        <a
                                            href="{{ route('seos.show', $seo) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $seo)
                                        <form
                                            action="{{ route('seos.destroy', $seo) }}"
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
                                <td colspan="27">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="27">
                                    <div class="mt-10 px-4">
                                        {!! $seos->render() !!}
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
