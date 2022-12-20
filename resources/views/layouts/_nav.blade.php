@php
    use App\Helpers\TemplateHelper;
    use App\Helpers\LocalizationHelper;
    $currentLocale = LaravelLocalization::getCurrentLocale();
    $locales = LaravelLocalization::getSupportedLocales();
    $user = Auth::user();
@endphp
<nav class="py-2 bg-light border-bottom">
    <div class="container d-flex flex-wrap">
        <!-- Left Side Of Navbar -->
        <a href="{{ LaravelLocalization::getLocalizedURL($currentLocale, route('home')) }}"
           class="navbar-brand mb-0 link-secondary"
        >
            {{ __('layout.nav.name') }}
        </a>
        <ul class="nav me-auto">
            <li class="nav-item">
                <a class="nav-link px-2 link-secondary" href="{{ route('chapters.index') }}">
                    {{ __('layout.nav.chapters') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 link-secondary" href="{{ route('exercises.index') }}">
                    {{ __('layout.nav.exercises') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 link-secondary" target="_blank" href="https://guides.hexlet.io/how-to-learn-sicp/">
                    {{ __('layout.nav.sicp_read') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 link-secondary" href="{{ route('top.index') }}">
                    {{ __('layout.nav.rating') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-2 link-primary" target="_blank" href="{{ TemplateHelper::getBookLink($currentLocale) }}">
                    {{ __('layout.nav.sicp_book') }}
                </a>
            </li>
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="nav">
            @guest
                @if(app()->environment('local'))
                    <li>
                        <a href="{{ route('auth.dev-login') }}" class="nav-link px-2" data-method="post" data-confirm="Are you sure you want to submit?"> Dev-login</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link px-2 link-secondary">
                        {{ __('layout.nav.login') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link px-2 link-secondary">
                        {{ __('layout.nav.register') }}
                    </a>
                </li>
            @else
                <li class="nav-item dropdown d-none d-md-block">
                    <a
                        class="nav-link dropdown-toggle py-1 px-2 link-secondary"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        href="#"
                    >
                        <i class="bi bi-person align-middle fs-4"></i>
                    </a>
                    <ul
                        class="dropdown-menu x-z-index-dropdown dropdown-menu-right"
                        aria-labelledby="dropdownMenuButton"
                    >
                        <li>
                            <a href="{{ route('users.show', $user) }}" class="dropdown-item link-secondary">{{ $user->name }}</a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('settings.account.index') }}">{{ __('account.settings') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('my') }}">
                                {{ __('layout.nav.my_progress') }}
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" data-method="post" rel="nofollow">
                                {{ __('layout.nav.logout') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endguest
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle px-2 link-secondary"
                        id="dropdownFlagButton"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        href="#"
                    >
                        <img
                            src="{{ LocalizationHelper::getPathToLocaleFlag($currentLocale) }}"
                            alt="{{ LocalizationHelper::getNativeLanguageName($currentLocale) }}"
                            class="me-1" width="24"
                        >
                        <span class="d-md-none">{{ LocalizationHelper::getNativeLanguageName($currentLocale) }}</span>
                    </a>
                    <ul
                        class="dropdown-menu dropdown-menu-right x-min-w-0"
                        aria-labelledby="dropdownFlagButton"
                    >
                    @foreach(LocalizationHelper::getOtherLocales($currentLocale, $locales) as $localeCode => ['native' => $language])
                        <li>
                            <a
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                rel="alternate" class="dropdown-item"
                                hreflang="{{ $localeCode }}"
                            >
                                <img
                                    src="{{ LocalizationHelper::getPathToLocaleFlag($localeCode) }}"
                                    alt="{{ LocalizationHelper::normalizeNativeLanguageName($language) }}"
                                    class="mr-1" width="24"
                                >
                                <span class="d-md-none">{{ LocalizationHelper::normalizeNativeLanguageName($language) }}</span>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </li>
        </ul>
    </div>
</nav>
