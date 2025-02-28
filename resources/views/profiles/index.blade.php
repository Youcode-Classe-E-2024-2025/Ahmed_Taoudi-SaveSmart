<x-app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-900">Choisissez un profil</h2>
                    <p class="mt-2 text-gray-600">Sélectionnez un profil existant ou ajoutez-en un nouveau.</p>

                    <!-- Liste des profils -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Ajouter un profil -->
                        <div class="bg-green-50 p-6 rounded-lg shadow-sm text-center  hover:bg-green-200 transition-colors">
                            <a href="{{ route('profiles.create') }}" class="block">
                                <div class="flex justify-center">
                                    <svg class="h-16 w-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <p class="mt-4 text-xl font-semibold text-green-600">Ajouter un profil</p>
                            </a>
                        </div>

                        @foreach ($profiles as $profile)
                        <a href="{{ route('profiles.show',$profile) }}" class="block">

                            <div class="bg-gray-50 p-6 rounded-lg shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors profile-item" onclick='openModal(@json($profile))'>
                                <div class="flex justify-center">
                                    @if ($profile->avatar)
                                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="h-20 w-20 rounded-full object-cover border-4 border-green-200">
                                    @else
                                        <div class="h-20 w-20 rounded-full bg-green-300 flex items-center justify-center text-xl text-white">
                                            {{ strtoupper(substr($profile->name, 0, 1)) }} 
                                            {{ strtoupper(substr(explode(' ', $profile->name)[1] ?? '', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <p class="mt-4 text-xl font-semibold text-gray-900">{{ $profile->name }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for PIN Input -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden  justify-center items-center transition-all duration-300">
        <div class="bg-white p-8 rounded-lg shadow-lg w-80">
            <div id="selected-profile" class="mt-6"></div>
            <h3 class="text-xl font-semibold text-gray-900 text-center">Entrez votre PIN</h3>
            <p class="text-sm text-gray-600 text-center mt-2">Pour accéder à ce profil, entrez votre code PIN.</p>

            <div class="mt-6">
                <input type="text" id="pin-input" maxlength="4" class="block w-full text-center text-xl py-2 rounded-md border-gray-300 focus:ring-green-500 focus:border-green-500" placeholder="----" oninput="updatePin()">
            </div>
            <div class="mt-4 flex justify-center space-x-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700" onclick="submitPin()">Valider</button>
                <button class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700" onclick="closeModal()">Annuler</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(profile) {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.querySelector('#selected-profile').innerHTML = `
                <div class="mt-4 text-center">
                    <h3 class="text-green-500 text-2xl font-semibold">${profile.name}</h3>
                </div>
            `;
            console.log("Profile ID: " + profile.id);
        }

        // Close the modal
        function closeModal() {
            const modal = document.getElementById('modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.getElementById('pin-input').value = '';
        }

        // Handle PIN input validation (4 digits)
        function updatePin() {
            const pinInput = document.getElementById('pin-input');
            if (pinInput.value.length === 4) {
                pinInput.classList.add('bg-green-100');
            } else {
                pinInput.classList.remove('bg-green-100');
            }
        }

        function submitPin() {
            const pinInput = document.getElementById('pin-input');

            if (pinInput.value.length === 4) {
                fetch('/profile')
                closeModal();
            } else {
                alert("Veuillez entrer un PIN valide de 4 chiffres.");
            }
        }
    </script>
</x-app>
