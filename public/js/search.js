/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
var app = new Vue({
  el: '#app',
  data: {
    isActive: false,
    city: '',
    selected: '',
    apartments: [],
    services: [],
    rooms: 0,
    bathrooms: 0,
    beds: 0,
    mq: 0,
    radius: 20,
    lat: 0,
    "long": 0,
    apiSearch: 'api/search',
    apiFilter: 'api/filter',
    popupSelected: ''
  },
  methods: {
    getPosition: function getPosition(city) {
      var _this = this;

      axios.get('https://api.tomtom.com/search/2/geocode/' + city + '.json', {
        params: {
          key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
          language: 'it-IT',
          limit: 1
        }
      }).then(function (geoJson) {
        _this.lat = geoJson.data.results[0].position.lat;
        _this["long"] = geoJson.data.results[0].position.lon;

        _this.search();
      });
    },
    search: function search(location) {
      var _this2 = this;

      axios.get(this.apiSearch, {
        params: {
          lat: this.lat,
          "long": this["long"],
          services: this.services,
          rooms: this.rooms,
          bathrooms: this.bathrooms,
          beds: this.beds,
          mq: this.mq,
          radius: this.radius
        }
      }).then(function (response) {
        _this2.apartments = response.data;
        generateMap();
        createMarkers();
      });
    }
  },
  created: function created() {
    var urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('city')) {
      this.city = urlParams.get('city');
    }

    this.getPosition(this.city);
  }
});

function selectedScroll() {
  setTimeout(function () {
    selected = document.getElementsByClassName('selected');

    if (selected.length != 0) {
      selected[0].scrollIntoView();
    }
  }, 1);
}

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

var markersCity = [];
var apartments, map;
var adminKey = "xlh5oGUrsotW4VXTAD4dNxaxJ5MGwqrL2ezDmXAlv1OfuaAk";
var apiKey = "GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn";
var projectId = "6f2ff167-1c34-400b-9561-c650b915c786";
var fenceId = "4e3cc3b6-d7b2-4cfd-9ea1-d1ff12164a9b";

function generateMap() {
  apartments = {
    "type": "FeatureCollection",
    "features": []
  };

  app._data.apartments.forEach(function (apartment) {
    apartments.features.push({
      "type": "Feature",
      "geometry": {
        "type": "Point",
        //Lng e Lat
        "coordinates": [apartment["long"], apartment.lat]
      },
      "properties": {
        "address": apartment.address,
        "city": apartment.city,
        "title": apartment.title
      }
    });
  });

  console.log(apartments);
  map = tt.map({
    // Proprietà necessaria API Key
    key: apiKey,
    // Prop. nec. ID dell' elemento HTML in cui viene mostrata la mappa
    container: 'map',
    center: [app._data["long"], app._data.lat],
    zoom: 9
  });
  map.on('load', function () {
    map.addLayer({
      'id': 'searchZone',
      'type': 'fill',
      'source': {
        'type': 'geojson',
        'data': {
          'type': 'Feature',
          'geometry': {
            "type": "Point",
            "radius": app._data.radius * 1000,
            "shapeType": "Circle",
            "coordinates": [app._data["long"], app._data.lat]
          }
        }
      },
      'layout': {},
      'paint': {
        'fill-color': '#2FAAFF',
        'fill-opacity': 0.8,
        'fill-outline-color': 'black'
      }
    });
  });
}

function createMarkers() {
  // Ciclo gli appartamenti per creare marker e voce della lista
  apartments.features.forEach(function (apartment, index) {
    // Salvo i dati
    var city = apartment.properties.city;
    var address = apartment.properties.address;
    var location = apartment.geometry.coordinates;
    var title = apartment.properties.title; // Creazione del marker

    var marker = new tt.Marker({
      color: '#2271b3',
      id: apartment.properties.title
    }).setLngLat(location).setPopup(new tt.Popup({
      offset: 35
    }).setHTML('<span class="popup_title">' + title + '</span><span>' + address + '</span>')).addTo(map);
    markersCity[index] = {
      marker: marker,
      city: city
    };

    marker._element.addEventListener('click', function () {
      app._data.popupSelected = apartment.properties.title;
      selectedScroll();
    });
  });
  map.fitBounds(getMarkersBoundsForCity(app._data.city), {
    padding: 50,
    maxZoom: 12
  });
}
/******/ })()
;