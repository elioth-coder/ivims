@props(['active'=>'Dashboard', 'activeSub'=>'Home', 'count'=>[]])

<div id="sidebar" x-data="menu('{{ $active }}','{{ $activeSub }}')" class="border-r flex min-w-[350px] box-border bg-white"
    style="height: calc(100vh - 56px)">
    <ul class="flex flex-col min-w-[90px] h-full border-r" id="default-tab" role="tablist">
        <template x-for="item in items">
            <li role="presentation">
                <button type="button" role="tab"
                    class="group w-full py-3 text-gray-900 text-center items-center justify-center hover:bg-violet-200"
                    x-on:click="activate(item.name)" x-bind:class="(active == item.name) ? activeClass: ''">
                    <i class="font-medium inline-flex text-xl bi" x-bind:class="'bi-' + item.icon"></i>
                    <p style="font-size: 11px;" class="text-center font-bold" x-text="item.name"></p>
                </button>
            </li>
        </template>
    </ul>
    <div class="w-full text-sm">
        <template x-for="item in items">
            <div x-bind:id="item.name" x-show="active==item.name"
                class="h-full space-y-6 px-6 py-8 overflow-y-auto bg-gray-50">
                <h2 class="text-2xl font-black px-5" x-text="item.name"></h2>
                <hr>
                <ul class="space-y-1 font-medium">
                    <template x-for="subItem in item.items">
                        <li role="presentation">
                            <a x-bind:href="subItem.url"
                                class="flex items-center px-5 p-2 text-gray-900 rounded-2xl group hover:bg-violet-200 relative"
                                x-bind:class="(activeSub == subItem.name) ? activeClass: ''">
                                <span class="" x-text="subItem.name"></span>
                                <template x-if="subItem.count">
                                    <span class="text-xs rounded-full bg-red-700 text-white px-1 absolute end-0 me-2" x-text="subItem.count"></span>
                                </template>
                            </a>
                        </li>
                    </template>
                </ul>
            </div>
        </template>
    </div>
</div>
@php
$queryString = "";
    if(str_starts_with(request()->path(), 'search')) {
        $queryString = request('query') ? '?query=' . request('query') : '';
    }
@endphp
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('menu', (active='Dashboard', activeSub='Home') => ({
            active,
            activeSub,
            activeClass: 'text-white bg-violet-500 hover:text-white hover:bg-violet-500',
            items: [
                {
                    name: 'Dashboard',
                    icon: 'bar-chart-line-fill',
                    items: [
                        {
                            name: 'Dashboard',
                            url: '/dashboard',
                        },
                        {
                            name: 'Charts & Reports',
                            url: '/dashboard/report',
                        },
                        {
                            name: 'Announcements',
                            url: '/dashboard/announcement',
                        },
                    ]
                },
                {
                    name: 'Authentication',
                    icon: 'file-earmark-medical-fill',
                    items: [
                        {
                            name: 'Authentications',
                            url: '/authentication',
                        },
                        {
                            name: 'New Authentication',
                            url: '/authentication/create',
                        },
                    ]
                },
                {
                    name: 'Branches',
                    icon: 'building-fill',
                    items: [
                        {
                            name: 'List of Branches',
                            url: '/branch',
                        },
                        {
                            name: 'New Branch',
                            url: '/branch/create',
                        },
                    ]
                },

                {
                    name: 'Subagents',
                    icon: 'people-fill',
                    items: [
                        {
                            name: 'List of Subagents',
                            url: '/subagent',
                        },
                        {
                            name: 'New Subagent',
                            url: '/subagent/create',
                        },
                    ]
                },
                {
                    name: 'Chat Support',
                    icon: 'headset',
                    items: [
                        {
                            name: 'Tickets',
                            url: '/ticket',
                        },
                        {
                            name: 'Created',
                            url: '/ticket/created/status',
                            count: {{ $count['CREATED'] ?? 0 }},
                        },
                        {
                            name: 'Open',
                            url: '/ticket/open/status',
                            count: {{ $count['OPEN'] ?? 0 }},
                        },
                        {
                            name: 'In Progress',
                            url: '/ticket/in_progress/status',
                            count: {{ $count['IN PROGRESS'] ?? 0 }},
                        },
                        {
                            name: 'Resolved',
                            url: '/ticket/resolved/status',
                            count: {{ $count['RESOLVED'] ?? 0 }},
                        },
                        {
                            name: 'Closed',
                            url: '/ticket/closed/status',
                        },
                    ]
                },
                {
                    name: 'Search',
                    icon: 'search',
                    items: [
                        {
                            name: 'Insured Vehicles',
                            url: '/search/insured_vehicles{{ $queryString }}',
                            count: {{ $count['insured_vehicles'] ?? 0 }},
                        },
                        {
                            name: 'Policy Holders',
                            url: '/search/policy_holders{{ $queryString }}',
                            count: {{ $count['policy_holders'] ?? 0 }},
                        },
                        {
                            name: 'Authenticated Policies',
                            url: '/search/authenticated_policies{{ $queryString }}',
                            count: {{ $count['authenticated_policies'] ?? 0 }},
                        },
                        {
                            name: 'Advance Search',
                            url: '/search',
                        },
                    ]
                },
            ],
            activate(name) {
                this.active = name;
            },
        }))
    })
</script>
