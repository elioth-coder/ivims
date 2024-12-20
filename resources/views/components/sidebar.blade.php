@props(['active'=>'Dashboard', 'activeSub'=>'Home', 'count'=>[]])

@if(strtolower(Auth::user()->role)=='admin')
    <x-sidebar-admin :$active :$activeSub />
@else
    <x-sidebar-agent :$active :$activeSub />
@endif
