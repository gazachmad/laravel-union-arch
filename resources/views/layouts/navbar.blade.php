<div class="p-3 h-14 flex items-center space-x-2 border-b border-base-200">
    <label for="my-drawer-2" class="btn btn-ghost btn-square btn-sm drawer-button lg:hidden">
        <i data-feather="sidebar" class="w-5"></i>
    </label>
    <div class="truncate text-xl font-semibold flex-1">{{ $title }}</div>
    <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
            <div class="w-10 h-10 rounded-full bg-base-300 flex items-center justify-center text-base">{{ $auth_user->getInitial() }}</div>
        </div>
        <ul tabindex="0" class="dropdown-content menu p-1 mt-2 bg-base-100 border border-base-200 rounded-box min-w-40 space-y-1">
            <div class="p-2 text-center">
                <div class="text-base font-semibold">{{ $auth_user->getName() }}</div>
                <div class="text-gray-400">{{ $auth_user->getEmail() }}</div>
            </div>
            <div class="border-b border-base-200"></div>
            <li><a href="{{ route('auth.logout') }}"><i data-feather="log-out" class="w-4"></i> Logout</a></li>
        </ul>
    </div>
</div>