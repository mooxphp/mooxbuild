<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.wp_users.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('wp-users.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.user_login')
                        </h5>
                        <span>{{ $wpUser->user_login ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.user_pass')
                        </h5>
                        <span>{{ $wpUser->user_pass ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.user_nicename')
                        </h5>
                        <span>{{ $wpUser->user_nicename ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.user_email')
                        </h5>
                        <span>{{ $wpUser->user_email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.user_url')
                        </h5>
                        <span>{{ $wpUser->user_url ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.user_registered')
                        </h5>
                        <span>{{ $wpUser->user_registered ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.user_activation_key')
                        </h5>
                        <span>{{ $wpUser->user_activation_key ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.user_status')
                        </h5>
                        <span>{{ $wpUser->user_status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.display_name')
                        </h5>
                        <span>{{ $wpUser->display_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.spam')
                        </h5>
                        <span>{{ $wpUser->spam ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.wp_users.inputs.deleted')
                        </h5>
                        <span>{{ $wpUser->deleted ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('wp-users.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\WpUser::class)
                    <a href="{{ route('wp-users.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
