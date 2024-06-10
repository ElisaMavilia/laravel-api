<nav id="sidebar">
<a href="/" class="nav-link text-white"><h2 class="py-4 pe-5">
        <img src="../images/em_logo.jpg" alt="">Portfolio</h2>
    </a>
    <ul class="nav flex-column px-3">
        <li class="nav-item">
          <a class="nav-link text-white {{Route::currentRouteName() == 'admin.dashboard' ? 'active' : ''}}" href="{{route('admin.dashboard')}}"><i class="fa-solid fa-tachometer-alt fa-lg fa-fw pe-3"></i>Dasboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white{{Route::currentRouteName() == 'admin.projects.index' ? 'active' : ''}}" href="{{route('admin.projects.index')}}"> <i class="fa-solid fa-suitcase pe-2"></i>Projects</a>
        </li>
      </ul>
</nav>