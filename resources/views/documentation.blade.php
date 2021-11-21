<x-guest-layout>
    <main class="container py-5 mx-auto">
        <h1 class="py-2 text-4xl font-bold text-center text-white bg-gray-500 border-2 border-gray-500 rounded-md">Documentation</h1>

        <section class="py-5">
            <h2 class="text-2xl font-bold">INPUTS</h2>

            <div class="mt-4">
                <x-label for="name" value="Nom" />

                <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4 bg-gray-200 border-2 border-gray-400 rounded-md">
                <pre><code class="language-html" data-lang="html">
&lt;div class="mt-4"&gt;
    &lt;x-label for="name" value="Nom" /&gt;
    &lt;x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required /&gt;
&lt;/div&gt;
                </code></pre>
            </div>

            <hr class="my-8" />

            <x-button>
                Créer
            </x-button>

            <div class="mt-4 bg-gray-200 border-2 border-gray-400 rounded-md">
                <pre><code class="language-html" data-lang="html">
&lt;x-button&gt;
    Créer
&lt;/x-button&gt;
                </code></pre>
            </div>
        </section>

    </main>
</x-guest-layout>