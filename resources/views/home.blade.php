<x-app>
    <x-slot:title>Home</x-slot:title>
 <!-- Header/Navigation -->
 {{-- <header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="#" class="flex items-center">
                    <svg class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ml-2 text-xl font-bold text-gray-900">SaveSmart</span>
                </a>
            </div>
            
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="#features" class="text-gray-600 hover:text-gray-900">Fonctionnalités</a>
                <a href="#pricing" class="text-gray-600 hover:text-gray-900">Tarifs</a>
                <a href="#testimonials" class="text-gray-600 hover:text-gray-900">Témoignages</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Contact</a>
                <a href="/login" class="text-primary-600 hover:text-primary-700 font-medium">Connexion</a>
                <a href="/register" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                    Commencer
                </a>
            </div>
            
            <div class="flex items-center sm:hidden">
                <button type="button" class="text-gray-600 hover:text-gray-900">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header> --}}

<!-- Hero Section -->
<section class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="sm:text-center lg:text-left">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Gérez vos finances</span>
                        <span class="block text-primary-600">intelligemment</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Prenez le contrôle de vos finances personnelles avec SaveSmart. Suivez vos dépenses, fixez des objectifs d'épargne et atteignez la liberté financière.
                    </p>
                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="/register" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 md:py-4 md:text-lg md:px-10">
                                Commencer gratuitement
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200 md:py-4 md:text-lg md:px-10">
                                Voir la démo
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        {{-- <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="/placeholder.svg?height=600&width=800" alt="Dashboard preview"> --}}
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Tout ce dont vous avez besoin pour gérer vos finances
            </h2>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Des outils puissants et intuitifs pour vous aider à atteindre vos objectifs financiers.
            </p>
        </div>

        <div class="mt-20">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="bg-primary-100 rounded-lg p-3 inline-block">
                        <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Suivi des dépenses</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Visualisez vos dépenses par catégorie et suivez votre budget en temps réel.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="bg-primary-100 rounded-lg p-3 inline-block">
                        <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Objectifs d'épargne</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Définissez des objectifs et suivez votre progression vers vos rêves financiers.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="bg-primary-100 rounded-lg p-3 inline-block">
                        <svg class="h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Rapports détaillés</h3>
                    <p class="mt-2 text-base text-gray-500">
                        Générez des rapports personnalisés pour mieux comprendre vos habitudes financières.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CTA Section -->
<section class="bg-primary-700">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
            <span class="block">Prêt à commencer ?</span>
            <span class="block text-primary-200">Créez votre compte gratuitement aujourd'hui.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50">
                    Commencer
                </a>
            </div>
            <div class="ml-3 inline-flex rounded-md shadow">
                <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                    En savoir plus
                </a>
            </div>
        </div>
    </div>
</section>

</x-app>

