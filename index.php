<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive UAE Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">

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
            <ul id="locationList"></ul>
        </div>


        <div id="map-container">
    <div id="map"></div>
</div>

        
        <div id="location-container" class="details-container" style="display: none;">
            <a class="back-button" href="#" onclick="closeLocation()">← Back to Map</a>
            <div id="location-content"></div>
        </div>
    </div>

    <script>

var containerWidth = 2212;
var containerHeight = 592;
var imageWidth = 1792;
var imageHeight = 1024;

var scaleX = containerWidth / imageWidth;
var scaleY = containerHeight / imageHeight;
var scale = Math.min(scaleX, scaleY);

var scaledWidth = imageWidth * scale;
var scaledHeight = imageHeight * scale;

var imageBounds = [[0, 0], [scaledHeight, scaledWidth]];

var map = L.map('map', {
    minZoom: 1,
    maxZoom: 4,
    center: [scaledHeight / 2, scaledWidth / 2],
    zoom: 2,
    crs: L.CRS.Simple
});


var imageUrl = 'images/palace_map.webp';
L.imageOverlay(imageUrl, imageBounds).addTo(map);


setTimeout(() => {
    map.fitBounds(imageBounds, { padding: [40, 40] });
    map.invalidateSize();
}, 500);


function convertLatLngToPixels(lat, lng) {

    let latMin = 24.468;
    let latMax = 24.4662;
    let lngMin = 54.3168;
    let lngMax = 54.3182;

    let x = ((lng - lngMin) / (lngMax - lngMin)) * scaledWidth;
    let y = ((latMax - lat) / (latMax - latMin)) * scaledHeight;


    let paddingX = 15;
    let paddingY = 15;


    x = Math.min(Math.max(x, paddingX), scaledWidth - paddingX);
    y = Math.min(Math.max(y, paddingY), scaledHeight - paddingY);

    return [y, x];
}

     let locationsData = [];
    let markers = [];


        function loadLocationsList() {
            fetch("get_locations.php")
                .then(response => response.json())
                .then(data => {
                    locationsData = data;
                    updateMapAndList();
                })
                .catch(error => console.log("Error fetching locations:", error));
        }

       function updateMapAndList() {
    let locationList = document.getElementById('locationList');
    locationList.innerHTML = "";

    markers.forEach(marker => map.removeLayer(marker));
    markers = [];

    locationsData.forEach(location => {
        let pixelCoords = convertLatLngToPixels(location.lat, location.lng);


        let marker = L.marker(pixelCoords, { riseOnHover: true })
            .addTo(map)
            .bindPopup(`
                <h3>${location.name}</h3>
                <img src="${location.image}" alt="${location.name}" style="width: 100%; max-height: 150px; border-radius: 10px; margin-bottom: 5px;">
                <p>${location.description}</p>
                <a href="#" onclick="loadLocation('${location.id}')" style="color: blue; text-decoration: underline;">View More</a>
            `);

        markers.push(marker);

        let listItem = document.createElement('li');
        listItem.classList.add("location-item");
        listItem.setAttribute("data-category", location.category);
        listItem.innerHTML = `<a href="#">${location.name}</a>`;

        listItem.addEventListener("click", () => {
            map.setView(pixelCoords, 1, { animate: true });
            marker.openPopup();
        });

        locationList.appendChild(listItem);
    });
}



        function loadLocation(locationId) {
            fetch("location.html")
                .then(response => response.text())
                .then(html => {
                    document.getElementById("location-content").innerHTML = html;
                    document.getElementById("location-container").style.display = "block";

                    fetch("get_locations.php")
                        .then(response => response.json())
                        .then(data => {
                            const location = data.find(loc => loc.id === locationId);
                            if (location) {
                                document.getElementById("locationName").textContent = location.name;
                                document.getElementById("locationImage").src = location.image;
                                document.getElementById("locationImage").alt = location.name;
                                document.getElementById("locationDescription").textContent = location.description;
                                if (location.extra_info && location.extra_info.trim() !== "") {
                                    document.getElementById("extraInfo").innerHTML = `<strong>More Info:</strong> ${location.extra_info}`;
                                } else {
                                    document.getElementById("extraInfo").style.display = "none";
                                }
                            }
                        })
                        .catch(error => console.log("Error fetching location details:", error));
                })
                .catch(error => console.log("Error loading location.html:", error));
        }

        function closeLocation() {
            document.getElementById("location-container").style.display = "none";
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

        document.addEventListener("DOMContentLoaded", loadLocationsList);
    </script>

</body>
</html>
