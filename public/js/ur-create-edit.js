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
    "long": '',
    submitDisabled: 'true'
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
        if (typeof geoJson.data.results[0] !== 'undefined') {
          _this.fillForm(geoJson.data.results[0]);
        }
      });
    },
    fillForm: function fillForm(json) {
      this.lat = json.position.lat;
      this["long"] = json.position.lon;
    }
  }
});
/******/ })()
;