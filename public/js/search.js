/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
var app = new Vue({
  el: '#app',
  data: {
    city: '',
    selected: '',
    apartments: [],
    baseURL: 'api/search'
  },
  methods: {
    /*         filter(services){
               if ( this.selected.length == 0 ){
                   return true;
               }
               services.forEach(service => {
                   
               });
           } */

    /* cityApi(city) {
        this.city = city;
        this.filter(city);
        if ( this.apartments.length === 0 ) {
            return false;
        }
        return true;
    }, */
    search: function search(city) {
      var _this = this;

      axios.get(this.baseURL, {
        params: {
          city: this.city
        }
      }).then(function (arr) {
        _this.apartments = arr.data;
        generateMap();
      });
    }
  },
  created: function created() {
    var urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('city')) {
      this.city = urlParams.get('city');
    }

    this.search(this.city);
  }
});

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

function generateMap() {
  var apartments = {
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
        "city": apartment.city
      }
    });
  });

  console.log(apartments);
  var map = tt.map({
    // Proprietà necessaria API Key
    key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
    // Prop. nec. ID dell' elemento HTML in cui viene mostrata la mappa
    container: 'map'
  });
  var markersCity = [];
  var list = document.getElementById('apartments-list'); // Ciclo gli appartamenti per creare marker e voce della lista

  apartments.features.forEach(function (apartment, index) {
    // seleziono l' elemento html
    var markerHTML = document.getElementById('markerHTML-' + index); // Salvo i dati

    var city = apartment.properties.city;
    var address = apartment.properties.address;
    var location = apartment.geometry.coordinates;
    var cityApartmentsList = document.getElementById(city); // Creazione del marker

    var marker = new tt.Marker({
      color: '#2271b3'
    }).setLngLat(location).setPopup(new tt.Popup({
      offset: 35
    }).setHTML(address)).addTo(map);
    markersCity[index] = {
      marker: marker,
      city: city
    };

    if (cityApartmentsList === null) {
      var cityApartmentsListHeading = list.appendChild(document.createElement('h3'));
      cityApartmentsListHeading.innerHTML = city;
      cityApartmentsList = list.appendChild(document.createElement('div'));
      cityApartmentsList.id = city;
      cityApartmentsList.className = 'list-entries-container';
      cityApartmentsListHeading.addEventListener('click', function (e) {
        map.fitBounds(getMarkersBoundsForCity(e.target.innerText), {
          padding: 50
        });
      });
    }

    var details = buildLocation(cityApartmentsList, address);

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
  });
}
/******/ })()
;