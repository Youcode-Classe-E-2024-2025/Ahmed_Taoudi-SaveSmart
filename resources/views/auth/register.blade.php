<x-app>
    <x-slot:title>Register</x-slot:title>

    <section class="my-20">
        <div class="max-w-md mx-auto p-4 bg-white rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6 text-center">Welcome to SaveSmart</h1>
            <form action="/register" method="post" class="space-y-6">
                @csrf
                <h2 class="text-lg font-semibold mb-2">Profile Information</h2>
               <div class="grid grid-cols-2 gap-4">
                    <!-- Full Name -->
                    <div>
                        <label for="user_name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                        <input 
                            type="text" 
                            name="user_name" 
                            id="user_name" 
                            value="{{ old('user_name') }}" 
                            placeholder="Enter your full name" 
                            class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            aria-label="Enter your full name"
                            required
                        >
                        @error('user_name') 
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="pin" class="block text-gray-700 font-medium mb-2">Profile PIN</label>
                        <input 
                            type="text" 
                            name="pin" 
                            id="pin" 
                            maxlength="4" 
                            pattern="\d*" 
                            inputmode="numeric" 
                            placeholder="• • • •" 
                            class="w-full appearance-none bg-transparent border-b-2 border-green-300 focus:border-green-500 outline-none text-center text-2xl font-bold tracking-widest"
                            aria-label="Enter your 4-digit PIN"
                            required
                            oninput="formatPIN(this)"
                        >
                        @error('pin') 
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <script>
                        // JavaScript to format the PIN input
                        function formatPIN(input) {
                            const value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
                            if (value.length > 4) {
                                input.value = value.slice(0, 4); // Limit to 4 digits
                            }
                        }
                    </script>
               </div>

               <h2 class="text-lg font-semibold mb-2">Family Account Information</h2>
                <!-- Family Account Name -->
                <div>
                    <label for="family_account" class="block text-gray-700 font-medium mb-2">Family Account Name</label>
                    <input 
                        type="text" 
                        name="family_account" 
                        id="family_account" 
                        value="{{ old('family_account') }}" 
                        placeholder="Enter your family account name" 
                        class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        aria-label="Enter your family account name"
                        required
                    >
                    @error('family_account') 
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}" 
                        placeholder="Enter your email address" 
                        class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        aria-label="Enter your email address"
                        required
                    >
                    @error('email') 
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Create a strong password" 
                        class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        aria-label="Create a strong password"
                        required
                    >
                    @error('password') 
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        placeholder="Re-enter your password" 
                        class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        aria-label="Re-enter your password"
                        required
                    >
                    @error('password_confirmation') 
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto py-3 px-6 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition duration-300"
                    >
                        Sign Up
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app>