<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed @if($config['theme'] === 'light') {{" menu-light"}} @else {{'menu-dark'}} @endif menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
        <a class="navbar-brand" href="/">
          <div class="d-flex align-items-start flex-column">
            <h2 class="brand-text title">{{ env('APP_NAME') }}</h2>
          </div>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
          <i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
          <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="bx-disc"></i>
        </a>
      </li>
    </ul>
  </div>

  <div class="shadow-bottom"></div>

  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
      @if(!empty($menus[0]) && isset($menus[0]))

      @foreach ($menus[0]->menu as $menu)

      @can($menu->role)

      @if(isset($menu->navheader))
      <li class="navigation-header"><span>{{$menu->navheader}}</span></li>
      @else
      <li class="nav-item {{(request()->is($menu->url.'*')) ? 'active' : '' }}">
        <a href="@if(isset($menu->url)){{asset($menu->url)}} @endif" @if(isset($menu->newTab)){{"target=_blank"}}@endif>
          @if(isset($menu->icon))
          <i class="menu-livicon" data-icon="{{$menu->icon}}"></i>
          @endif
          @if(isset($menu->name))
          <span class="menu-title" data-i18n="{{ $menu->i18n }}">{{ $menu->name }}</span>
          @endif
          @if(isset($menu->tag))
          <span class="{{$menu->tagcustom}}">{{$menu->tag}}</span>
          @endif
          @if(isset($menu->badge))
          <span class="badge badge-light-danger badge-pill badge-round float-right mr-2">
            @if ($menu->url == 'data/registrations')
            {{ $registration }}
            @elseif($menu->url == 'data/profile')
            {{ $profile }}
            @endif
          </span>
          @endif
        </a>
        @if(isset($menu->submenu))
        <ul class="menu-content">
          @foreach ($menu->submenu as $submenu)

          @can($submenu->role)

          <li {{(request()->is($submenu->url.'*')) ? 'class=active' : '' }}>
            <a href="@isset($submenu->url) {{asset($submenu->url)}} @endisset" @if(isset($submenu->newTab)){{"target=_blank"}}@endif>
              <i class="bx {{ $submenu->icon }}"></i>
              <span class="menu-item" data-i18n="{{ $submenu->i18n }}">{{ $submenu->name }}</span>
            </a>
            @if(isset($submenu->submenu))
            @include('panels.sidebar-submenu',['menu'=>$submenu->submenu])
            @endif
          </li>

          @endcan

          @endforeach
        </ul>
        @endif
      </li>
      @endif

      @endcan

      @endforeach

      @endif
    </ul>
  </div>
</div>
<!-- END: Main Menu-->