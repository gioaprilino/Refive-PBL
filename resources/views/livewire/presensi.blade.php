<main>
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

                    <!-- DEBUG INFO - Tambahkan ini untuk debug -->
                    <div class="bg-yellow-100 p-2 rounded mt-2 text-sm">
                        <p><strong>DEBUG - Koordinat Kantor dari Database:</strong></p>
                        <p>Latitude: {{ $schedule->office->latitude }}</p>
                        <p>Longitude: {{ $schedule->office->longitude }}</p>
                        <p>Radius: {{ $schedule->office->radius }} meter</p>
                    </div>

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

                    <!-- DEBUG - Koordinat Real Time -->
                    <div id="debugCoords" class="bg-blue-100 p-2 rounded mt-2 text-sm hidden">
                        <p><strong>DEBUG - Lokasi User Saat Ini:</strong></p>
                        <p>User Lat: <span id="userLat">-</span></p>
                        <p>User Lng: <span id="userLng">-</span></p>
                        <p>Jarak: <span id="distance">-</span> meter</p>
                    </div>

                    <!-- Hidden inputs untuk koordinat -->
                    <input type="hidden" wire:model="latitude" id="latField">
                    <input type="hidden" wire:model="longitude" id="lngField">
                    <input type="hidden" wire:model="status" id="statusField">
                </div>
            </div>

            <!-- Presensi & Map -->
            <div>
                <h2 class="text-2xl font-bold mb-4">Presensi</h2>
                <div wire:ignore id="map" class="mb-4 rounded-lg border border-gray-300 w-full h-[400px]"></div>

                <div class="flex gap-4">
                    <button type="button" onclick="tagLocation()" class="flex-1 px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                        Tag Location
                    </button>
                    <button type="button" onclick="showDebugInfo()" class="flex-1 px-4 py-2 bg-yellow-600 text-white font-semibold rounded hover:bg-yellow-700 transition">
                        Debug Location
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

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    let map;
    let marker;
    let officeMarker;
    let office = [{{$schedule->office->latitude}}, {{$schedule->office->longitude}}];
    let radius = {{$schedule->office->radius}};
    let shiftStart = "{{ $schedule->shift->start_time }}";
    let shiftEnd = "{{ $schedule->shift->end_time }}";

    console.log('Office coordinates from database:', office);
    console.log('Office radius:', radius);

    function initMap() {
        if (!map) {
            map = L.map('map').setView(office, 16.5);
            L.tileLayer('https://tile.openstreetmap.de/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            // Circle untuk radius kantor
            L.circle(office, {
                radius: radius,
                color: 'red',
                fillColor: "#f03",
                fillOpacity: 0.5
            }).addTo(map);

            // Marker untuk kantor
            officeMarker = L.marker(office, {
                icon: L.icon({
                    iconUrl: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJMMTMuMDkgOC4yNkwyMCA5TDEzLjA5IDE1Ljc0TDEyIDIyTDEwLjkxIDE1Ljc0TDQgOUwxMC45MSA4LjI2TDEyIDJaIiBmaWxsPSIjRkY0NDQ0Ii8+Cjwvc3ZnPgo=',
                    iconSize: [25, 25]
                })
            }).addTo(map).bindPopup('Kantor: {{ $schedule->office->name }}');

            console.log('Map initialized with office at:', office);
        }
    }

    function isWithinRadius(latitude, longitude, center, radius) {
        let distance = map.distance([latitude, longitude], center);
        console.log('Distance calculated:', distance, 'meters');
        return distance <= radius;
    }

    function isWithinShiftTime() {
        const now = new Date();
        const nowTime = now.getHours() * 60 + now.getMinutes();

        const [startH, startM] = shiftStart.split(':').map(Number);
        const [endH, endM] = shiftEnd.split(':').map(Number);

        const startTime = startH * 60 + startM;
        const endTime = endH * 60 + endM;

        if (startTime < endTime) {
            return nowTime >= startTime && nowTime <= endTime;
        } else {
            return nowTime >= startTime || nowTime <= endTime;
        }
    }

    function showDebugInfo() {
        document.getElementById('debugCoords').classList.remove('hidden');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const accuracy = position.coords.accuracy;

                console.log('User coordinates:', latitude, longitude);
                console.log('GPS Accuracy:', accuracy, 'meters');

                document.getElementById('userLat').textContent = latitude.toFixed(6);
                document.getElementById('userLng').textContent = longitude.toFixed(6);

                const distance = map.distance([latitude, longitude], office);
                document.getElementById('distance').textContent = distance.toFixed(2);

                alert(`DEBUG INFO:
                    Office: ${office[0]}, ${office[1]}
                    User: ${latitude}, ${longitude}
                    Distance: ${distance.toFixed(2)} meters
                    Radius: ${radius} meters
                    GPS Accuracy: ${accuracy} meters`);
            }, (error) => {
                console.error('Geolocation error:', error);
                alert('Error getting location: ' + error.message);
            });
        }
    }

    function tagLocation() {
        if (!isWithinShiftTime()) {
            alert("Anda berada di luar jam shift. Tidak dapat melakukan presensi.");
            return;
        }

        if (navigator.geolocation) {
            const options = {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            };

            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const accuracy = position.coords.accuracy;

                console.log('Current position:', latitude, longitude);
                console.log('Accuracy:', accuracy, 'meters');

                if (marker) map.removeLayer(marker);
                marker = L.marker([latitude, longitude], {
                    icon: L.icon({
                        iconUrl: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJMMTMuMDkgOC4yNkwyMCA5TDEzLjA5IDE1Ljc0TDEyIDIyTDEwLjkxIDE1Ljc0TDQgOUwxMC45MSA4LjI2TDEyIDJaIiBmaWxsPSIjNDQ4QUZGIi8+Cjwvc3ZnPgo=',
                        iconSize: [25, 25]
                    })
                }).addTo(map).bindPopup('Lokasi User');

                map.setView([latitude, longitude], 18.5);

                const isInside = isWithinRadius(latitude, longitude, office, radius);
                const distance = map.distance([latitude, longitude], office);

                document.getElementById('locationStatus').innerText = isInside ? 'Dalam Jangkauan' : 'Di Luar Jangkauan';
                document.getElementById('locationStatus').className = isInside ? 'font-bold text-green-600' : 'font-bold text-red-600';

                document.getElementById('latField').value = latitude;
                document.getElementById('lngField').value = longitude;
                document.getElementById('statusField').value = isInside ? 'dalam' : 'luar';

                document.getElementById('latField').dispatchEvent(new Event('input'));
                document.getElementById('lngField').dispatchEvent(new Event('input'));
                document.getElementById('statusField').dispatchEvent(new Event('input'));

                document.getElementById('submitBtn').disabled = !isInside;

                // Show debug info
                document.getElementById('debugCoords').classList.remove('hidden');
                document.getElementById('userLat').textContent = latitude.toFixed(6);
                document.getElementById('userLng').textContent = longitude.toFixed(6);
                document.getElementById('distance').textContent = distance.toFixed(2);

            }, (error) => {
                console.error('Geolocation error:', error);
                alert('Error: ' + error.message + '\nCode: ' + error.code);
            }, options);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>
</main>
