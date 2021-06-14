/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
var app = new Vue({
  el: '#app',
  data: {
    city: '',
    apartments: []
  },
  mounted: function mounted() {
    alert(this.city);
  },
  methods: {
    search: function search() {// axios
      // .get('localhost//...')
      // .then(response => (this.info = response))
    }
  }
});
/******/ })()
;