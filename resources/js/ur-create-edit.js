var app = new Vue({
    el: '#vue-app',
    data: {
        city: '',
        address: '',
        lat: '',
        long: ''
    },
    methods: {
        geolocate() {
            axios.get( 'https://api.tomtom.com/search/2/geocode/'+this.address+' '+this.city+'.json', {
                params: {
                    key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
                    language: 'it-IT',
                    limit: 1,
                }   
            })
            .then( (geoJson) => {
            this.fillForm(geoJson.data);
            });
        },

        fillForm(json) {
            this.lat = location.results[0].position.lat;
            this.long = location.results[0].position.lon;
        }
    }
});
