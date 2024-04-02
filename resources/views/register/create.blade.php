<x-layout>
    <section class="px-6 py8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl mb-4">Register</h1>
                <form action="/register" method="post">
                    @csrf

                    <x-form.input name="name" />
                    <x-form.input name="username" />
                    <x-form.input name="email" autocomplete="username" />
                    <x-form.input name="password" type="password" autocomplete="new-password" />

                    <x-form.button>Sign up</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
