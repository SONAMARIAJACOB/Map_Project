<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive UAE Map</title>

    <!-- Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Locations</h2>
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterLocations()">
            <select id="categoryFilter" onchange="filterByCategory()">
                <option value="all">All Places</option>
                <option value="dining">Dining</option>
                <option value="recreation">Recreation</option>
                <option value="wellness">Wellness</option>
                <option value="family">Family</option>
            </select>
            <ul id="locationList">
                <!-- Locations will be inserted here dynamically -->
            </ul>
        </div>

        <!-- Map -->
        <div id="map"></div>
    </div>

    <script>
        var map = L.map('map').setView([24.466667, 54.316666], 15); // Emirates Palace

        // Add map tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let locationsData = [];
        let markers = [];

        // Fetch locations from PHP
        fetch('get_locations.php')
        .then(response => response.json())
        .then(data => {
            locationsData = data;
            updateMapAndList();
        })
        .catch(error => console.log('Error loading locations:', error));

         function updateMapAndList() {
        let locationList = document.getElementById('locationList');
        locationList.innerHTML = "";
        markers.forEach(marker => map.removeLayer(marker));
        markers = [];

        locationsData.forEach(location => {
            let marker = L.marker([location.lat, location.lng]).addTo(map)
                .bindPopup(`
                    <h3>${location.name}</h3>
                    <img src="${location.image}" alt="${location.name}" style="width: 100%; max-height: 150px; border-radius: 10px; margin-bottom: 5px;">
                    <p>${location.description}</p>
                `);
            markers.push(marker);

            let listItem = document.createElement('li');
            listItem.classList.add("location-item");
            listItem.setAttribute("data-category", location.category);
            listItem.innerHTML = `<a href="#" onclick="focusLocation(${location.lat}, ${location.lng}, '${location.name}', '${location.description}', '${location.image}')">${location.name}</a>`;
            locationList.appendChild(listItem);
        });
    }

      function focusLocation(lat, lng, name, description, image) {
        map.setView([lat, lng], 17);
        L.popup().setLatLng([lat, lng]).setContent(`
            <h3>${name}</h3>
            <img src="${image}" alt="${name}" style="width: 100%; max-height: 150px; border-radius: 10px; margin-bottom: 5px;">
            <p>${description}</p>
        `).openOn(map);
    }

        function filterByCategory() {
            let category = document.getElementById('categoryFilter').value;
            let items = document.querySelectorAll(".location-item");

            items.forEach(item => {
                if (category === "all" || item.getAttribute("data-category") === category) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }

        function filterLocations() {
            let filter = document.getElementById('searchInput').value.toLowerCase();
            let items = document.querySelectorAll(".location-item");

            items.forEach(item => {
                let text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>

</body>
</html>
