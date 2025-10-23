@extends('app')

@section('content')
<div class="p-3 space-y-3">
    <div class="flex justify-end">
        <a href="{{ route('permission-groups.index') }}" class="btn btn-secondary"><i data-feather="arrow-left" class="w-4"></i> Back</a>
    </div>
    @include('layouts.alert')
    <div class="p-3 rounded-box border border-base-200 bg-base-100">
        <form action="" method="POST" class="space-y-3">
            @csrf
            <div class="flex items-center gap-2">
                <div class="basis-3/12 text-sm">Name</div>
                <div class="basis-9/12 space-y-1">
                    <input type="text" name="name" placeholder="Enter name" value="{{ old('name', $permission_group?->getTitle()) }}" class="input w-full @error('name') input-error @enderror">
                    @error('name')
                    <div class="text-xs text-error">{{ $message }}</div>
                    @enderror
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