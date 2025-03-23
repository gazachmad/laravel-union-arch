@if (session()->has('alert.info'))
<div role="alert" class="alert alert-info alert-soft flex justify-between">
    <span>{{ session('alert.info') }}</span>
    <button type="button" class="btn btn-ghost btn-xs btn-square" onclick="this.parentElement.remove()"><i data-feather="x" class="w-4"></i></button>
</div>
@elseif (session()->has('alert.success'))
<div role="alert" class="alert alert-success alert-soft flex justify-between">
    <span>{{ session('alert.success') }}</span>
    <button type="button" class="btn btn-ghost btn-xs btn-square" onclick="this.parentElement.remove()"><i data-feather="x" class="w-4"></i></button>
</div>
@elseif (session()->has('alert.warning'))
<div role="alert" class="alert alert-warning alert-soft flex justify-between">
    <span>{{ session('alert.warning') }}</span>
    <button type="button" class="btn btn-ghost btn-xs btn-square" onclick="this.parentElement.remove()"><i data-feather="x" class="w-4"></i></button>
</div>
@elseif (session()->has('alert.error'))
<div role="alert" class="alert alert-error alert-soft flex justify-between">
    <span>{{ session('alert.error') }}</span>
    <button type="button" class="btn btn-ghost btn-xs btn-square" onclick="this.parentElement.remove()"><i data-feather="x" class="w-4"></i></button>
</div>
@endif