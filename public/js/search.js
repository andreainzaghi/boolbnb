/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var cityTitle;
var app = new Vue({
  el: '#app',
  data: {
    // Variabili ricerca
    city: '',
    services: [],
    rooms: 0,
    bathrooms: 0,
    beds: 0,
    mq: 0,
    radius: 20,
    lat: 0,
    "long": 0,
    // Dati Api
    apiKey: "GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn",
    apiSearch: 'api/search',
    // Elementi dom
    selected: '',
    apartments: [],
    popupSelected: '',
    showAdvSearch: false,
    showURL: '',
    loaded: false
  },
  methods: {
    changeTitle: function changeTitle() {
      cityTitle.innerHTML = this.city;
    },
    // Chiamata Api per localizzare l' indirizzo
    getPosition: function getPosition() {
      var _this = this;

      this.changeTitle();
      axios.get('https://api.tomtom.com/search/2/geocode/' + this.city + '.json', {
        params: {
          key: this.apiKey,
          language: 'it-IT',
          limit: 1
        }
      }).then(function (geoJson) {
        if (geoJson.data.results[0] !== undefined) {
          _this.lat = geoJson.data.results[0].position.lat;
          _this["long"] = geoJson.data.results[0].position.lon;

          _this.search();
        }
      });
    },
    // Chiamata Api della ricerca avanzata
    search: function search(location) {
      var _this2 = this;

      axios.get(this.apiSearch, {
        params: _defineProperty({
          lat: this.lat,
          "long": this["long"],
          services: this.services,
          rooms: this.rooms,
          bathrooms: this.bathrooms,
          beds: this.beds,
          mq: this.mq,
          radius: this.radius
        }, "services", this.services)
      }).then(function (response) {
        _this2.apartments = response.data;
        _this2.loaded = true;
        generateMap();

        if (_this2.apartments.length > 0) {
          map.on('load', createMarkers());
        }
      });
    }
  },
  // Legge l' indirizzo inserito nell' URL
  created: function created() {
    cityTitle = document.getElementById('city_title');
    var urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('city')) {
      this.city = urlParams.get('city');
    }

    this.getPosition();
  }
}); // Visualizza l' appartamento selezionato nel control-panel

function selectedScroll() {
  setTimeout(function () {
    selected = document.getElementsByClassName('selected');

    if (selected.length != 0) {
      selected[0].scrollIntoView();
    }
  }, 1);
} // Chiude i popup non selezionati


function closeAllPopups() {
  markersCity.forEach(function (markerCity) {
    if (markerCity.marker.getPopup().isOpen()) {
      markerCity.marker.togglePopup();
    }
  });
} // Calcola i confini in base ai marker


function getMarkersBoundsForCity(city) {
  var bounds = new tt.LngLatBounds();
  markersCity.forEach(function (markerCity) {
    if (markerCity.city === city) {
      bounds.extend(markerCity.marker.getLngLat());
    }
  });
  return bounds;
} // Variabili globali


var markersCity = [];
var apartments,
    map,
    center,
    radius = app._data.radius; // Genera la mappa

function generateMap() {
  center = [app._data["long"], app._data.lat];
  map = tt.map({
    // Proprietà necessaria API Key
    key: app._data.apiKey,
    // Prop. nec. ID dell' elemento HTML in cui viene mostrata la mappa
    container: 'map',
    center: center,
    zoom: 9,
    minZoom: 6
  });
  map.addControl(new tt.FullscreenControl());
  map.addControl(new tt.NavigationControl());
  /* map.on('load', function(){
       let searchZone = new MapboxCircle({lat: center[1], lng: center[0]}, (radius*1000), {
          fillColor: '#29AB87',
      }).addTo(map);
  }) */
} // crea i markers e centra la mappa su di essi


function createMarkers() {
  console.log(app._data.apartments); // Converte gli appartamenti in format geoJson

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
  }); // Ciclo gli appartamenti per creare marker e voce della lista


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