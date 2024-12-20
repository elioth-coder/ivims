<button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
    class="capitalize text-white break-keep flex items-center text-sm pe-4 font-medium rounded-full hover:text-gray-400 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
    type="button">
    <img class="w-8 h-8 me-2 rounded-full" src="{{ asset('images/profile.png') }}" alt="user photo">
    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
</button>

<!-- Dropdown menu -->
<div id="dropdownAvatarName"
    class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
        <div class="truncate">{{ Auth::user()->email }}</div>
    </div>
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
        <li>
            <a href="#"
                class="block px-4 py-2 hover:bg-violet-200 dark:hover:bg-gray-600 dark:hover:text-white">
                Edit Profile
            </a>
        </li>
    </ul>
    <div class="py-2">
        <button
            onclick="confirmLogout()"
            class="w-full block text-left px-4 py-2 text-sm text-gray-700 hover:bg-violet-200 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
            Log Out
        </button>
    </div>
</div>
