<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ url('assets/image/'.Auth::user()->profile) }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            @if ( Auth::user()->role == 0 )
                                <span class="user-level">Administrator</span>
                            @else
                                <span class="user-level">User</span>
                            @endif
                            
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(3) == 'article' ? 'active' : '' }}">
                    <a href="{{ url('/dashboard/article') }}">
                        <i class="fas fa-pen"></i>
                        <p>Articles</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(3) == 'page' ? 'active' : '' }}">
                    <a href="{{ url('/dashboard/page') }}">
                        <i class="fas fa-book"></i>
                        <p>Pages</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(3) == 'category' ? 'active' : '' }}">
                    <a href="{{ url('/dashboard/category') }}">
                        <i class="fas fa-tag"></i>
                        <p>Categorys</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(3) == 'comment' ? 'active' : '' }}">
                    <a href="{{ url('/dashboard/comment') }}">
                        <i class="fas fa-comment"></i>
                        <p>Comments</p>
                        <?php $comment = \App\Models\CommentModel::where('is_publish', '0')->get() ?>
                        @if (count($comment) >= 1)
                            <span class="badge bg-danger" style="color: white">{{ count($comment) }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Configuration</h4>
                </li>
                <li class="nav-item {{ Request::segment(3) == 'user' ? 'active' : '' }}">
                    <a href="{{ url('/dashboard/user') }}">
                        <i class="fas fa-user"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(3) == 'setting' ? 'active' : '' }}">
                    <a href="{{ url('/dashboard/setting') }}">
                        <i class="fas fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->