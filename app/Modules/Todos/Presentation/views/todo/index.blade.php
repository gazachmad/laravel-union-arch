@extends('app')

@section('content')
<div class="p-3 space-y-3">
    <form action="">
        <div class="flex justify-end space-x-2">
            <label class="input">
                <input type="text" name="q" placeholder="Search..." value="{{ request()->input('q') }}">
                <button class="label cursor-pointer"><i data-feather="search" class="w-4"></i></button>
            </label>
            <a href="{{ route('todos.add') }}" class="btn btn-primary"><i data-feather="plus" class="w-4"></i> Add</a>
        </div>
    </form>
    @include('layouts.alert')
    <div class="overflow-x-auto rounded-box border border-base-200 bg-base-100">
        <table class="table">
            <thead class="bg-base-200">
                <tr>
                    <th class="px-3 py-2">#</th>
                    <th class="px-3 py-2">Title</th>
                    <th class="px-3 py-2">Description</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2">Created At</th>
                    <th class="px-3 py-2">Updated At</th>
                    <th class="px-3 py-2">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($todos as $todo)
                <tr>
                    <td class="px-3 py-2">{{ $loop->iteration + ($todos->currentPage() - 1) * $todos->perPage() }}</td>
                    <td class="px-3 py-2">{{ $todo->getTitle() }}</td>
                    <td class="px-3 py-2">{{ $todo->getDescription() }}</td>
                    <td class="px-3 py-2">
                        @if ($todo->isCompleted())
                        <div class="badge badge-soft badge-success badge-sm">Completed</div>
                        @else
                        <div class="badge badge-soft badge-warning badge-sm">Pending</div>
                        @endif
                    </td>
                    <td class="px-3 py-2">{{ $todo->getCreatedAt()->format('j/n/Y, H.i') }}</td>
                    <td class="px-3 py-2">{{ $todo->getUpdatedAt() ? $todo->getUpdatedAt()->format('j/n/Y, H.i') : '-' }}</td>
                    <td class="px-3 py-2">
                        <div class="join">
                            <a href="{{ route('todos.edit', ['id' => $todo->getId()]) }}" class="btn btn-info btn-outline btn-xs join-item"><i data-feather="edit-3" class="w-4"></i></a>
                            <a href="{{ route('todos.delete', ['id' => $todo->getId()]) }}" onclick="return confirm('Are you sure you want to delete this todo?')" class="btn btn-error btn-outline btn-xs join-item"><i data-feather="trash-2" class="w-4"></i></a>
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
    @include('layouts.pagination', ['paginated' => $todos])
</div>
@endsection