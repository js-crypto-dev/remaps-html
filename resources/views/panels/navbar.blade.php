@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
  <nav
    class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
    data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
      <ul class="nav navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('storage/uploads/logo/'.$company->logo) }}" style="max-width: 100%; height: auto; border-radius: 5px"></a>
          </a>
        </li>
      </ul>
    </div>
  @else
    <nav
      class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
@endif
<div class="navbar-container d-flex content">
  <div class="bookmark-wrapper d-flex align-items-center">
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
            data-feather="menu"></i></a></li>
    </ul>
    @if ($role == "master" || $role == "company")
      <ul class="nav navbar-nav bookmark-icons">
        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('customers.index') }}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Customers"><i class="ficon"
              data-feather="users"></i></a></li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('fileservices.index') }}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Files"><i class="ficon"
              data-feather="file"></i></a></li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('tickets.index') }}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tickets"><i class="ficon"
              data-feather="message-circle"></i></a></li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('company.setting') }}"
          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Settings"><i class="ficon"
            data-feather="settings"></i></a></li>
      </ul>
    @endif
    @if ($role == "customer")
      <ul class="nav navbar-nav bookmark-icons">
        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('dashboard.customer') }}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Home"><i class="ficon"
              data-feather="home"></i></a></li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('fs.index') }}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Files"><i class="ficon"
              data-feather="file"></i></a></li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('tk.index') }}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tickets"><i class="ficon"
              data-feather="message-circle"></i></a></li>
        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ route('cars.index') }}"
          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Specs"><i class="ficon"
            data-feather="search"></i></a></li>
      </ul>
    @endif
    {{-- <ul class="nav navbar-nav">
      <li class="nav-item d-none d-lg-block">
        <a class="nav-link bookmark-star">
          <i class="ficon text-warning" data-feather="star"></i>
        </a>
        <div class="bookmark-input search-input">
          <div class="bookmark-input-icon">
            <i data-feather="search"></i>
          </div>
          <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
          <ul class="search-list search-list-bookmark"></ul>
        </div>
      </li>
    </ul> --}}
  </div>
  <ul class="nav navbar-nav align-items-center ms-auto">
    @if ($role == 'customer')
      <li class="nav-item d-none d-lg-block">
        <a class="nav-link custom-card-link" href="{{ route('consumer.buy-credits') }}">
          <i data-feather="credit-card" class="card-custom"></i>
          <i data-feather="x"></i>
          <span style="font-weight: bold">{{ number_format($user->tuning_credits, 2) }}</span>
        </a>
      </li>
    @endif
    <li class="nav-item dropdown dropdown-language">
      <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
        <i class="flag-icon flag-icon-us"></i>
        <span class="selected-language">English</span>
      </a>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
        <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
          <i class="flag-icon flag-icon-gb"></i> {{__('locale.English')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/fr') }}" data-language="fr">
          <i class="flag-icon flag-icon-fr"></i> {{__('locale.French')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/es') }}" data-language="es">
          <i class="flag-icon flag-icon-es"></i> {{__('locale.Spanish')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/pt') }}" data-language="pt">
          <i class="flag-icon flag-icon-pt"></i> {{__('locale.Portuguese')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/it') }}" data-language="it">
          <i class="flag-icon flag-icon-it"></i> {{__('locale.Italian')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/jp') }}" data-language="jp">
          <i class="flag-icon flag-icon-jp"></i> {{__('locale.Japanese')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/nl') }}" data-language="nl">
          <i class="flag-icon flag-icon-nl"></i> {{__('locale.Dutch')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/pl') }}" data-language="pl">
          <i class="flag-icon flag-icon-pl"></i> {{__('locale.Polish')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/de') }}" data-language="de">
          <i class="flag-icon flag-icon-de"></i> {{__('locale.German')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/ru') }}" data-language="ru">
          <i class="flag-icon flag-icon-ru"></i> {{__('locale.Russian')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/tr') }}" data-language="tr">
          <i class="flag-icon flag-icon-tr"></i> {{__('locale.Turkish')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/no') }}" data-language="no">
          <i class="flag-icon flag-icon-no"></i> {{__('locale.Norway')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/se') }}" data-language="se">
          <i class="flag-icon flag-icon-se"></i> {{__('locale.Sweden')}}
        </a>
        <a class="dropdown-item" href="{{ url('lang/da') }}" data-language="da">
          <i class="flag-icon flag-icon-dk"></i> {{__('locale.Denmark')}}
        </a>
      </div>
    </li>
    {{-- <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
          data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i></a></li> --}}
    <li class="nav-item dropdown dropdown-user">
      <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
        data-bs-toggle="dropdown" aria-haspopup="true">
        <div class="user-nav d-sm-flex d-none">
          <span class="user-name fw-bolder">
            {{ $user->fullname }}
          </span>
          <span class="user-status">
            {{ ucfirst($role) }}
          </span>
        </div>
        <span class="avatar" style="background-color: #{{ \App\Helpers\Helper::generateAvatarColor($user->id) }}">
          <div class="avatar-content">{{ \App\Helpers\Helper::getInitialName($user->id) }}</div>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
        <h6 class="dropdown-header">
          Manage Profile
          {{-- * {{Auth::guard('master')->check() && Auth::guard('master')->user()->id}}
          * {{Auth::guard('admin')->check() && Auth::guard('admin')->user()->id}}
          * {{Auth::guard('customer')->check() && Auth::guard('customer')->user()->id}} * --}}
        </h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item"
          href="{{ $user->is_admin || $user->is_staff ? route('admin.dashboard.profile') : route('dashboard.profile') }}">
          <i class="me-50" data-feather="user"></i> Profile
        </a>
        <a class="dropdown-item"
          href="{{ $user->is_admin || $user->is_staff ? route('admin.password.edit') : route('password.edit') }}">
          <i class="me-50" data-feather="key"></i> Change Password
        </a>
        @if ($user->is_admin || $user->is_staff)
          <a class="dropdown-item" href="{{ route('admin.auth.logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="me-50" data-feather="power"></i> Logout
          </a>
          <form method="POST" id="logout-form" action="{{ route('admin.auth.logout') }}">
            @csrf
          </form>
        @else
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="me-50" data-feather="power"></i> Logout
          </a>
          <form method="POST" id="logout-form" action="{{ route('logout') }}">
            @csrf
          </form>
        @endif
      </div>
    </li>
  </ul>
</div>
</nav>

{{-- Search Start Here --}}
<ul class="main-search-list-defaultlist d-none">
  <li class="d-flex align-items-center">
    <a href="javascript:void(0);">
      <h6 class="section-label mt-75 mb-0">Files</h6>
    </a>
  </li>
  <li class="auto-suggestion">
    <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
      <div class="d-flex">
        <div class="me-75">
          <img src="{{ asset('images/icons/xls.png') }}" alt="png" height="32">
        </div>
        <div class="search-data">
          <p class="search-data-title mb-0">Two new item submitted</p>
          <small class="text-muted">Marketing Manager</small>
        </div>
      </div>
      <small class="search-data-size me-50 text-muted">&apos;17kb</small>
    </a>
  </li>
  <li class="auto-suggestion">
    <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
      <div class="d-flex">
        <div class="me-75">
          <img src="{{ asset('images/icons/jpg.png') }}" alt="png" height="32">
        </div>
        <div class="search-data">
          <p class="search-data-title mb-0">52 JPG file Generated</p>
          <small class="text-muted">FontEnd Developer</small>
        </div>
      </div>
      <small class="search-data-size me-50 text-muted">&apos;11kb</small>
    </a>
  </li>
  <li class="auto-suggestion">
    <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
      <div class="d-flex">
        <div class="me-75">
          <img src="{{ asset('images/icons/pdf.png') }}" alt="png" height="32">
        </div>
        <div class="search-data">
          <p class="search-data-title mb-0">25 PDF File Uploaded</p>
          <small class="text-muted">Digital Marketing Manager</small>
        </div>
      </div>
      <small class="search-data-size me-50 text-muted">&apos;150kb</small>
    </a>
  </li>
  <li class="auto-suggestion">
    <a class="d-flex align-items-center justify-content-between w-100" href="{{ url('app/file-manager') }}">
      <div class="d-flex">
        <div class="me-75">
          <img src="{{ asset('images/icons/doc.png') }}" alt="png" height="32">
        </div>
        <div class="search-data">
          <p class="search-data-title mb-0">Anna_Strong.doc</p>
          <small class="text-muted">Web Designer</small>
        </div>
      </div>
      <small class="search-data-size me-50 text-muted">&apos;256kb</small>
    </a>
  </li>
  <li class="d-flex align-items-center">
    <a href="javascript:void(0);">
      <h6 class="section-label mt-75 mb-0">Members</h6>
    </a>
  </li>
  <li class="auto-suggestion">
    <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
      <div class="d-flex align-items-center">
        <div class="avatar me-75">
          <img src="{{ asset('images/portrait/small/avatar-s-8.jpg') }}" alt="png" height="32">
        </div>
        <div class="search-data">
          <p class="search-data-title mb-0">John Doe</p>
          <small class="text-muted">UI designer</small>
        </div>
      </div>
    </a>
  </li>
  <li class="auto-suggestion">
    <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
      <div class="d-flex align-items-center">
        <div class="avatar me-75">
          <img src="{{ asset('images/portrait/small/avatar-s-1.jpg') }}" alt="png" height="32">
        </div>
        <div class="search-data">
          <p class="search-data-title mb-0">Michal Clark</p>
          <small class="text-muted">FontEnd Developer</small>
        </div>
      </div>
    </a>
  </li>
  <li class="auto-suggestion">
    <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
      <div class="d-flex align-items-center">
        <div class="avatar me-75">
          <img src="{{ asset('images/portrait/small/avatar-s-14.jpg') }}" alt="png" height="32">
        </div>
        <div class="search-data">
          <p class="search-data-title mb-0">Milena Gibson</p>
          <small class="text-muted">Digital Marketing Manager</small>
        </div>
      </div>
    </a>
  </li>
  <li class="auto-suggestion">
    <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{ url('app/user/view') }}">
      <div class="d-flex align-items-center">
        <div class="avatar me-75">
          <img src="{{ asset('images/portrait/small/avatar-s-6.jpg') }}" alt="png" height="32">
        </div>
        <div class="search-data">
          <p class="search-data-title mb-0">Anna Strong</p>
          <small class="text-muted">Web Designer</small>
        </div>
      </div>
    </a>
  </li>
</ul>

{{-- if main search not found! --}}
<ul class="main-search-list-defaultlist-other-list d-none">
  <li class="auto-suggestion justify-content-between">
    <a class="d-flex align-items-center justify-content-between w-100 py-50">
      <div class="d-flex justify-content-start">
        <span class="me-75" data-feather="alert-circle"></span>
        <span>No results found.</span>
      </div>
    </a>
  </li>
</ul>
{{-- Search Ends --}}
<!-- END: Header-->
