<x-app>
    
    <x-slot:title>Login</x-slot:title>
    
        <section class="my-20">
            <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-lg">
                <form action="/login" method="post" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email"  class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"  placeholder="Enter your email" class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    @error('email')
                      <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                     @enderror
                    <div>
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password" class="w-full p-3 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                     @error('password')
                       <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                      @enderror

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="form-checkbox">
                        <label for="remember" class="ml-2 text-gray-700">Remember me</label>
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            Login
                        </button>
                    </div>
            
                    <div class="text-center">
                        <a href="/forgot-password" class="text-green-600 hover:text-green-700 text-sm">Forgot your password?</a>
                    </div>
                </form>
            </div>
            
        </section>

</x-app>
