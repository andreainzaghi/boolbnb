var app = new Vue({
    el: '#vue-app',
    data: {
        city: '',
        address: '',
        lat: '',
        long: '',
        submitDisabled: 'true'
    },
    methods: {
        geolocate() {
            let query = this.address + ' ' + this.city;
            if ( this.address.indexOf('/') > -1 ) {
                let intern = this.address.split('/').pop();
                if ( intern.indexOf(',') > -1 ) {
                    intern = intern.split(',').shift();
                }
                query = this.address.replace('/' + intern, '') + ' ' + this.city;
            }
            axios.get( 'https://api.tomtom.com/search/2/geocode/'+query+'.json', {
                params: {
                    key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
                    language: 'it-IT',
                    limit: 1,
                }   
            })
            .then( (geoJson) => {
                if ( typeof geoJson.data.results[0] !== 'undefined' ) {
                    this.fillForm(geoJson.data.results[0]);
                }
            })
            .catch( () => {
                this.lat = 'Non è stato possibile individuare la posizione';
                this.long = 'Non è stato possibile individuare la posizione';
            });
        },

        fillForm(json) {
            this.lat = json.position.lat;
            this.long = json.position.lon;
        }
    }
});
