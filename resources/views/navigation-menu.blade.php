<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <x-nav-dropdown title="Apps" align="right" width="48">
                        @can('view-any', App\Models\ActivityLog::class)
                        <x-dropdown-link href="{{ route('activity-logs.index') }}">
                        Activity Logs
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Address::class)
                        <x-dropdown-link href="{{ route('addresses.index') }}">
                        Addresses
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Author::class)
                        <x-dropdown-link href="{{ route('authors.index') }}">
                        Authors
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Cart::class)
                        <x-dropdown-link href="{{ route('carts.index') }}">
                        Carts
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Category::class)
                        <x-dropdown-link href="{{ route('categories.index') }}">
                        Categories
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Comment::class)
                        <x-dropdown-link href="{{ route('comments.index') }}">
                        Comments
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Company::class)
                        <x-dropdown-link href="{{ route('companies.index') }}">
                        Companies
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Content::class)
                        <x-dropdown-link href="{{ route('contents.index') }}">
                        Contents
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\ContentElement::class)
                        <x-dropdown-link href="{{ route('content-elements.index') }}">
                        Content Elements
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Continent::class)
                        <x-dropdown-link href="{{ route('continents.index') }}">
                        Continents
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Country::class)
                        <x-dropdown-link href="{{ route('countries.index') }}">
                        Countries
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Currency::class)
                        <x-dropdown-link href="{{ route('currencies.index') }}">
                        Currencies
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Customer::class)
                        <x-dropdown-link href="{{ route('customers.index') }}">
                        Customers
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Department::class)
                        <x-dropdown-link href="{{ route('departments.index') }}">
                        Departments
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\FailedJob::class)
                        <x-dropdown-link href="{{ route('failed-jobs.index') }}">
                        Failed Jobs
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\FirewallRule::class)
                        <x-dropdown-link href="{{ route('firewall-rules.index') }}">
                        Firewall Rules
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Item::class)
                        <x-dropdown-link href="{{ route('items.index') }}">
                        Items
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Job::class)
                        <x-dropdown-link href="{{ route('jobs.index') }}">
                        Jobs
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\JobBatch::class)
                        <x-dropdown-link href="{{ route('job-batches.index') }}">
                        Job Batches
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\JobBatchManager::class)
                        <x-dropdown-link href="{{ route('job-batch-managers.index') }}">
                        Job Batch Managers
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Language::class)
                        <x-dropdown-link href="{{ route('languages.index') }}">
                        Languages
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Media::class)
                        <x-dropdown-link href="{{ route('media.index') }}">
                        Media
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Order::class)
                        <x-dropdown-link href="{{ route('orders.index') }}">
                        Orders
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Page::class)
                        <x-dropdown-link href="{{ route('pages.index') }}">
                        Pages
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\PageTemplate::class)
                        <x-dropdown-link href="{{ route('page-templates.index') }}">
                        Page Templates
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Platform::class)
                        <x-dropdown-link href="{{ route('platforms.index') }}">
                        Platforms
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Post::class)
                        <x-dropdown-link href="{{ route('posts.index') }}">
                        Posts
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\PostalCode::class)
                        <x-dropdown-link href="{{ route('postal-codes.index') }}">
                        Postal Codes
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Product::class)
                        <x-dropdown-link href="{{ route('products.index') }}">
                        Products
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Revision::class)
                        <x-dropdown-link href="{{ route('revisions.index') }}">
                        Revisions
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Route::class)
                        <x-dropdown-link href="{{ route('routes.index') }}">
                        Routes
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Seo::class)
                        <x-dropdown-link href="{{ route('seos.index') }}">
                        Seos
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Setting::class)
                        <x-dropdown-link href="{{ route('settings.index') }}">
                        Settings
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Sync::class)
                        <x-dropdown-link href="{{ route('syncs.index') }}">
                        Syncs
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Tag::class)
                        <x-dropdown-link href="{{ route('tags.index') }}">
                        Tags
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Team::class)
                        <x-dropdown-link href="{{ route('teams.index') }}">
                        Teams
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Theme::class)
                        <x-dropdown-link href="{{ route('themes.index') }}">
                        Themes
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Timezone::class)
                        <x-dropdown-link href="{{ route('timezones.index') }}">
                        Timezones
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\User::class)
                        <x-dropdown-link href="{{ route('users.index') }}">
                        Users
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Wishlist::class)
                        <x-dropdown-link href="{{ route('wishlists.index') }}">
                        Wishlists
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\JobManager::class)
                        <x-dropdown-link href="{{ route('job-managers.index') }}">
                        Job Managers
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\JobQueueWorker::class)
                        <x-dropdown-link href="{{ route('job-queue-workers.index') }}">
                        Job Queue Workers
                        </x-dropdown-link>
                        @endcan
                </x-nav-dropdown>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
                @can('view-any', App\Models\ActivityLog::class)
                <x-responsive-nav-link href="{{ route('activity-logs.index') }}">
                Activity Logs
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Address::class)
                <x-responsive-nav-link href="{{ route('addresses.index') }}">
                Addresses
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Author::class)
                <x-responsive-nav-link href="{{ route('authors.index') }}">
                Authors
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Cart::class)
                <x-responsive-nav-link href="{{ route('carts.index') }}">
                Carts
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Category::class)
                <x-responsive-nav-link href="{{ route('categories.index') }}">
                Categories
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Comment::class)
                <x-responsive-nav-link href="{{ route('comments.index') }}">
                Comments
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Company::class)
                <x-responsive-nav-link href="{{ route('companies.index') }}">
                Companies
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Content::class)
                <x-responsive-nav-link href="{{ route('contents.index') }}">
                Contents
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContentElement::class)
                <x-responsive-nav-link href="{{ route('content-elements.index') }}">
                Content Elements
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Continent::class)
                <x-responsive-nav-link href="{{ route('continents.index') }}">
                Continents
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Country::class)
                <x-responsive-nav-link href="{{ route('countries.index') }}">
                Countries
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Currency::class)
                <x-responsive-nav-link href="{{ route('currencies.index') }}">
                Currencies
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Customer::class)
                <x-responsive-nav-link href="{{ route('customers.index') }}">
                Customers
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Department::class)
                <x-responsive-nav-link href="{{ route('departments.index') }}">
                Departments
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\FailedJob::class)
                <x-responsive-nav-link href="{{ route('failed-jobs.index') }}">
                Failed Jobs
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\FirewallRule::class)
                <x-responsive-nav-link href="{{ route('firewall-rules.index') }}">
                Firewall Rules
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Item::class)
                <x-responsive-nav-link href="{{ route('items.index') }}">
                Items
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Job::class)
                <x-responsive-nav-link href="{{ route('jobs.index') }}">
                Jobs
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobBatch::class)
                <x-responsive-nav-link href="{{ route('job-batches.index') }}">
                Job Batches
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobBatchManager::class)
                <x-responsive-nav-link href="{{ route('job-batch-managers.index') }}">
                Job Batch Managers
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Language::class)
                <x-responsive-nav-link href="{{ route('languages.index') }}">
                Languages
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Media::class)
                <x-responsive-nav-link href="{{ route('media.index') }}">
                Media
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Order::class)
                <x-responsive-nav-link href="{{ route('orders.index') }}">
                Orders
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Page::class)
                <x-responsive-nav-link href="{{ route('pages.index') }}">
                Pages
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\PageTemplate::class)
                <x-responsive-nav-link href="{{ route('page-templates.index') }}">
                Page Templates
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Platform::class)
                <x-responsive-nav-link href="{{ route('platforms.index') }}">
                Platforms
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Post::class)
                <x-responsive-nav-link href="{{ route('posts.index') }}">
                Posts
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\PostalCode::class)
                <x-responsive-nav-link href="{{ route('postal-codes.index') }}">
                Postal Codes
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Product::class)
                <x-responsive-nav-link href="{{ route('products.index') }}">
                Products
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Revision::class)
                <x-responsive-nav-link href="{{ route('revisions.index') }}">
                Revisions
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Route::class)
                <x-responsive-nav-link href="{{ route('routes.index') }}">
                Routes
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Seo::class)
                <x-responsive-nav-link href="{{ route('seos.index') }}">
                Seos
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Setting::class)
                <x-responsive-nav-link href="{{ route('settings.index') }}">
                Settings
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Sync::class)
                <x-responsive-nav-link href="{{ route('syncs.index') }}">
                Syncs
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Tag::class)
                <x-responsive-nav-link href="{{ route('tags.index') }}">
                Tags
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Team::class)
                <x-responsive-nav-link href="{{ route('teams.index') }}">
                Teams
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Theme::class)
                <x-responsive-nav-link href="{{ route('themes.index') }}">
                Themes
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Timezone::class)
                <x-responsive-nav-link href="{{ route('timezones.index') }}">
                Timezones
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\User::class)
                <x-responsive-nav-link href="{{ route('users.index') }}">
                Users
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Wishlist::class)
                <x-responsive-nav-link href="{{ route('wishlists.index') }}">
                Wishlists
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobManager::class)
                <x-responsive-nav-link href="{{ route('job-managers.index') }}">
                Job Managers
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\JobQueueWorker::class)
                <x-responsive-nav-link href="{{ route('job-queue-workers.index') }}">
                Job Queue Workers
                </x-responsive-nav-link>
                @endcan

        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-switchable-team :team="$team" component="responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>