<ul class="menu-inner py-1">
  <li class="menu-item {{ request()->routeIs('admins.index') || request()->routeIs('clients.index') ? 'active' : '' }}">
    <a href="{{ auth('sanctum')->user()?->type === \App\Enums\UserType::ADMIN->value ? route('admins.index') : route('clients.index') }}" class="menu-link">
      <i class="menu-icon tf-icons ti ti-smart-home"></i>
      <div>{{ __('dashboard.analytics') }}</div>
    </a>
  </li>

  @if (auth('sanctum')->user()?->type === \App\Enums\UserType::CLIENT->value)
    <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('dashboard.apps_pages') }}</span></li>
    <li class="menu-item {{ request()->routeIs('clients.profile.*') ? 'active' : '' }}">
      <a href="{{ route('clients.profile.show') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-user"></i><div>{{ __('dashboard.profile') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.educationals.*') ? 'active' : '' }}">
      <a href="{{ route('clients.educationals.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-school"></i><div>{{ __('dashboard.educationals') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.experiences.*') ? 'active' : '' }}">
      <a href="{{ route('clients.experiences.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-briefcase"></i><div>{{ __('dashboard.experiences') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.languages.*') ? 'active' : '' }}">
      <a href="{{ route('clients.languages.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-language"></i><div>{{ __('dashboard.languages') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.skills.*') ? 'active' : '' }}">
      <a href="{{ route('clients.skills.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-stars"></i><div>{{ __('dashboard.skills') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.project-groups.*') || request()->routeIs('clients.projects.*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle"><i class="menu-icon tf-icons ti ti-folders"></i><div>{{ __('dashboard.project_works') }}</div></a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('clients.project-groups.*') ? 'active' : '' }}"><a href="{{ route('clients.project-groups.index') }}" class="menu-link"><div>{{ __('dashboard.project_groups') }}</div></a></li>
        <li class="menu-item {{ request()->routeIs('clients.projects.*') ? 'active' : '' }}"><a href="{{ route('clients.projects.index') }}" class="menu-link"><div>{{ __('dashboard.projects') }}</div></a></li>
      </ul>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.certifications.*') ? 'active' : '' }}">
      <a href="{{ route('clients.certifications.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-certificate"></i><div>{{ __('dashboard.certifications') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.courses.*') ? 'active' : '' }}">
      <a href="{{ route('clients.courses.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-book"></i><div>{{ __('dashboard.courses') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.awards.*') ? 'active' : '' }}">
      <a href="{{ route('clients.awards.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-trophy"></i><div>{{ __('dashboard.awards') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.volunteerings.*') ? 'active' : '' }}">
      <a href="{{ route('clients.volunteerings.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-heart-handshake"></i><div>{{ __('dashboard.volunteerings') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.references.*') ? 'active' : '' }}">
      <a href="{{ route('clients.references.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-user-star"></i><div>{{ __('dashboard.references') }}</div></a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.websites.*') ? 'active' : '' }}">
      <a href="{{ route('clients.websites.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-world"></i><div>{{ __('dashboard.websites') }}</div></a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('dashboard.social_links') }}</span></li>
    <li class="menu-item {{ request()->routeIs('clients.links.*') ? 'active' : '' }}">
      <a href="{{ route('clients.links.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-link"></i><div>{{ __('dashboard.links') }}</div></a>
    </li>
    <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('app.portfolio') }}</span></li>
    <li class="menu-item"><a href="{{ auth('sanctum')->user()->portfolio_link }}" target="_blank" class="menu-link"><i class="menu-icon tf-icons ti ti-external-link"></i><div>{{ __('dashboard.portfolio_link') }}</div></a></li>
    <li class="menu-item {{ request()->routeIs('clients.settings.*') ? 'active' : '' }}"><a class="menu-link" href="{{ route('clients.settings.show') }}"><i class="menu-icon tf-icons ti ti-settings"></i><div>{{ __('dashboard.settings') }}</div></a></li>
  @endif

  @if (auth('sanctum')->user()?->type === \App\Enums\UserType::ADMIN->value)
    <li class="menu-header small text-uppercase"><span class="menu-header-text">{{ __('dashboard.apps_pages') }}</span></li>
    <li class="menu-item {{ request()->routeIs('admins.users.*') ? 'active' : '' }}">
      <a href="{{ route('admins.users.index') }}" class="menu-link"><i class="menu-icon tf-icons ti ti-users"></i><div>{{ __('dashboard.users') }}</div></a>
    </li>
  @endif
</ul>
