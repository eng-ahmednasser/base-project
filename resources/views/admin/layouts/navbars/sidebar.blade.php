<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('Dashboard') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.profile.edit') }}">
            <span class="sidebar-mini">
                <i class="material-icons">person</i>
            </span>
          <span class="sidebar-normal">{{ __('User Profile') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
          <span class="sidebar-mini">
              <i class="material-icons">people</i>
          </span>
          <span class="sidebar-normal"> {{ __('User Management') }} </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'role-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.role.index') }}">
          <span class="sidebar-mini">
              <i class="material-icons">fingerprint</i>
          </span>
          <span class="sidebar-normal"> {{ __('Role Management') }} </span>
        </a>
      </li>
      <li class="nav-item {{ $activePage == 'ticket-management' ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#TicketsManagement" aria-expanded="true">
            <i class="material-icons">view_list</i>
            <p>{{ __('Ticket management') }}
            {{-- <b class="caret"></b> --}}
          </p>
        </a>
        <div class="collapse show" id="TicketsManagement">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'owned-ticket-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('admin.ticket.index') }}">
                <i class="material-icons">view_list</i>
                <span class="sidebar-normal">{{ __('Created Tickets') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'owned-ticket-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin.ticket-owner.index') }}">
                  <i class="material-icons">view_list</i>
                  <span class="sidebar-normal">{{ __('Assigned Tickets') }} </span>
                </a>
              </li>
          </ul>
        </div>
      </li>
      {{--
       <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Typography') }}</p>
        </a>
      </li>
       <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin.language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li> --}}
    </ul>
  </div>
</div>
