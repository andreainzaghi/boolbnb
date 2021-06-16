/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/show.js ***!
  \******************************/
var appartamento = {
  "type": "Feature",
  "geometry": {
    "type": "Point",
    //Lng e Lat
    "coordinates": [11.20277, 43.77863]
  },
  "properties": {
    "address": "Via Antonio Canova 116/22, 50142 Firenze",
    "city": "Firenze"
  }
}; // Fine oggetto Appartamenti
// Dichiarazione Funzioni

function closeAllPopups() {
  markersCity.forEach(function (markerCity) {
    if (markerCity.marker.getPopup().isOpen()) {
      markerCity.marker.togglePopup();
    }
  });
}

function getMarkersBoundsForCity(city) {
  var bounds = new tt.LngLatBounds();
  markersCity.forEach(function (markerCity) {
    if (markerCity.city === city) {
      bounds.extend(markerCity.marker.getLngLat());
    }
  });
  return bounds;
}

function buildLocation(htmlParent, text) {
  var details = htmlParent.appendChild(document.createElement('a'));
  details.href = '#';
  details.className = 'list-entry';
  details.innerHTML = text;
  return details;
}

var entryLocation = appartamento.geometry.coordinates; // Informazioni prodotto (superfluo)

tt.setProductInfo('teaminzaghi', '1.0'); // Istanza dell' oggetto mappa

var map = tt.map({
  // ProprietÃ  necessaria API Key
  key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
  // Prop. nec. ID dell' elemento HTML in cui viene mostrata la mappa
  container: 'map',
  // (Non nec.) Centro della mappa iniziale
  center: entryLocation,
  // (Non nec.) Zoom iniziale
  zoom: 14,
  // (Non nec.) Stile della mappa
  style: {
    map: 'basic_main-lite'
  }
});
var list = document.getElementById('appartamenti-list'); // Salvo i dati

var city = appartamento.properties.city;
var address = appartamento.properties.address; // Creazione del marker

var marker = new tt.Marker({
  color: '#2271b3'
}).setLngLat(entryLocation).setPopup(new tt.Popup({
  offset: 35
}).setHTML(address)).addTo(map);
var details = buildLocation(list, address);

marker._element.addEventListener('click', function (details, city) {
  var activeItem = document.getElementsByClassName('selected');
  return function () {
    if (activeItem[0]) {
      activeItem[0].classList.remove('selected');
    }

    details.classList.add('selected');
  };
}(details, city));

details.addEventListener('click', function (marker) {
  var activeItem = document.getElementsByClassName('selected');
  return function () {
    if (activeItem[0]) {
      activeItem[0].classList.remove('selected');
    }

    details.classList.add('selected');
    map.easeTo({
      center: marker.getLngLat(),
      zoom: 18
    });
    closeAllPopups();
    marker.togglePopup();
  };
}(marker));
/******/ })()
;