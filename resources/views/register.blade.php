<x-layout>
    <x-slot:title>Sign Up</x-slot:title>
    <nav class="sticky top-0 left-0 right-0 border-b bg-violet-800 border-violet-600">
        <div class="flex justify-between max-w-screen-xl mx-auto">
            <x-logo-brand class="p-3 text-white" />
            <div class="flex items-center p-3">
                <a href="/"
                    class="text-white bg-purple-700 hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                    <i class="bi bi-arrow-left"></i>
                    <span class="hidden sm:inline">Back</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="w-full">
        <main class="flex max-w-screen-xl mx-auto">
            <div class="w-full h-screen sm:pt-2 overflow-hidden" style="height: calc(100vh - 90px)">
                <section class="sm:px-8">
                    @auth
                        <x-breadcrumb :$breadcrumbs />
                    @endauth
                    <div>
                        <section class="w-full p-4">
                            <div class="flex flex-col sm:flex-row items-center mx-auto justify-evenly">
                                <div class="max-w-md hidden sm:block">
                                    <img class="w-[400px] block"
                                        src="{{ asset('images/signup-cartoon.png')}}"
                                    />
                                </div>
                                <x-card class="max-w-md mt-10 sm:mt-6">
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
                                    <p class="mt-16 mb-5 text-sm text-center">
                                        Already have an account?
                                        <a href="/login" class="hover:underline hover:text-violet-600 text-violet-700">Log In</a>
                                    </p>
                                </x-card>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
        </main>
    </div>
    <footer class="absolute bottom-0 left-0 right-0 py-5 text-white border-t bg-violet-800 border-violet-600">
        <p class="font-thin text-center">Copyright &copy; 2024 IVIM System | v1.0.0</p>
    </footer>
</x-layout>
