<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-blue-700 leading-tight">
                Dashboard HRD
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg border border-blue-100">
                <div class="p-6 bg-white">
                    <div class="text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Selamat datang, HRD!</h3>
                        <p class="mb-6">Ini adalah panel HRD. Anda bisa mengelola pengguna, melihat statistik, dll.</p>
                        <a href="{{ route('departments.index') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition duration-200">
                            Manajemen Departemen
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>