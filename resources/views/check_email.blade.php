<x-layout>
    <x-slot:title>Check your Email</x-slot:title>
    <nav class="sticky top-0 left-0 right-0 bg-violet-800 border-b border-violet-600">
        <div class="max-w-5xl mx-auto flex justify-between">
            <x-logo-brand class="text-white p-3" />
            <div class="flex items-center p-3">
                <a href="/"
                    class="text-white bg-purple-700 hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>
    </nav>
    <div class="w-full">
        <main class="max-w-screen-2xl mx-auto flex bg-gray-100">
            <div class="w-full pt-2 overflow-hidden h-screen" style="height: calc(100vh - 90px)">
                <section class="px-8">
                    @auth
                        <x-breadcrumb :$breadcrumbs />
                    @endauth
                    <div>
                        <section class="w-full py-8">
                            <div class="flex items-center justify-evenly px-6 mx-auto">
                                <div class="max-w-md">
                                    <img class="w-[400px] block"
                                        src="{{ asset('images/done-cartoon.png')}}"
                                    />
                                </div>
                                <x-card class="max-w-md">
                                    <x-card-header>You're all signed up!</x-card-header>
                                    <img src="{{ asset('images/green-pencil-cartoon.png') }}" class="w-[200px] block mx-auto" />
                                    <p class="text-center">
                                        Please check your email for the<br>
                                        confirmation message we just sent you. <br>
                                    </p>
                                </x-card>
                            </div>
                        </section>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
</x-layout>
