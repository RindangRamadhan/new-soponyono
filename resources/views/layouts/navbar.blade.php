@php
// $notifcations = App\Models\Notif::notifList(Auth::user()->id);
$notifcations = [];
$notif_count = count($notifcations);
$year = \Request::session()->get('year') ?? date('Y');
@endphp

<!-- BEGIN: Header-->
<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
  <div class="navbar-wrapper">
    <div class="navbar-container content">
      <div class="navbar-collapse" id="navbar-mobile">
        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
          {{-- <h6>Tahun Anggaran {{$year + 1}}</h6> --}}
          {{-- <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
          </ul>
          <ul class="nav navbar-nav bookmark-icons">
            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon bx bx-envelope"></i></a></li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon bx bx-chat"></i></a></li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon bx bx-check-circle"></i></a></li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html" data-toggle="tooltip" data-placement="top" title="Calendar"><i class="ficon bx bx-calendar-alt"></i></a></li>
          </ul>
          <ul class="nav navbar-nav">
            <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon bx bx-star warning"></i></a>
              <div class="bookmark-input search-input">
                <div class="bookmark-input-icon"><i class="bx bx-search primary"></i></div>
                <input class="form-control input" type="text" placeholder="Explore Frest..." tabindex="0" data-search="template-search">
                <ul class="search-list"></ul>
              </div>
            </li>
          </ul> --}}
        </div>
        <ul class="nav navbar-nav float-right">
          <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
          <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
              <i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i>
              <span class="badge badge-pill badge-danger badge-up" id="notif_count">{{ $notif_count }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header px-1 py-75 d-flex justify-content-between">
                  <span class="notification-title"><span id="notif_title_count">{{ $notif_count }}</span> new Notification</span>
                  <span class="text-bold-400 cursor-pointer">
                    Mark all as read
                  </span>
                </div>
              </li>
              <li class="scrollable-container media-list" id="notif_content">
                @foreach ($notifcations as $v)
                <a class="d-flex justify-content-between" id="notification-{{$v->id}}" data-id="{{ $v->id }}" data-url="{{ $v->notif_url }}">
                  <div class="media d-flex align-items-center">
                    <div class="media-left pr-0">
                      <div class="avatar bg-rgba-danger m-0 mr-1 p-25">
                        <div class="avatar-content"><i class="bx bx-detail text-danger"></i></div>
                      </div>
                    </div>
                    <div class="media-body">
                      <h6 class="media-heading">
                        <span class="text-bold-500">{{ $v->title }},</span>
                        {{ strtolower($v->message) }}
                      </h6>
                      <small class="notification-text">
                        {{ date_format(date_create($v->created_at), 'd M Y, H:i') }}
                      </small>
                    </div>
                  </div>
                </a>
                @endforeach
              </li>
              <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Read all notifications</a></li>
            </ul>
          </li>
          <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="user-status text-muted">Available</span>
              </div>
              <span>
                {{-- @if (Auth::user()->photo)
                <img class="round" src="{{ asset('/img/upload/'.Auth::user()->photo) }}" alt="avatar" height="40" width="40">
                @else
                @endif --}}
                <img class="round" src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="avatar" height="40" width="40">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pb-0">
              <a class="dropdown-item" href="{{ url('users/'.Auth::user()->id.'/profile') }}">
                <i class="bx bx-user mr-50"></i> Edit Profil
              </a>
              <a class="dropdown-item" href="{{ url('users/'.Auth::user()->id.'/change-password') }}">
                <i class="bx bx-lock mr-50"></i> Ubah Password
              </a>
              <div class="dropdown-divider mb-0"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-power-off mr-50"></i> Keluar
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<!-- END: Header-->