<header class="main-header navbar">
    <div class="col-search">
        {{--<form class="searchform">
            <div class="input-group">
                <input list="search_terms" type="text" class="form-control" placeholder="Search term">
                <button class="btn btn-light bg" type="button"> <i class="material-icons md-search"></i> </button>
            </div>
            <datalist id="search_terms">
                <option value="Products">
                <option value="New orders">
                <option value="Apple iphone">
                <option value="Ahmed Hassan">
            </datalist>
        </form>--}}
    </div>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="md-28 material-icons md-menu"></i> </button>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link btn-icon" onclick="darkmode(this)" title="Dark mode" href="javascript:;"> <i class="material-icons md-nights_stay"></i> </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"> English </a>
            </li>
            <li class="dropdown nav-item">
                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#"> <img class="img-xs rounded-circle" src="{{ asset('admin_assets/admin/images/people/avatar1.jpg') }}" alt="User"></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('admin_update_profile') }}">My profile</a>
                    <a class="dropdown-item" href="{{ route('admin_settings') }}">Settings</a>
                    <a class="dropdown-item text-danger" href="{{ route('admin_logout') }}">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</header>
