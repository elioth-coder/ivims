@props(['ticket'])

<form id="chat-form" method="POST">
    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
    <input type="file" name="file" class="hidden" id="file">
    <div class="flex">
        <button id="dropdown-button" data-dropdown-toggle="dropdown"
            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300"
            type="button">Attach <svg class="w-2.5 h-2.5 ms-2.5"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <div id="dropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <ul class="py-2 text-sm text-gray-700"
                aria-labelledby="dropdown-button">
                <li>
                    <span onclick="document.getElementById('file').click();" class="block px-4 py-2 hover:bg-gray-100">File</span>
                </li>
                <li>
                    <span onclick="document.getElementById('file').click();" class="block px-4 py-2 hover:bg-gray-100">Image</span>
                </li>
            </ul>
        </div>
        <div class="relative w-full">
            <input type="text" name="message" id="message"
                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg rounded-s-gray-100 rounded-s-2 border border-gray-300 focus:ring-violet-500 focus:border-violet-500"
                placeholder="Type message here..." required />
            <button type="submit" title="Send"
                class="absolute top-0 end-0 p-2.5 px-5 h-full text-sm font-medium text-white bg-violet-700 rounded-e-lg border border-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
    </div>
</form>
