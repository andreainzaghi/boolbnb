/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/ur-create-edit.js ***!
  \****************************************/
var app = new Vue({
  el: '#vue-app',
  data: {
    city: '',
    address: '',
    lat: '',
    "long": ''
  },
  methods: {
    geolocate: function geolocate() {
      var _this = this;

      axios.get('https://api.tomtom.com/search/2/geocode/' + this.address + ' ' + this.city + '.json', {
        params: {
          key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
          language: 'it-IT',
          limit: 1
        }
      }).then(function (geoJson) {
        _this.fillForm(geoJson.data);
      });
    },
    fillForm: function fillForm(json) {
      this.lat = location.results[0].position.lat;
      this["long"] = location.results[0].position.lon;
    }
  }
});
/******/ })()
;