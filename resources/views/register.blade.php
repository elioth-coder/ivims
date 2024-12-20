<x-layout>
    <x-slot:title>Sign Up</x-slot:title>
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
                                        src="{{ asset('images/signup-cartoon.png')}}"
                                    />
                                </div>
                                <x-card class="max-w-md">
                                    <x-card-header>Sign up your account</x-card-header>
                                    @error('credential')
                                        <x-alert color="red" id="credential_error">
                                            <x-slot:icon>
                                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                                </svg>
                                            </x-slot:icon>
                                            <span>{{ $message }}</span>
                                        </x-alert>
                                    @enderror
                                    <x-forms.form action="/email_registration" method="POST">
                                        <x-forms.input-field name="email" type="email" label="Email" placeholder="name@company.com"
                                            required />
                                        <x-forms.input-field name="password" type="password" label="Password" placeholder="••••••••"
                                            required />
                                        <x-forms.input-field name="password_confirmation" type="password" label="Confirm Password" placeholder="••••••••"
                                            required />

                                        <x-forms.button type="submit" color="violet">Register</x-forms.button>
                                    </x-forms.form>
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
