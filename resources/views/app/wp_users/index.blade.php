<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.wp_users.index_title')
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
                            @can('create', App\Models\WpUser::class)
                            <a
                                href="{{ route('wp-users.create') }}"
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
                                    @lang('crud.wp_users.inputs.user_login')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.user_pass')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.user_nicename')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.user_email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.user_url')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.user_registered')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.user_activation_key')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.wp_users.inputs.user_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.display_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.spam')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.wp_users.inputs.deleted')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($wpUsers as $wpUser)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->user_login ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->user_pass ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->user_nicename ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->user_email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->user_url ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->user_registered ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->user_activation_key ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $wpUser->user_status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->display_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->spam ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $wpUser->deleted ?? '-' }}
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
                                        @can('update', $wpUser)
                                        <a
                                            href="{{ route('wp-users.edit', $wpUser) }}"
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
                                        @endcan @can('view', $wpUser)
                                        <a
                                            href="{{ route('wp-users.show', $wpUser) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $wpUser)
                                        <form
                                            action="{{ route('wp-users.destroy', $wpUser) }}"
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
                                <td colspan="12">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="12">
                                    <div class="mt-10 px-4">
                                        {!! $wpUsers->render() !!}
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
