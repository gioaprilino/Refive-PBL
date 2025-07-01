<div class="container mx-auto">
    <div class="bg-white p-6 rounded-lg mt-3 shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Informasi Pegawai -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Informasi Pegawai</h2>
                <div class="bg-gray-100 p-4 rounded-lg space-y-2">
                    <p><strong>Nama Pegawai :</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Kantor :</strong> {{ $schedule->office->name }}</p>
                    <p><strong>Shift :</strong> {{ $schedule->shift->name }} ({{ $schedule->shift->start_time }} - {{ $schedule->shift->end_time }}) WIB</p>

                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <div class="bg-white border rounded-lg text-center py-2">
                            <p class="text-gray-500 text-sm">Waktu Datang</p>
                            <p class="text-lg font-semibold">
                                @if ($attendance?->start_time)
                                    {{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i:s') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="bg-white border rounded-lg text-center py-2">
                            <p class="text-gray-500 text-sm">Waktu Pulang</p>
                            <p class="text-lg font-semibold">
                                @if ($attendance?->end_time)
                                    {{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i:s') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Status Lokasi -->
                    <p class="mt-3"><strong>Status Lokasi: </strong>
                        <span id="locationStatus" class="font-bold text-gray-600">Belum ditandai</span>
                    </p>

                    <!-- Hidden inputs untuk koordinat -->
                    <input type="hidden" wire:model="latitude" id="latField">
                    <input type="hidden" wire:model="longitude" id="lngField">
                    <input type="hidden" wire:model="status" id="statusField">
                </div>
            </div>

            <!-- Presensi & Map -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Presensi</h2>
                <div id="map" class="mb-4 rounded-lg border border-gray-300 w-full h-[400px]"></div>

                <div class="flex gap-4">
                    <button type="button" onclick="tagLocation()" class="flex-1 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                        Tag Location
                    </button>
                    <button wire:click="submitPresensi" type="button" id="submitBtn" class="flex-1 px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition" disabled>
                        Submit Presensi
                    </button>
                </div>

                @if (session()->has('success'))
                    <div class="mt-4 text-green-600 font-bold">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([{{$schedule->office->latitude}}, {{$schedule->office->longitude}}], 18.5);
    L.tileLayer('https://tile.openstreetmap.de/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    const office = [{{$schedule->office->latitude}}, {{$schedule->office->longitude}}];
    const radius = {{$schedule->office->radius}};
    let marker;
    L.circle(office, {radius: radius, color: 'red', fillColor: "#f03", fillOpacity: 0.5}).addTo(map);

    function tagLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                if (marker) map.removeLayer(marker);
                marker = L.marker([latitude, longitude]).addTo(map);
                map.setView([latitude, longitude], 18.5);

                const isInside = isWithinRadius(latitude, longitude, office, radius);

                document.getElementById('locationStatus').innerText = isInside ? 'Dalam Jangkauan' : 'Di Luar Jangkauan';
                document.getElementById('locationStatus').className = isInside ? 'font-bold text-green-600' : 'font-bold text-red-600';

                document.getElementById('latField').value = latitude;
                document.getElementById('lngField').value = longitude;
                document.getElementById('statusField').value = isInside ? 'dalam' : 'luar';

                document.getElementById('latField').dispatchEvent(new Event('input'));
                document.getElementById('lngField').dispatchEvent(new Event('input'));
                document.getElementById('statusField').dispatchEvent(new Event('input'));

                document.getElementById('submitBtn').disabled = !isInside;
            });
        }
    }

    function isWithinRadius(latitude, longitude, center, radius) {
        let distance = map.distance([latitude, longitude], center);
        return distance <= radius;
    }
</script>