/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var cityTitle;
var primaryColor = '#E94A47'; // X cambiare colore svg fill='%23E94A47' %s3 sta per #
// Array di tasti ammessi

var letters = [8, 46]; // Aggiungo le lettere

for (var i = 64; i < 91; i++) {
  letters.push(i);
} // Aggiungo i keycodes a Vue


Vue.config.keyCodes = {
  letters: letters
};
var axiosSource = null;
var app = new Vue({
  el: '#app',
  data: {
    // Variabili ricerca
    city: '',
    services: [],
    rooms: 1,
    bathrooms: 1,
    beds: 1,
    mq: 35,
    radius: 20,
    lat: 0,
    "long": 0,
    // Dati Api
    apiKey: "GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn",
    apiSearch: 'api/search',
    apiTomTom: 'https://api.tomtom.com/search/2/search/',
    // Elementi dom
    selected: '',
    apartments: [],
    popupSelected: '',
    showAdvSearch: false,
    showURL: '',
    loaded: false,
    cityFocus: false,
    mouseOverRes: false,
    showMap: false,
    // Filtra
    resultCity: '',
    results: [],
    resultSelected: -1,
    // Axios
    axiosIsCalling: false,
    axiosSource: null
  },
  methods: {
    autocomplete: function autocomplete() {
      var _this = this;

      if (this.axiosIsCalling) {
        axiosSource.cancel();
      }

      this.resultSelected = -1;
      this.resultCity = '';

      if (this.city.length > 2) {
        this.axiosIsCalling = true;
        axiosSource = axios.CancelToken.source();
        axios.get(this.apiTomTom + this.city + '.json', {
          cancelToken: axiosSource.token,
          params: {
            typeahead: true,
            key: this.apiKey,
            language: 'it-IT',
            countrySet: 'IT',
            limit: 5,
            entityTypeSet: 'Municipality'
          }
        }).then(function (response) {
          _this.axiosIsCalling = false;
          var match = response.data;
          _this.results = match.results;
        })["catch"](function (thrown) {});
      } else {
        this.results = [];
      }
    },
    select: function select() {
      if (this.city.length > 0) {
        if (this.resultCity.length > 0) {
          this.city = this.resultCity;
        }

        this.results = [];
      }
    },
    selectUp: function selectUp(e) {
      if (this.resultSelected > 0) {
        this.resultSelected -= 1;
        e.preventDefault();
        this.addToCity();
      }
    },
    selectDown: function selectDown(e) {
      if (this.resultSelected < 4) {
        this.resultSelected += 1;
        e.preventDefault();
        this.addToCity();
      }
    },
    addToCity: function addToCity() {
      var e = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

      if (e != null) {
        this.city = e.target.innerText;
      } else {
        this.resultCity = this.results[this.resultSelected].address.freeformAddress + ', ' + this.results[this.resultSelected].address.countrySubdivision;
      }
    },
    changeTitle: function changeTitle() {
      cityTitle.innerHTML = this.city;
    },
    // Chiamata Api per localizzare l' indirizzo
    getPosition: function getPosition() {
      var _this2 = this;

      this.apartments = [];
      this.loaded = false;
      this.changeTitle();
      axios.get('https://api.tomtom.com/search/2/geocode/' + this.city + '.json', {
        params: {
          key: this.apiKey,
          language: 'it-IT',
          limit: 1
        }
      }).then(function (geoJson) {
        if (geoJson.data.results[0] !== undefined) {
          _this2.lat = geoJson.data.results[0].position.lat;
          _this2["long"] = geoJson.data.results[0].position.lon;

          _this2.search();
        } else {
          _this2.loaded = true;
          map.remove();
        }
      });
    },
    // Chiamata Api della ricerca avanzata
    search: function search() {
      var _this3 = this;

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
        _this3.apartments = response.data;
        _this3.loaded = true;
        generateMap();
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


function getMarkersBounds() {
  var bounds = new tt.LngLatBounds();
  markers.forEach(function (marker) {
    bounds.extend(marker.getLngLat());
  });
  return bounds;
} // Variabili globali


var markers = [];
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

  if (app._data.apartments.length > 0) {
    createMarkers();
  }
} // crea i markers e centra la mappa su di essi


function createMarkers() {
  markers = []; // Converte gli appartamenti in format geoJson

  apartments = app._data.apartments; // Ciclo gli appartamenti per creare marker e voce della lista

  apartments.forEach(function (apartment, index) {
    // Salvo i dati
    var city = apartment.city;
    var address = apartment.address;
    var location = [apartment["long"], apartment.lat];
    var title = apartment.title; // Creazione del marker

    var marker = new tt.Marker({
      color: primaryColor,
      id: title
    }).setLngLat(location).setPopup(new tt.Popup({
      offset: 35
    }).setHTML('<span class="popup_title">' + title + '</span><span>' + address + '</span>')).addTo(map);
    markers[index] = marker;

    marker._element.addEventListener('click', function () {
      app._data.popupSelected = title;
      selectedScroll();
    });
  });
  map.fitBounds(getMarkersBounds(), {
    padding: 50,
    maxZoom: 12,
    linear: true
  });
}
/******/ })()
;