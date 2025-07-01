<div>
     <div class="container mx-auto">
        <div class="bg-white p-6 rounded-lg mt-3 shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Informasi Pegawai</h2>
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <p><strong>Nama Pegawai : </strong> {{Auth::user()->name}}</p>
                        <p><strong>Kantor : </strong> {{ $schedule->office->name }}</p>
                        <p><strong>Shift : </strong> {{ $schedule->shift->name }} ({{ $schedule->shift->start_time }} -
                            {{ $schedule->shift->end_time }})</p>
                        <p><strong></strong></p>
                    </div>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-2">Presensi</h2>
                    <div id="map" class="mb-4 rounded-lg border border-gray-300 w-auto h-[400px]"></div>
                    <button type="button" onclick="tagLocation()" class="px-4 py-2 bg-blue-500 text-white rounded">Tag Location</button>
                    <button type="button" class="px-4 py-2 bg-green-500 text-white rounded">Submit Presensi</button>
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
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    if(marker) {
                        map.removeLayer(marker);
                    }
                    marker = L.marker([latitude, longitude]).addTo(map);
                    map.setView([latitude, longitude], 18.5);

                    if(isWithinRadius(latitude, longitude, office, radius)) {
                        alert('Anda di dalam jangkauan kantor');
                    } else {
                        alert('Anda diluar jangkauan kantor');
                    }
                })
            }
        }

        function isWithinRadius(latitude, longitude, center, radius) {
            let distance = map.distance([latitude, longitude], center);
            return distance <= radius;
        }
    </script>
</div>