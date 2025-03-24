@extends('auth')

@section('content')
<div class="flex justify-center items-center h-screen bg-base-200">
    <div class="card bg-base-100 max-h-[80vh] w-md">
        <div class="p-3 space-y-3">
            <div class="px-3 py-5 space-y-1">
                <h2 class="text-2xl font-semibold text-center">Reset Password</h2>
                <p class="text-sm text-center">Reset your password</p>
            </div>
            @include('layouts.alert')
            <form action="" method="POST" class="space-y-3">
                @csrf
                <div class="space-y-1">
                    <div class="text-xs">Password</div>
                    <input type="password" name="password" class="input w-full @error('password') input-error @enderror" placeholder="Enter password">
                    @error('password')
                    <div class="text-xs text-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="space-y-1">
                    <div class="text-xs">Password Confirmation</div>
                    <input type="password" name="password_confirmation" class="input w-full @error('password_confirmation') input-error @enderror" placeholder="Enter password confirmation">
                    @error('password_confirmation')
                    <div class="text-xs text-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-10">
                    <button class="btn btn-primary w-full">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection