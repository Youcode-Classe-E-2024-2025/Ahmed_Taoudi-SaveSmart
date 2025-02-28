        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-white text-primary-600">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-primary-700">SaveSmart</h1>
                    <p class="text-sm text-gray-500">Gestion financière</p>
                </div>
                <div class="flex flex-col flex-1 overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 space-y-1">
                        <a href="{{  route('profiles.show',Auth::user()) }}" class="flex items-center px-4 py-3  bg-primary-50 text-primary-700 rounded-md">
                            <i class="fas fa-home mr-3"></i>
                            <span>Tableau de Bord</span>
                        </a>
                        <a href="{{route('transactions.index')}}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-exchange-alt mr-3"></i>
                            <span>Transactions</span>
                        </a>
                        <a href="{{route('categories.index')}}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-tags mr-3"></i>
                            <span>Catégories</span>
                        </a>
                        <a href="{{route('goals.index')}}" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-piggy-bank mr-3"></i>
                            <span>Objectifs d'Épargne</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-chart-bar mr-3"></i>
                            <span>Rapports</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Paramètres</span>
                        </a>
                    </nav>
                    <div class="p-4 ">
                        <a href="/logout" class="flex items-center px-4 py-3 text-gray-600 hover:text-primary-500 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Déconnexion</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden fixed top-0 left-0 z-50 w-full text-primary-600 flex items-center justify-between p-4">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-primary-700">SaveSmart</h1>
                {{-- <p class="text-sm text-gray-500">Gestion financière</p> --}}
            </div>
            <button id="mobile-menu-button" class="text-primary-900 focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden fixed inset-0 z-40 bg-white transform -translate-x-full transition-transform duration-300 ease-in-out">
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between p-4 ">
                    <div class="p-6">
                        <h1 class="text-2xl font-bold text-primary-700">SaveSmart</h1>
                    </div>
                    <button id="close-mobile-menu" class="text-white focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
                    <a href="#" class="flex items-center px-4 py-3  bg-primary-50 text-primary-700 rounded-md">
                        <i class="fas fa-home mr-3"></i>
                        <span>Tableau de Bord</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-exchange-alt mr-3"></i>
                        <span>Transactions</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-tags mr-3"></i>
                        <span>Catégories</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-piggy-bank mr-3"></i>
                        <span>Objectifs d'Épargne</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-chart-bar mr-3"></i>
                        <span>Rapports</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-cog mr-3"></i>
                        <span>Paramètres</span>
                    </a>
                </nav>
                <div class="p-4">
                    <a href="/logout" class="flex items-center  px-4 py-3 text-gray-600 hover:text-primary-500 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Déconnexion</span>
                    </a>
                </div>
            </div>
        </div>
