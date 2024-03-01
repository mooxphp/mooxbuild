@php $editing = isset($wpTermRelationship) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="term_taxonomy_id"
            label="Term Taxonomy Id"
            :value="old('term_taxonomy_id', ($editing ? $wpTermRelationship->term_taxonomy_id : ''))"
            maxlength="255"
            placeholder="Term Taxonomy Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="term_order"
            label="Term Order"
            :value="old('term_order', ($editing ? $wpTermRelationship->term_order : ''))"
            max="255"
            placeholder="Term Order"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
