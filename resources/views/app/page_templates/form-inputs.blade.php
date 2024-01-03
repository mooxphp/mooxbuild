@php $editing = isset($pageTemplate) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="page_id" label="Page" required>
            @php $selected = old('page_id', ($editing ? $pageTemplate->page_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Page</option>
            @foreach($pages as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
