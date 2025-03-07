<x-dashboard>

    <x-slot:head>

    </x-slot:head>

    <x-slot:script>
        <script>
            function openAddModal() {
                const errorMessages = document.querySelectorAll('#addGoalModal .text-red-500');
                errorMessages.forEach(error => error.innerHTML = '');
                document.getElementById('addGoalModal').classList.remove('hidden');
            }
            function openEditModal(goalId) {
            
            fetch(`/goals/${goalId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-goal-name').value = data.title;
                    document.getElementById('edit-goal-amount').value = data.target_amount;
                    document.getElementById('edit-goal-current').value = data.current_amount;
                    document.getElementById('edit-goal-date').value = data.deadline;

                    // action 
                    const formAction = document.getElementById('editGoalForm').action.replace(':goal_id', goalId);
                    document.getElementById('editGoalForm').action = formAction;
                    document.getElementById('editGoalModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching Goal data:', error);
                });
        }

        function openDeleteModal(goalId) {
            const formAction = document.getElementById('deleteGoalForm').action.replace(':goal_id', goalId);
            document.getElementById('deleteGoalForm').action = formAction;

            document.getElementById('deleteGoalModal').classList.remove('hidden');
        }
        </script>
    </x-slot:script>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Objectifs d'Épargne</h1>
                        <p class="text-gray-500">Suivez vos objectifs et votre progression</p>
                    </div>
                    
                    <div class="mt-4 md:mt-0">
                        <button onclick="openAddModal()" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Nouvel Objectif
                        </button>
                    </div>
                </div>

                <!-- Savings Goals Grid -->
                @if ($goals->isEmpty())
                <div  class="min-w-full  bg-white p-10 rounded-sm  text-gray-500 text-center"> 
                    pas de Objectifs d'Épargne 
                </div>
                @else
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($goals as $item)
                        <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $item->title }}</h3>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="openEditModal({{$item->id}})" class="text-gray-400 hover:text-primary-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button onclick="openDeleteModal({{$item->id}})" class="text-gray-400 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Progression</span>
                                <span class="font-medium">{{$item->current_amount}}€ / {{$item->target_amount}}€</span>
                            </div>
                            <div class="flex gap-2  items-center">
                                <div class="relative w-11/12 h-2 bg-gray-200 rounded">
                                    <div class="absolute top-0 left-0 h-full bg-primary-500 rounded" style="width: {{$item->current_amount / $item->target_amount*100}}%"></div>
    
                                </div>
                                <div class="text-gray-600 text-xs">{{ number_format($item->current_amount / $item->target_amount * 100, 0) }}%</div>

                            </div>
                            @if ($item->deadline)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Date limite</span>
                                <span class="font-medium">{{$item->deadline}}</span>
                            </div>
                            @endif
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Reste à épargner</span>
                                <span class="font-medium text-primary-600">{{ $item->target_amount - $item->current_amount}}€</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </main>


    <!-- Add Goal Modal -->
    <div id="addGoalModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center @if($errors->any() && !request()->has('edit')) block @else hidden @endif">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900">Nouvel Objectif d'Épargne</h2>
                <button onclick="this.closest('#addGoalModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('goals.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="goal-name" class="block text-sm font-medium text-gray-700">Nom de l'objectif</label>
                        <input type="text" id="goal-name" name="title"  value="{{old('title')}}"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('title')
                             <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="goal-amount" class="block text-sm font-medium text-gray-700">Montant cible</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                            <input type="number" id="goal-amount" value="{{old('target_amount')}}" name="target_amount" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            @error('target_amount')
                               <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="goal-date" class="block text-sm font-medium text-gray-700">Date limite</label>
                        <input type="date" id="goal-date" name="deadline" value="{{old('deadline')}}"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('deadline')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                         @enderror
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="this.closest('#addGoalModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Créer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Goal Modal -->
    <div id="editGoalModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center @if($errors->any() && request()->has('edit')) block @else hidden @endif">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900">Modifier l'Objectif</h2>
                <button onclick="this.closest('#editGoalModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="editGoalForm" method="POST" action="{{ route('goals.update', ['goal' => ':goal_id']) }}"> 
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit-goal-name" class="block text-sm font-medium text-gray-700">Nom de l'objectif</label>
                        <input type="text" id="edit-goal-name" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('title')
                             <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="edit-goal-amount" class="block text-sm font-medium text-gray-700">Montant cible</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                            <input type="number" id="edit-goal-amount" name="target_amount" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>
                    </div>
                    <div>
                        <label for="edit-goal-current" class="block text-sm font-medium text-gray-700">Montant actuel</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                            <input type="number" id="edit-goal-current" name="current_amount" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        </div>
                    </div>
                    <div>
                        <label for="edit-goal-date" class="block text-sm font-medium text-gray-700">Date limite</label>
                        <input type="date" id="edit-goal-date" name="deadline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('deadline')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="this.closest('#editGoalModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Goal Modal -->
    <div id="deleteGoalModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900">Supprimer l'objectif</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Êtes-vous sûr de vouloir supprimer cet objectif ? Cette action ne peut pas être annulée.
                        </p>
                    </div>
                </div>
            </div>
            <form id="deleteGoalForm" method="POST" action="{{ route('goals.destroy', ['goal' => ':goal_id']) }}"> 
                @csrf
                @method('DELETE')
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="this.closest('#deleteGoalModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Supprimer
                </button>
            </div>
        </form>
        </div>
    </div>

    <!-- Success Notification -->
    <div id="successNotification" class="fixed bottom-4 right-4 bg-green-50 p-4 rounded-md shadow-lg hidden">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    Opération réussie
                </p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button onclick="this.closest('#successNotification').classList.add('hidden')" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span class="sr-only">Fermer</span>
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</x-dashboard>