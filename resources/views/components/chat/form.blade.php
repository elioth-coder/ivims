@props(['ticket'])

<form id="chat-form" method="POST" enctype="multipart/form-data" class="overflow-visible">
    <section title="Attached file" id="file_label" class="hidden shadow rounded-xl p-2 items-center justify-center absolute h-12 w-auto border bg-violet-700 -top-12 text-white"></section>
    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
    <input type="file" name="file" class="hidden" id="file">
    <div class="flex">
        <button onclick="document.getElementById('file').click();"
            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300"
            type="button">
            Attach File
            <i class="bi bi-paperclip"></i>
        </button>
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

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', (e) => {
            let $file = document.getElementById('file');
            let $file_label = document.getElementById('file_label');

            $file.onchange = (e) => {
                let files = e.target.files;

                if(files.length) {
                    let uploaded_file = files[0];

                    $file_label.innerHTML = `<i class="bi bi-file-earmark me-1 text-xl"></i> ${uploaded_file.name}`;
                    $file_label.classList.remove("hidden");
                    $file_label.classList.add("flex");
                } else {
                    $file_label.innerHTML = "";
                    $file_label.classList.remove("flex");
                    $file_label.classList.add("hidden");
                }
            }
        });
    </script>
</form>
