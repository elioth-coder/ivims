<nav class="bg-violet-700 border-b border-violet-600 z-10 flex text-white h-[70px]">
    <div class="flex mx-auto max-w-screen-2xl w-full items-center">
        <div class="min-w-[350px] h-full px-3 flex items-center">
            @auth
                <span class="hidden w-9 h-9"></span>
                <x-logo-brand size="9" class="text-xl" />
            @endauth
        </div>

        @auth
            <div class="flex font-bold w-full h-full items-center justify-center">
                <x-searchbar />
            </div>

            <div class="font-bold flex px-3 min-w-[350px] justify-end">
                <x-avatar-with-dropdown />
            </div>
        @endauth

        @guest
            <div class="w-full min-h-[80px] flex items-center justify-center">
                <span class="hidden w-10 h-10"></span>
                <x-logo-brand size="10" class="text-2xl" />
            </div>
            <div class="font-bold flex px-3 min-w-[350px] justify-end"></div>
        @endguest
    </div>
</nav>
