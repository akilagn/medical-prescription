<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <h1 class="text-black text-lg font-bold">Add Prescription</h1>
        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('prescriptions.store') }}" enctype="multipart/form-data">
                @csrf
            
                <div class="mt-4">
                    <x-input-label for="delivery_address" :value="__('Delivery Address')" />
                    <x-text-input id="delivery_address" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="delivery_address" autofocus />

                    <x-input-error :messages="$errors->get('delivery_address')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="note" :value="__('Note')" />
                    <x-text_area placeholder="Add note" name="note" id="note" value="" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                    <x-input-error :messages="$errors->get('note')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <div class="relative border-dashed border-2 border-gray-300 bg-gray-100 p-4 rounded-md">
                        <div class="text-center">
                            <span class="text-gray-600">Add Images(upto 5)</span>
                            <input type="file" name="attachment[]" id="attachment" multiple onchange="previewImages(event)" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer" />
                            <span class="text-blue-500 hover:underline">browse</span> to upload
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

             
                <div id="image-preview" class="mt-4 flex flex-wrap justify-start"></div>

                <div class="flex items-center justify-center mt-4">
                    <x-primary-button class="ml-3 transition duration-300 ease-in-out bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Add Prescription
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImages(event) {
            var previewContainer = document.getElementById('image-preview');
            var files = event.target.files;
            
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px'; 
                    img.style.marginRight = '10px'; 
                    img.style.marginBottom = '10px'; 
                    previewContainer.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        }

  
        var dropArea = document.getElementById('attachment');

        dropArea.addEventListener('dragover', function (event) {
            event.preventDefault();
            dropArea.classList.add('border-blue-500');
        });

        dropArea.addEventListener('dragleave', function (event) {
            event.preventDefault();
            dropArea.classList.remove('border-blue-500');
        });

        dropArea.addEventListener('drop', function (event) {
            event.preventDefault();
            dropArea.classList.remove('border-blue-500');
            var files = event.dataTransfer.files;
            previewImages({ target: { files: files } });
        });
    </script>
</x-app-layout>
