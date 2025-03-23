@extends('app')

@section('content')
<div class="p-3 space-y-3">
    <div class="flex justify-end">
        <a href="{{ route('todos.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="w-4"></i> Back</a>
    </div>
    @include('layouts.alert')
    <div class="p-3 rounded-box border border-base-200 bg-base-100">
        <form action="" method="POST" class="space-y-3">
            @csrf
            <div class="flex items-center gap-2">
                <div class="basis-3/12 text-sm">Title</div>
                <div class="basis-9/12">
                    <input type="text" name="title" placeholder="Enter title" value="{{ old('title', $todo?->getTitle()) }}" class="input w-full @error('title') input-error @enderror">
                    @error('title')
                        <div class="text-xs text-error mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="basis-3/12 text-sm">Description</div>
                <div class="basis-9/12">
                    <textarea name="description" placeholder="Enter description" class="textarea w-full @error('description') textarea-error @enderror">{{ old('description', $todo?->getDescription()) }}</textarea>
                    @error('description')
                        <div class="text-xs text-error mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="basis-3/12 text-sm"></div>
                <div class="basis-9/12">
                    <label class="text-sm flex items-center gap-2">
                        <input type="checkbox" name="completed" @checked(old('completed', $todo?->isCompleted())) class="toggle toggle-primary" />
                        <span>Completed</span>
                    </label>
                </div>
            </div>
            <div class="flex items-center gap-2 mt-10">
                <div class="basis-3/12 text-sm"></div>
                <div class="basis-9/12">
                    <button class="btn btn-primary"><i data-feather="save" class="w-4"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection