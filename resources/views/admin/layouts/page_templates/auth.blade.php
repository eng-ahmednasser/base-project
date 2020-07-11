<div class="wrapper ">
  @include('admin.layouts.navbars.sidebar')
  <div class="main-panel">
    @include('admin.layouts.navbars.navs.auth')
    <div class="content">
        <div class="container-fluid">
            @include('admin.layouts.message')
            @yield('content')
        </div>
    </div>
    @include('admin.layouts.footers.auth')
  </div>
</div>
