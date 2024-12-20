<x-layout>
    <x-slot:title>Announcement</x-slot:title>
    <x-slot:head>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            html, body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="max-w-screen-2xl mx-auto flex">
            <x-sidebar activeSub="Announcement" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/dashboard/announcement',
                                'title' => 'Announcement',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Edit',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="flex space-x-3 min-h-screen">
                        <div class="w-3/5 pb-6 pt-2">
                            <div class="max-w-xl">
                                @if (session('message'))
                                    <x-alerts.success id="alert-announcements">
                                        {{ session('message') }}
                                    </x-alerts.success>
                                @endif
                            </div>
                            <x-card class="max-w-xl">
                                <x-card-header>Edit Announcement</x-card-header>
                                <x-forms.form method="POST" action="/dashboard/announcement/{{ $announcement->id }}" verb="PATCH">
                                    <div class="flex space-x-2">
                                        @php
                                        if($errors->has('color')) {
                                            $color = old('color');
                                        } else {
                                            $color = (old('color')) ? old('color') : $announcement->color;
                                        }
                                        @endphp
                                        <x-forms.select-field class="w-full"
                                            name="color"
                                            label="Color"
                                            placeholder="--"
                                            required>
                                            <option {{ ($color=='gray') ? 'selected' : ''}} value="gray">GRAY</option>
                                            <option {{ ($color=='red') ? 'selected' : ''}} value="red">RED</option>
                                            <option {{ ($color=='yellow') ? 'selected' : ''}} value="yellow">YELLOW</option>
                                            <option {{ ($color=='green') ? 'selected' : ''}} value="green">GREEN</option>
                                            <option {{ ($color=='blue') ? 'selected' : ''}} value="blue">BLUE</option>
                                            <option {{ ($color=='indigo') ? 'selected' : ''}} value="indigo">INDIGO</option>
                                            <option {{ ($color=='purple') ? 'selected' : ''}} value="purple">PURPLE</option>
                                            <option {{ ($color=='pink') ? 'selected' : ''}} value="pink">PINK</option>
                                        </x-forms.select-field>
                                        @php
                                        if($errors->has('status')) {
                                            $status = old('status');
                                        } else {
                                            $status = (old('status')) ? old('status') : $announcement->status;
                                        }
                                        @endphp
                                        <x-forms.select-field class="w-full"
                                            name="status"
                                            label="Status"
                                            placeholder="--"
                                            required>
                                            <option {{ ($status=='visible') ? 'selected' : ''}} value="visible">VISIBLE</option>
                                            <option {{ ($status=='not visible') ? 'selected' : ''}} value="not visible">NOT VISIBLE</option>
                                        </x-forms.select-field>
                                    </div>
                                    @php
                                    if($errors->has('title')) {
                                        $title = old('title');
                                    } else {
                                        $title = (old('title')) ? old('title') : $announcement->title;
                                    }
                                    @endphp
                                    <x-forms.input-field class="w-full"
                                        name="title"
                                        type="text"
                                        label="Title"
                                        placeholder="--"
                                        value="{{ $title }}"
                                        required
                                    />
                                    @php
                                    if($errors->has('content')) {
                                        $content = old('content');
                                    } else {
                                        $content = (old('content')) ? old('content') : $announcement->content;
                                    }
                                    @endphp
                                    <x-forms.textarea-field
                                        name="content"
                                        label="Content of Announcement"
                                        placeholder="--"
                                        rows="5"
                                        value="{{ $content }}"
                                        required
                                    />
                                    <hr class="my-1">
                                    <div class="flex space-x-2 justify-end">
                                        <span class="inline-block w-32">
                                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                                        </span>
                                        <a href="/dashboard/announcement"
                                            class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                                            Back
                                        </a>
                                    </div>
                                </x-forms.form>
                            </x-card>
                        </div>
                        <div class="w-2/5 pb-6 pt-2">
                            <section class="bg-violet-500 text-white p-8 rounded-lg">
                                <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES:</h2>
                                <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                                    <li>
                                        Kindly fill-out all of the required fields.
                                    </li>
                                </ul>
                            </section>
                        </div>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
</x-layout>
