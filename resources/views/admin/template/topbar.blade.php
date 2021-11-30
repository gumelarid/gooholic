	<!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-layer-group"></i>
                    </a>
                    <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                        <div class="quick-actions-header">
                            <span class="title mb-1">Quick Actions</span>
                            <span class="subtitle op-8">Shortcuts</span>
                        </div>
                        <div class="quick-actions-scroll scrollbar-outer">
                            <div class="quick-actions-items">
                                <div class="row m-0">
                                    <a class="col-6 col-md-4 p-0" href="{{ url('/dashboard/page/add') }}">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-file-1"></i>
                                            <span class="text">Create New Page</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="{{ url('/dashboard/article/add') }}">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-pen"></i>
                                            <span class="text">Create New Post</span>
                                        </div>
                                    </a>
                                    <a class="col-6 col-md-4 p-0" href="{{ url('/dashboard/setting') }}">
                                        <div class="quick-actions-item">
                                            <i class="flaticon-interface-1"></i>
                                            <span class="text">Setting</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ url('assets/image/'.Auth::user()->profile) }}" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="{{ url('assets/image/'.Auth::user()->profile) }}" alt="image profile" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4> {{ Auth::user()->name }}</h4>
                                        <p class="text-muted"> {{ Auth::user()->email }}</p><a href="{{ url('dashboard/profile/'.Auth::user()->id_user) }}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>