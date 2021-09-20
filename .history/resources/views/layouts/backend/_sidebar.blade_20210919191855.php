<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">My Blog Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pages
    </div>

    <li class="nav-item {{ Route::is('admin.index') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-home"></i>
            <span> Main</span></a>
    </li>



    @if (Auth::user()->isAbleTo('posts-read'))
    <li class="nav-item {{ Route::is('admin.post.*') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.post.index') }}">
            <i class="fas fa-fw fa-blog"></i>
            <span> Posts</span></a>
    </li>
    @endif

    @if (Auth::user()->isAbleTo('comments-read'))
    <li class="nav-item {{ Route::is('admin.comment.*') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.comment.index') }}">
            <i class="fas fa-fw fa-comment"></i>
            <span> Comments</span></a>

    </li>
    @endif




    @if (Auth::user()->isAbleTo('users-read'))
    <li class="nav-item {{ Route::is('admin.user.*') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span> users</span></a>
    </li>

    @endif

    @if (Auth::user()->isAbleTo('contact-messages-read'))
    <li class="nav-item {{ Route::is('admin.contact-message.*') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.contact-message.index') }}">
            <i class="fas fa-fw fa-inbox"></i>
            <span> Messeges</span></a>
    </li>
    @endif

    @if (Auth::user()->isAbleTo('categories-read'))
    <li class="nav-item {{ Route::is('admin.category.*') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.category.index') }}">
            <i class="fas fa-fw fa-list-ul"></i>
            <span> Categories</span></a>
    </li>
    @endif
    @if (Auth::user()->isAbleTo('admins-read'))
    <li class="nav-item {{ Route::is('admin.admins.*') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.admins.index') }}">
            <i class="fas fa-chalkboard-teacher"></i>
            <span> Admins</span></a>
    </li>
    @endif

    @if (Auth::user()->isAbleTo('settings-read'))
    <li class="nav-item {{ Route::is('admin.setting.*') ? 'active':'' }}">
        <a class="nav-link" href="{{ route('admin.setting.index') }}">
            <i class="fas fa-chalkboard-teacher"></i>
            <span> Settings</span></a>
    </li>
    @endif





    {{-- <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider">




    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
