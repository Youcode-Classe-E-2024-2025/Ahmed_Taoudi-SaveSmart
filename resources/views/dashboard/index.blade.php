<x-dashboard>
            <x-slot:head>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            </x-slot:head>
            <x-slot:script>
                <script>
                    async function fetchIncomeExpenseData() {
                        const response = await fetch('/income-expense-data'); 

                        const data = await response.json(); 
                        return data;
                    }

                    // Initialize chart after fetching data
                    async function initializeIncomeExpenseChart() {
                        const data = await fetchCategoryDataExpense();

                        // Income vs Expense Chart
                        const expenseCtx = document.getElementById('expenseChart').getContext('2d');
                        const categoryChart = new Chart(expenseCtx, {
                            type: 'doughnut',
                            data: {
                                labels: data.labels, 
                                datasets: [{
                                    data: data.expenses,
                                    backgroundColor: data.colors, 
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'right',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const label = context.label || '';
                                                const value = context.raw || 0;
                                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                const percentage = Math.round((value / total) * 100);
                                                return `${label}: ${value} € (${percentage}%)`;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }

                    // Initialize the chart on page load
                    document.addEventListener('DOMContentLoaded', function() {
                        initializeIncomeExpenseChart();
                    });

                    async function fetchCategoryDataIncome() {
                        const response = await fetch('/category-data-income'); 
                        const data = await response.json();
                        return data;
                    }

                    async function fetchCategoryDataExpense() {
                        const response = await fetch('/category-data-expense'); 
                        const data = await response.json();
                        return data;
                    }
            
                    async function initializeCategoryChart() {
                        const data = await fetchCategoryDataIncome();
            
                        // Category Chart
                        const incomeCtx = document.getElementById('incomeChart').getContext('2d');
                        const categoryChart = new Chart(incomeCtx, {
                            type: 'doughnut',
                            data: {
                                labels: data.labels, 
                                datasets: [{
                                    data: data.expenses,
                                    backgroundColor: data.colors, 
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'right',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const label = context.label || '';
                                                const value = context.raw || 0;
                                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                const percentage = Math.round((value / total) * 100);
                                                return `${label}: ${value} € (${percentage}%)`;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
            
                    // Initialize the chart on page load
                    document.addEventListener('DOMContentLoaded', function() {
                        initializeCategoryChart();
                    });
                </script>
            </x-slot:script>
            

            <!-- Main content -->
            <div class="flex flex-col flex-1 overflow-y-auto md:pt-0 pt-16">
                <main class="flex-1 px-4 py-8 md:px-6 lg:px-8">
                       <!-- profile info section -->
                    <div class="bg-white rounded-lg shadow-sm p-6 my-5">
                        <div class="flex items-center justify-start gap-4 ">
                            <div class="bg-primary-100 rounded-full flex items-center justify-center">
                                @if ($profile->avatar)
                                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="h-20 w-20 rounded-full object-cover border-4 border-green-200">
                                @else
                                <div class="h-20 w-20 rounded-full bg-green-300 flex items-center justify-center text-xl text-white">
                                    {{ strtoupper(substr($profile->name, 0, 1)) }} 
                                    {{ strtoupper(substr(explode(' ', $profile->name)[1] ?? '', 0, 1)) }}
                                </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900">{{$profile->name}} </h3>
                            </div>
                            <div class="ml-auto">
                                <a href="{{route('profiles.index')}}" class="text-sm hover:text-primary-700 text-gray-900 ">profiles &rarr; </a>
                            </div>
                        </div>
                        
                        
                    </div>
                    <!-- Financial overview section -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6">
                        <!-- Balance Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Solde Total</p>
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900">5 234,58 €</h3>
                                </div>
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            
                        </div>
    
                        <!-- Income Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Revenus du Mois</p>
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900">{{$stats['income']}} €</h3>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                    </svg>
                                </div>
                            </div>
                            
                        </div>
    
                        <!-- Expenses Card -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Dépenses du Mois</p>
                                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900">{{$stats['expense']}}  €</h3>
                                </div>
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </div>
    
                    <!-- Charts section -->
                    <section class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Graphiques</h2>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Income vs Expenses chart -->
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-sm font-medium text-gray-500 mb-4">Dépenses par Catégorie</h3>
                                <div class="h-64">
                                    <canvas id="expenseChart"></canvas>
                                </div>
                            </div>
    
                            <!-- Category breakdown chart -->
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-sm font-medium text-gray-500 mb-4">Revenus par Catégorie</h3>
                                <div class="h-64">
                                    <canvas id="incomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </section>
    
                    <!-- Savings goals section -->
                    <section>
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">Objectifs d'Épargne</h2>
                            <a href="{{ route('goals.index')}}" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                <i class="fas fa-plus mr-2"></i>plus
                            </a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Savings goal card 1 -->
                            @foreach ($goals as $item)
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{$item->title}}</h3>
                                        <p class="text-sm text-gray-500 mt-1">Échéance: {{ $item->deadline }}</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="font-medium">{{$item->current_amount}}€ / {{$item->target_amount}}€</span>
                                        <span class="font-medium text-primary-600">{{ number_format($item->current_amount / $item->target_amount * 100, 0) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                        <div class="bg-primary-500 h-2.5 rounded-full" style="width: {{$item->current_amount / $item->target_amount*100}}%"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </section>
    
                    <!-- Recent Transactions -->
                    <div class="bg-white rounded-lg shadow-sm">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Transactions Récentes</h3>
                                <a href="/transactions" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                    Voir tout
                                </a>
                            </div>
                            <div class="overflow-x-auto -mx-6 sm:mx-0">
                                <div class="inline-block min-w-full align-middle sm:px-6 lg:px-8">
                                    @if ($transactions->isEmpty()) 
                                    <div  class="min-w-full   text-gray-500"> 
                                        pas de transactions 
                                    </div>
                                    @else
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">By</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($transactions as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    @php
                                                       $transactionDate = \Carbon\Carbon::parse($item->transaction_date);
                                                     @endphp
                                                {{ $transactionDate->isoFormat('DD MMM YYYY') }} 
                                                ( {{ $transactionDate->diffForHumans() }} )
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$item->description}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$item->profile->name}}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->category->name }}</td>
                                                @if ($item->type == 'income')
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600 text-right">+{{$item->amount}} €</td>
                                                @else
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium  text-red-600 text-right">-{{$item->amount}} €</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
    
                <!-- Footer -->
                <footer class="bg-white border-t border-gray-200 py-4 px-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="text-sm text-gray-500">
                            &copy; 2023 SaveSmart. Tous droits réservés.
                        </div>
                        <div class="mt-4 md:mt-0">
                            <ul class="flex space-x-4 text-sm text-gray-500">
                                <li><a href="#" class="hover:text-primary-600">Support</a></li>
                                <li><a href="#" class="hover:text-primary-600">Conditions d'utilisation</a></li>
                                <li><a href="#" class="hover:text-primary-600">Politique de confidentialité</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-gray-400">
                        Version 1.0.0
                    </div>
                </footer>
            </div>
</x-dashboard>