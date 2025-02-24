@props(['active'=>'Dashboard', 'activeSub'=>'Dashboard', 'count'=>[]])

@if(strtoupper(Auth::user()->role)=='ADMIN')
    <x-sidebar-admin :$active :$activeSub :$count />
@elseif(strtoupper(Auth::user()->role)=='SUPPORT')
    <x-sidebar-support :$active :$activeSub :$count />
@elseif(strtoupper(Auth::user()->role)=='AGENT')
    <x-sidebar-agent :$active :$activeSub :$count />
@elseif(strtoupper(Auth::user()->role)=='SUBAGENT')
    <x-sidebar-agent :$active :$activeSub :$count />
@endif
