<x-filament::page>
    <div class="space-y-4">
        <h2 class="text-2xl font-bold">User Messages</h2>

        @foreach (\App\Models\ContactMessage::latest()->get() as $message)
            <x-filament::card>
                <div class="flex flex-col space-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="font-semibold text-lg">{{ $message->subject }}</h3>
                        <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    <p><strong>Name:</strong> {{ $message->name }}</p>
                    <p><strong>Email:</strong> <a href="mailto:{{ $message->email }}" class="text-primary-600 hover:underline">{{ $message->email }}</a></p>
                    <div class="prose max-w-none">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>
            </x-filament::card>
        @endforeach
    </div>
</x-filament::page>
