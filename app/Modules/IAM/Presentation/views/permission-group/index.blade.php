@extends('app')

@section('content')
<div class="p-3 space-y-3">
    <form action="">
        <div class="flex justify-end space-x-2">
            <label class="input">
                <input type="text" name="q" placeholder="Search..." value="{{ request()->input('q') }}">
                <button class="label cursor-pointer"><i data-feather="search" class="w-4"></i></button>
            </label>
            <a href="{{ route('permission-groups.add') }}" class="btn btn-primary"><i data-feather="plus" class="w-4"></i> Add</a>
        </div>
    </form>
    @include('layouts.alert')
    <div class="overflow-x-auto rounded-box border border-base-200 bg-base-100">
        <table class="table">
            <thead class="bg-base-200">
                <tr>
                    <th class="px-3 py-2">#</th>
                    <th class="px-3 py-2">Name</th>
                    <th class="px-3 py-2">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permission_groups as $permission_group)
                <tr>
                    <td class="px-3 py-2">{{ $loop->iteration + ($permission_groups->currentPage() - 1) * $permission_groups->perPage() }}</td>
                    <td class="px-3 py-2">{{ $permission_group->getName() }}</td>
                    <td class="px-3 py-2">
                        <div class="join">
                            <a href="{{ route('permission-groups.edit', ['id' => $permission_group->getId()]) }}" class="btn btn-info btn-outline btn-xs join-item"><i data-feather="edit-3" class="w-4"></i></a>
                            <a href="{{ route('permission-groups.delete', ['id' => $permission_group->getId()]) }}" onclick="return confirm('Are you sure you want to delete this todo?')" class="btn btn-error btn-outline btn-xs join-item"><i data-feather="trash-2" class="w-4"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-3 py-2">
                        <div class="p-3 flex flex-col items-center justify-center">
                            <i data-feather="alert-triangle" class="w-12 h-12 text-gray-400"></i>
                            <div class="mt-2">No data found</div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @include('layouts.pagination', ['paginated' => $permission_groups])
</div>
@endsection