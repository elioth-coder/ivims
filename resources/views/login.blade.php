<x-layout>
    <x-slot:title>Login</x-slot:title>
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
                                    <img class="w-[300px] block rounded-full" src="{{ asset('images/ic-logo.png')}}" alt="Insurance Commission">
                                    <h2 class="text-center text-2xl font-bold mt-3">Insurance Commision</h2>
                                </div>
                                <x-card class="max-w-md">
                                    <x-card-header>Sign in to your account</x-card-header>
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
                                    <x-forms.form id="login-form" action="/login" method="POST">
                                        <x-forms.input-field name="email" type="email" label="Email" placeholder="name@company.com"
                                            required />
                                        <x-forms.input-field name="password" type="password" label="Password" placeholder="••••••••"
                                            required />
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                                </div>
                                            </div>
                                            <a href="#"
                                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                                                password?</a>
                                        </div>
                                        <x-forms.button type="submit" color="violet">Sign in</x-forms.button>
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
    <x-slot:scripts>
        <script>
            window.onload = function() {
                document.getElementById('login-form').addEventListener('submit', async function(event) {
                    event.preventDefault();

                    let formData = new FormData(event.target);

                    Swal.fire({
                        title: "Logging in...",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 2000,
                    });

                    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    let response = await fetch('/login', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                    });
                    let {
                        status, message
                    } = await response.json();

                    if (status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1000,
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    }
                });
            }
        </script>
    </x-slot>
</x-layout>
