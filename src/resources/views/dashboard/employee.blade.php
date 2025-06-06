<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-blue-700 leading-tight">
                Dashboard Pengguna
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg border border-blue-100">
                <div class="p-6 bg-white">
                    <div class="text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">Halo, {{ auth()->user()->name }}! 👋</h3>
                        <p class="mb-4">Ini adalah halaman dashboard kamu sebagai pengguna biasa.</p>
                        <div class="mt-6 border-t border-blue-100 pt-4">
                            <a href="{{ route('profile.edit') }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition duration-200">
                                Update Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>