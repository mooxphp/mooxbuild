<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.media.index_title')
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
                            @can('create', App\Models\Media::class)
                            <a
                                href="{{ route('media.create') }}"
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
                                    @lang('crud.media.inputs.uuid')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.collection_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.file_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.mime_type')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.disk')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.conversions_disk')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.size')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.manipulations')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.custom_properties')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.generated_conversions')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.responsive_images')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.order_column')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.model_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.media.inputs.model_type')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($media as $media)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $media->uuid ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->collection_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    @if($media->file_name)
                                    <a
                                        href="{{ \Storage::url($media->file_name) }}"
                                        target="blank"
                                        ><i
                                            class="mr-1 icon ion-md-download"
                                        ></i
                                        >&nbsp;Download</a
                                    >
                                    @else - @endif
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->mime_type ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->disk ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->conversions_disk ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->size ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($media->manipulations) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($media->custom_properties) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($media->generated_conversions) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($media->responsive_images) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->order_column ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->model_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $media->model_type ?? '-' }}
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
                                        @can('update', $media)
                                        <a
                                            href="{{ route('media.edit', $media) }}"
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
                                        @endcan @can('view', $media)
                                        <a
                                            href="{{ route('media.show', $media) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $media)
                                        <form
                                            action="{{ route('media.destroy', $media) }}"
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
                                <td colspan="16">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="16">
                                    <div class="mt-10 px-4">
                                        {!! $media->render() !!}
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
