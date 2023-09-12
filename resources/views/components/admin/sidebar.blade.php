<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.index'))active @endif" aria-current="page" href="{{ route('admin.index') }}">
                        <svg class="bi"><use xlink:href="#house-fill"/></svg>
                        {{ __('Main page') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.categories.*'))active @endif" href="{{ route('admin.categories.index') }}">
                        <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                        {{ __('Categories') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.news.*'))active @endif" href="{{ route('admin.news.index') }}">
                        <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                        {{ __('News') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.orders.*'))active @endif" href="{{ route('admin.orders.index') }}">
                        <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                        {{ __('Orders') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.profiles.*'))active @endif" href="{{ route('admin.profiles.index') }}">
                        <svg class="bi"><use xlink:href="#people"/></svg>
                        {{ __('Users profiles') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.news-sources.*'))active @endif" href="{{ route('admin.news-sources.index') }}">
                        <svg class="bi"><use xlink:href="#people"/></svg>
                        {{ __('News Sources') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('admin.parser.*'))active @endif" href="{{ route('admin.parser.index') }}">
                        <svg class="bi"><use xlink:href="#people"/></svg>
                        {{ __('Parser') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
