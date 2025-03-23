<div class="p-3 h-14 flex items-center space-x-2">
    <label for="my-drawer-2" class="btn btn-ghost btn-square btn-sm drawer-button lg:hidden">
        <i data-feather="sidebar" class="w-5"></i>
    </label>
    <div class="truncate text-xl font-semibold flex-1">{{ $title }}</div>
    <button class="btn btn-ghost btn-circle avatar" popovertarget="popover-2" style="anchor-name:--anchor-2">
        <div class="w-10 rounded-full bg-base-300"></div>
    </button>
</div>
<ul class="dropdown dropdown-end menu p-1 mt-1 rounded-box bg-base-100 border border-base-200" popover id="popover-2" style="position-anchor:--anchor-2">
    <li>
        <a class="justify-between">
            Profile
            <span class="badge">New</span>
        </a>
    </li>
    <li><a>Settings</a></li>
    <li><a href="{{ route('auth.logout') }}">Logout</a></li>
</ul>