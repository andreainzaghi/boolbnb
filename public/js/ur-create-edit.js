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

      var query;

      if (this.address.indexOf('/') > -1) {
        var intern = this.address.split('/').pop();

        if (intern.indexOf(',') > -1) {
          intern = intern.split(',').shift();
        }

        query = this.address.replace('/' + intern, '') + ' ' + this.city;
      }

      axios.get('https://api.tomtom.com/search/2/geocode/' + query + '.json', {
        params: {
          key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
          language: 'it-IT',
          limit: 1
        }
      }).then(function (geoJson) {
        if (typeof geoJson.data.results[0] !== 'undefined') {
          _this.fillForm(geoJson.data.results[0]);
        }
      })["catch"](function () {
        _this.lat = 'Non è stato possibile individuare la posizione';
        _this["long"] = 'Non è stato possibile individuare la posizione';
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