@extends('auth')

@section('content')
<div class="flex justify-center items-center h-screen bg-base-200">
    <div class="card bg-base-100 max-h-[80vh] w-md overflow-auto">
        <div class="p-3 space-y-3">
            <div class="py-5 space-y-1">
                <h2 class="text-2xl font-semibold text-center">Login</h2>
                <p class="text-sm text-center">Login to your account</p>
            </div>
            @include('layouts.alert')
            <form action="" method="POST" class="space-y-3">
                @csrf
                <div class="space-y-1">
                    <div class="text-xs">Phone Number</div>
                    <input type="text" name="phone_number" class="input w-full @error('phone_number') input-error @enderror" placeholder="Enter phone number" value="{{ old('phone_number') }}">
                    @error('phone_number')
                    <div class="text-xs text-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="space-y-1">
                    <div class="text-xs">Password</div>
                    <div class="input w-full @error('password') input-error @enderror">
                        <input type="password" name="password" placeholder="Enter password">
                        <button type="button" class="label cursor-pointer" data-action="toggle-password"><i data-feather="eye" class="w-4"></i></button>
                    </div>
                    @error('password')
                    <div class="text-xs text-error">{{ $message }}</div>
                    @enderror
                </div>
                <label class="text-sm flex items-center gap-2">
                    <input type="checkbox" name="remember" @checked(old('remember')) class="toggle toggle-primary toggle-sm" />
                    <span>Remember me</span>
                </label>
                <div class="mt-10">
                    <button class="btn btn-primary w-full">Login</button>
                </div>
                <div class="flex justify-center">
                    <a href="{{ route('auth.forgot-password') }}" class="text-sm text-primary hover:underline">Forgot Password?</a>
                </div>
                <div class="flex justify-center">
                    <div class="text-sm">Don't have an account? <a href="{{ route('auth.register') }}" class="text-primary hover:underline">Register</a></div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection