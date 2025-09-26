<ul class="menu-inner py-1">
  <!-- Dashboards -->
  <li class="menu-item {{ request()->routeIs('admins.index') || request()->routeIs('clients.index') ? 'active open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ti ti-smart-home"></i>
      <div data-i18n="Dashboards">Dashboards</div>
      <div class="badge bg-primary rounded-pill ms-auto">1</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item {{ request()->routeIs('admins.index') || request()->routeIs('clients.index') ? 'active' : '' }}">
        <a href="{{ auth('sanctum')->user()?->type === \App\Enums\UserType::ADMIN->value ? route('admins.index') : route('clients.index') }}" class="menu-link">
          <div data-i18n="Analytics">Analytics</div>
        </a>
      </li>
    </ul>
  </li>
  @if (auth('sanctum')->user()?->type === \App\Enums\UserType::CLIENT->value)
    <!-- Apps & Pages -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.educationals.*') ? 'active' : '' }}">
      <a href="{{ route('clients.educationals.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-mail"></i>
        <div data-i18n="Educational">Educational</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.experiences.*') ? 'active' : '' }}">
      <a href="{{ route('clients.experiences.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-messages"></i>
        <div data-i18n="Experience">Experience</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.languages.*') ? 'active' : '' }}">
      <a href="{{ route('clients.languages.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-calendar"></i>
        <div data-i18n="Language">Language</div>
      </a>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.skills.*') ? 'active' : '' }}">
      <a href="{{ route('clients.skills.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
        <div data-i18n="Skill">Skill</div>
      </a>
    </li>
    <!-- Academy menu start -->
    <li class="menu-item {{ request()->routeIs('clients.project-groups.*') || request()->routeIs('clients.projects.*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-book"></i>
        <div data-i18n="Project Works">Project Works</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('clients.project-groups.*') ? 'active' : '' }}">
          <a href="{{ route('clients.project-groups.index') }}" class="menu-link">
            <div data-i18n="Project Group">Project Group</div>
          </a>
        </li>
        <li class="menu-item {{ request()->routeIs('clients.projects.*') ? 'active' : '' }}">
          <a href="{{ route('clients.projects.index') }}" class="menu-link">
            <div data-i18n="Project">Project</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.websites.*') ? 'active' : '' }}">
      <a href="{{ route('clients.websites.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-layout-kanban"></i>
        <div data-i18n="Website">Website</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="Social & Links">Social &amp; Links</span>
    </li>
    <li class="menu-item {{ request()->routeIs('clients.links.*') ? 'active' : '' }}">
      <a href="{{ route('clients.links.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-map"></i>
        <div data-i18n="Links">Links</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="Portfolio">Portfolio</span>
    </li>
    <li class="menu-item">
      <a href="{{ auth('sanctum')->user()->portfolio_link }}" target="_blank" class="menu-link">
        <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
        <div data-i18n="Portfolio Link">Portfolio Link</div>
      </a>
    </li>
    <li class="menu-item">
      <a class="menu-link" href="{{ route('clients.settings.show') }}">
        <i class="ti ti-settings me-2 ti-sm"></i>
        <div data-i18n="Settings">Settings</div>
      </a>
    </li>
  @endif

  @if (auth('sanctum')->user()?->type === \App\Enums\UserType::ADMIN->value)
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
    </li>
    <li class="menu-item {{ request()->routeIs('admins.users.*') ? 'active' : '' }}">
      <a href="{{ route('admins.users.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-user"></i>
        <div data-i18n="Users">Users</div>
      </a>
    </li>
  @endif
</ul>