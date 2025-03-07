<x-dashboard>
    <x-slot:head>
    </x-slot:head>

    <x-slot:script>
        <script>
                    
        function openEditModal(transactionId) {
            
            fetch(`/transactions/${transactionId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-transaction-date').value = data.transaction_date;
                    document.getElementById('edit-transaction-description').value = data.description;
                    document.getElementById('edit-transaction-amount').value = data.amount;
                    document.getElementById('edit-transaction-type').value = data.type;
                    document.getElementById('edit-transaction-category').value = data.category_id;

                    // action 
                    const formAction = document.getElementById('editTransactionForm').action.replace(':transaction_id', transactionId);
                    document.getElementById('editTransactionForm').action = formAction;

                    document.getElementById('editTransactionModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching transaction data:', error);
                });
        }

        function openAddModal() {
            const errorMessages = document.querySelectorAll('#addTransactionModal .text-red-500');
            errorMessages.forEach(error => error.innerHTML = '');
            document.getElementById('addTransactionModal').classList.remove('hidden');
        }

        function openDeleteModal(transactionId) {
            const formAction = document.getElementById('deleteTransactionForm').action.replace(':transaction_id', transactionId);
            document.getElementById('deleteTransactionForm').action = formAction;

            document.getElementById('deleteConfirmationModal').classList.remove('hidden');
        }
        </script>
        
    </x-slot:script>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
            <div class="h-16 md:h-0"></div>
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Transactions</h1>
                        <p class="text-gray-500">Gérez vos transactions et suivez vos dépenses</p>
                    </div>
                    
                    <div class="mt-4 md:mt-0">
                        <button onclick="openAddModal()" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Nouvelle Transaction
                        </button>
                    </div>
                </div>

                <div class="inline-block min-w-full align-middle ">
                    @if ($profile->transactions->isEmpty()) 
                    <div  class="min-w-full  bg-white p-10 rounded-sm  text-gray-500 text-center"> 
                        pas de transactions 
                    </div>
                    @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($profile->transactions as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$item->transaction_date}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$item->description}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->category->name }}</td>
                                @if ($item->type == 'income')
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600 text-right">+{{$item->amount}} €</td>
                                @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  text-red-600 text-right">-{{$item->amount}} €</td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="text-right text-sm font-medium space-x-2">
                                        <button  onclick="openEditModal({{ $item->id }})" class="text-primary-600 hover:text-primary-900">Modifier</button>
                                        <button onclick="openDeleteModal({{ $item->id }})"class="text-red-600 hover:text-red-900">Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                
            </div>
        </main>


    <!-- Add Transaction Modal -->
    <div id="addTransactionModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center @if($errors->any() && !request()->has('edit')) block @else hidden @endif">

        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900">Nouvelle Transaction</h2>
                <button onclick="this.closest('#addTransactionModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('transactions.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="transaction-date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="transaction_date" id="transaction-date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('transaction_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div>
                        <label for="transaction-description" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" name="description" id="transaction-description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div>
                        <label for="transaction-amount" class="block text-sm font-medium text-gray-700">Montant</label>
                        <input type="number" name="amount" id="transaction-amount" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('amount')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div>
                        <label for="transaction-type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select id="transaction-type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="expense">Dépense</option>
                            <option value="income">Revenu</option>
                        </select>
                        @error('type')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div>
                        <label for="transaction-category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select id="transaction-category" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            @foreach (Auth::user()->categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="this.closest('#addTransactionModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Ajouter
                    </button>
                </div>
            </form>
            
        </div>
    </div>

    <!-- Edit Transaction Modal -->
    <div id="editTransactionModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center @if($errors->any() && request()->has('edit')) block @else hidden @endif">
        <div class="bg-white rounded-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-900">Modifier la Transaction</h2>
                <button onclick="this.closest('#editTransactionModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="editTransactionForm" method="POST" action="{{ route('transactions.update', ['transaction' => ':transaction_id']) }}"> 
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit-transaction-date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" id="edit-transaction-date" name="transaction_date"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="edit-transaction-description" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" id="edit-transaction-description" name="description"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="edit-transaction-amount" class="block text-sm font-medium text-gray-700">Montant</label>
                        <input type="number" id="edit-transaction-amount" name="amount" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        @error('amount')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="edit-transaction-type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select id="edit-transaction-type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="expense">Dépense</option>
                            <option value="income" selected>Revenu</option>
                        </select>
                        @error('type')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="edit-transaction-category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select id="edit-transaction-category" name="category_id"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            @foreach (Auth::user()->categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                           @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="this.closest('#editTransactionModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmationModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 max-w-sm w-full">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900">Supprimer la transaction</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Êtes-vous sûr de vouloir supprimer cette transaction ? Cette action ne peut pas être annulée.
                        </p>
                    </div>
                </div>
            </div>
            <form id="deleteTransactionForm" method="POST" action="{{ route('transactions.destroy', ['transaction' => ':transaction_id']) }}"> 
                @csrf
                @method('DELETE')
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="this.closest('#deleteConfirmationModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
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