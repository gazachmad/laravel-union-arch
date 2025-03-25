<div class="drawer-side">
    <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="bg-base-200 text-base-content min-h-full w-[276px] border-r border-base-300">
        <div class="p-3 h-14 flex items-center">
            <div class="truncate text-xl font-semibold">{{ config('app.name') }}</div>
        </div>
        <ul class="menu p-3 w-full bg-base-200 rounded-box space-y-2">
            <li>
                <ul class="m-0 space-y-1">
                    <li>
                        <a href="{{ route('home') }}" @class(['menu-active'=> $slug === 'home'])>
                            <i data-feather="home" class="w-4"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('todos.index') }}" @class(['menu-active'=> $slug === 'todos'])>
                            <i data-feather="edit" class="w-4"></i>
                            Todos
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="menu p-3 w-full bg-base-200 rounded-box space-y-2">
            <div class="text-xs font-semibold uppercase text-gray-400">System</div>
            <li>
                <ul class="m-0 space-y-1">
                    <li>
                        <a>
                            <i data-feather="users" class="w-4"></i>
                            Users
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>