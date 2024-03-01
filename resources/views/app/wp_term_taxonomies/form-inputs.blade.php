@php $editing = isset($wpTermTaxonomy) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="term_id"
            label="Term Id"
            :value="old('term_id', ($editing ? $wpTermTaxonomy->term_id : '0'))"
            maxlength="255"
            placeholder="Term Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="taxonomy"
            label="Taxonomy"
            :value="old('taxonomy', ($editing ? $wpTermTaxonomy->taxonomy : ''))"
            maxlength="32"
            placeholder="Taxonomy"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $wpTermTaxonomy->description :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="parent"
            label="Parent"
            :value="old('parent', ($editing ? $wpTermTaxonomy->parent : '0'))"
            maxlength="255"
            placeholder="Parent"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="count"
            label="Count"
            :value="old('count', ($editing ? $wpTermTaxonomy->count : '0'))"
            maxlength="255"
            placeholder="Count"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
