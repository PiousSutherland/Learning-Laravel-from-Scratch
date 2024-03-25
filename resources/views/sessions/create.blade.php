<x-layout>
    <section class="px-6 py8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-200 border border-gray-300 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl mb-4">Log in</h1>
            <form action="/sessions" method="post">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Email
                    </label>

                    <input type="email" name="email" id="email" class="border border-gray-400 p-2 w-full" required
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                        Password
                    </label>

                    <input type="password" name="password" id="password" class="border border-gray-400 p-2 w-full"
                        required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                        Log in
                    </button>
                </div>
            </form>
        </main>
    </section>
</x-layout>
