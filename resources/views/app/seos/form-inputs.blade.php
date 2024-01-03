@php $editing = isset($seo) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="seoable_id"
            label="Seoable Id"
            :value="old('seoable_id', ($editing ? $seo->seoable_id : ''))"
            maxlength="255"
            placeholder="Seoable Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="seoable_type"
            label="Seoable Type"
            :value="old('seoable_type', ($editing ? $seo->seoable_type : ''))"
            maxlength="255"
            placeholder="Seoable Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="meta_title"
            label="Meta Title"
            :value="old('meta_title', ($editing ? $seo->meta_title : ''))"
            maxlength="255"
            placeholder="Meta Title"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="meta_description"
            label="Meta Description"
            :value="old('meta_description', ($editing ? $seo->meta_description : ''))"
            maxlength="255"
            placeholder="Meta Description"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="meta_keywords"
            label="Meta Keywords"
            :value="old('meta_keywords', ($editing ? $seo->meta_keywords : ''))"
            maxlength="255"
            placeholder="Meta Keywords"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="og_title"
            label="Og Title"
            :value="old('og_title', ($editing ? $seo->og_title : ''))"
            maxlength="255"
            placeholder="Og Title"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="og_description"
            label="Og Description"
            :value="old('og_description', ($editing ? $seo->og_description : ''))"
            maxlength="255"
            placeholder="Og Description"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="og_image"
            label="Og Image"
            :value="old('og_image', ($editing ? $seo->og_image : ''))"
            maxlength="255"
            placeholder="Og Image"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="twitter_card"
            label="Twitter Card"
            :value="old('twitter_card', ($editing ? $seo->twitter_card : ''))"
            maxlength="255"
            placeholder="Twitter Card"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="twitter_site"
            label="Twitter Site"
            :value="old('twitter_site', ($editing ? $seo->twitter_site : ''))"
            maxlength="255"
            placeholder="Twitter Site"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="twitter_creator"
            label="Twitter Creator"
            :value="old('twitter_creator', ($editing ? $seo->twitter_creator : ''))"
            maxlength="255"
            placeholder="Twitter Creator"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="schema_markup"
            label="Schema Markup"
            maxlength="255"
            >{{ old('schema_markup', ($editing ?
            json_encode($seo->schema_markup) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="breadcrumb_title"
            label="Breadcrumb Title"
            :value="old('breadcrumb_title', ($editing ? $seo->breadcrumb_title : ''))"
            maxlength="255"
            placeholder="Breadcrumb Title"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="canonical_url"
            label="Canonical Url"
            :value="old('canonical_url', ($editing ? $seo->canonical_url : ''))"
            maxlength="255"
            placeholder="Canonical Url"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="redirect_url"
            label="Redirect Url"
            :value="old('redirect_url', ($editing ? $seo->redirect_url : ''))"
            maxlength="255"
            placeholder="Redirect Url"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="focus_keyphrases"
            label="Focus Keyphrases"
            maxlength="255"
            >{{ old('focus_keyphrases', ($editing ?
            json_encode($seo->focus_keyphrases) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="focus_keyphrase"
            label="Focus Keyphrase"
            :value="old('focus_keyphrase', ($editing ? $seo->focus_keyphrase : ''))"
            maxlength="255"
            placeholder="Focus Keyphrase"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="seo_scores" label="Seo Scores" maxlength="255"
            >{{ old('seo_scores', ($editing ? json_encode($seo->seo_scores) :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="seo_score"
            label="Seo Score"
            :value="old('seo_score', ($editing ? $seo->seo_score : ''))"
            max="255"
            step="0.01"
            placeholder="Seo Score"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="readability_score"
            label="Readability Score"
            :value="old('readability_score', ($editing ? $seo->readability_score : ''))"
            max="255"
            step="0.01"
            placeholder="Readability Score"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="fav_icon"
            label="Fav Icon"
            :value="old('fav_icon', ($editing ? $seo->fav_icon : ''))"
            maxlength="255"
            placeholder="Fav Icon"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="app_icon"
            label="App Icon"
            :value="old('app_icon', ($editing ? $seo->app_icon : ''))"
            maxlength="255"
            placeholder="App Icon"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="app_color"
            label="App Color"
            :value="old('app_color', ($editing ? $seo->app_color : ''))"
            maxlength="255"
            placeholder="App Color"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="web_manifest"
            label="Web Manifest"
            maxlength="255"
            >{{ old('web_manifest', ($editing ? json_encode($seo->web_manifest)
            : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="noindex"
            label="Noindex"
            :checked="old('noindex', ($editing ? $seo->noindex : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="nofollow"
            label="Nofollow"
            :checked="old('nofollow', ($editing ? $seo->nofollow : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
