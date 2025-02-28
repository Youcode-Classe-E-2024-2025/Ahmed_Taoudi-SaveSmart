<x-app>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-8 bg-white border-b border-gray-200">
                    <h2 class="text-3xl font-semibold text-gray-900">Créer un nouveau profil</h2>
                    <p class="mt-2 text-gray-600">Remplissez les informations pour créer un nouveau profil.</p>

                    <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
                        @csrf
                        <div class="space-y-6">
                            <!-- Nom du profil -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom du profil</label>
                                <input type="text" name="name" id="name" value="{{old('name')}}" required class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                 @error('name') 
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                 @enderror
                            </div>

                            <!-- PIN Code -->
                            <div>
                                <label for="pin" class="block text-sm font-medium text-gray-700">Code PIN (4 chiffres)</label>
                                <input type="text" name="pin" id="pin" maxlength="4" required class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-center" placeholder="----" oninput="validatePin()">
                                @error('pin') 
                                   <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Avatar (optionnel) -->
                            <div>
                                <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar (optionnel)</label>
                                <input type="file" name="avatar" id="avatar" class="mt-1 block w-full text-sm text-gray-700 file:py-2 file:px-4 file:mr-4 file:rounded-full file:border-0 file:bg-green-600 file:text-white hover:file:bg-green-700 focus:ring-green-500 focus:border-green-500 transition duration-200" onchange="previewImage(event)">
                            </div>

                            <!-- Image Preview -->
                            <div class="mt-4" id="image-preview-container" style="display: none;">
                                <img id="image-preview" src="#" alt="Image Preview" class="h-32 w-32 rounded-full object-cover border-4 border-gray-200 shadow-md transition-all duration-300 transform hover:scale-105">
                            </div>


                            <!-- Bouton de soumission -->
                            <div>
                                <button type="submit" class="inline-flex justify-center px-6 py-3 bg-green-600 text-white text-lg rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105">
                                    Créer le profil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function previewImage(event) {
            const file = event.target.files[0]; 
            const preview = document.getElementById('image-preview');
            const previewContainer = document.getElementById('image-preview-container');
            
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block'; 
                };

                reader.readAsDataURL(file); 
            } else {
                previewContainer.style.display = 'none'; 
            }
        }

        function validatePin() {
            const pinInput = document.getElementById('pin');
            const pin = pinInput.value;

            if (pin.length === 4) {
                pinInput.classList.remove('border-red-500');
                pinInput.classList.add('border-green-500');
            } else {
                pinInput.classList.remove('border-green-500');
                pinInput.classList.add('border-red-500');
            }
        }
    </script>
</x-app>
