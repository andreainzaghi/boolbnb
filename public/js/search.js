/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
var app = new Vue({
  el: '#app',
  data: {
    city: '',
    citySearched: '',
    apartments: []
  },
  created: function created() {
    var urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('city')) {
      this.city = urlParams.get('city');
    }

    this.apartmentsSearch(this.city);
  },
  methods: {
    // Ricerca sul database
    apartmentsSearch: function apartmentsSearch() {
      var _this = this;

      axios.get('http://localhost:8000/api/search', {
        params: {
          city: this.city
        }
      }).then(function (result) {
        _this.apartments = result.data;
      });
      this.citySearched = this.city;
    },
    nearBySearch: function nearBySearch() {
      var _this2 = this;

      axios.get('https://api.tomtom.com/search/2/nearbySearch/.json?lat=45.489862&lon=9.15045&radius=20000&idxSet=Addr&key=GAGkYaAlzOjYhzUBT6eMbAJSRhBfE5Ao', {
        params: {
          city: this.city
        }
      }).then(function (result) {
        console.log("Result: " + result);
        _this2.apartments = result.data;
      }); //this.citySearched = this.city;
    }
  }
});
/******/ })()
;