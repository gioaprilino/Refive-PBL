<x-filament::page>
    <div class="space-y-6">
        <h2 class="text-2xl font-bold">User Messages</h2>

        @php
            $messages = \App\Models\ContactMessage::latest()->paginate(6);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($messages as $message)
                <x-filament::card class="h-full">
                    <div class="flex flex-col h-full justify-between space-y-4">
                        <div>
                            <div class="flex justify-between items-start">
                                <h3 class="font-semibold text-lg text-primary-700">{{ $message->subject }}</h3>
                                <span class="text-xs text-gray-500 whitespace-nowrap">{{ $message->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="mt-2 text-sm text-gray-600">
                                <p><strong>Name:</strong> {{ $message->name }}</p>
                                <p><strong>Email:</strong>
                                    <a href="mailto:{{ $message->email }}" class="text-primary-600 hover:underline">{{ $message->email }}</a>
                                </p>
                            </div>

                            <div class="mt-3 prose max-w-none text-sm">
                                {!! nl2br(e(Str::limit($message->message, 200))) !!}
                            </div>
                        </div>

                        <div class="pt-4 border-t text-right">
                            <a href="mailto:{{ $message->email }}" class="text-sm text-primary-700 font-medium hover:underline">
                                Reply Email →
                            </a>
                        </div>
                    </div>
                </x-filament::card>
            @endforeach
        </div>

        <div>
            <div class="mt-6 flex justify-center">
    {{ $messages->links('vendor.pagination.tailwind-custom') }}
</div>
        </div>
    </div>
</x-filament::page>
