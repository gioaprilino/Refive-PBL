<div>
    <p><strong>Nama:</strong> {{ $message->name }}</p>
    <p><strong>Email:</strong> {{ $message->email }}</p>
    <p><strong>Subjek:</strong> {{ $message->subject }}</p>
    <p><strong>Pesan:</strong></p>
    <div class="p-4 bg-gray-100 rounded-lg">
        {{ $message->message }}
    </div>
</div>
