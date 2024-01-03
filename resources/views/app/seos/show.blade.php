<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.seos.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('seos.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.seoable_id')
                        </h5>
                        <span>{{ $seo->seoable_id ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.seoable_type')
                        </h5>
                        <span>{{ $seo->seoable_type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.meta_title')
                        </h5>
                        <span>{{ $seo->meta_title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.meta_description')
                        </h5>
                        <span>{{ $seo->meta_description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.meta_keywords')
                        </h5>
                        <span>{{ $seo->meta_keywords ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.og_title')
                        </h5>
                        <span>{{ $seo->og_title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.og_description')
                        </h5>
                        <span>{{ $seo->og_description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.og_image')
                        </h5>
                        <span>{{ $seo->og_image ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.twitter_card')
                        </h5>
                        <span>{{ $seo->twitter_card ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.twitter_site')
                        </h5>
                        <span>{{ $seo->twitter_site ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.twitter_creator')
                        </h5>
                        <span>{{ $seo->twitter_creator ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.schema_markup')
                        </h5>
                        <pre>{{ json_encode($seo->schema_markup) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.breadcrumb_title')
                        </h5>
                        <span>{{ $seo->breadcrumb_title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.canonical_url')
                        </h5>
                        <span>{{ $seo->canonical_url ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.redirect_url')
                        </h5>
                        <span>{{ $seo->redirect_url ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.focus_keyphrases')
                        </h5>
                        <pre>
{{ json_encode($seo->focus_keyphrases) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.focus_keyphrase')
                        </h5>
                        <span>{{ $seo->focus_keyphrase ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.seo_scores')
                        </h5>
                        <pre>{{ json_encode($seo->seo_scores) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.seo_score')
                        </h5>
                        <span>{{ $seo->seo_score ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.readability_score')
                        </h5>
                        <span>{{ $seo->readability_score ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.fav_icon')
                        </h5>
                        <span>{{ $seo->fav_icon ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.app_icon')
                        </h5>
                        <span>{{ $seo->app_icon ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.app_color')
                        </h5>
                        <span>{{ $seo->app_color ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.web_manifest')
                        </h5>
                        <pre>{{ json_encode($seo->web_manifest) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.noindex')
                        </h5>
                        <span>{{ $seo->noindex ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.seos.inputs.nofollow')
                        </h5>
                        <span>{{ $seo->nofollow ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('seos.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Seo::class)
                    <a href="{{ route('seos.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
