// Array di tasti ammessi
const letters = [8, 46];
// Aggiungo le lettere
for ( let i = 64 ; i < 91; i++ ) {
    letters.push(i);
}
// Aggiungo i keycodes a Vue
Vue.config.keyCodes = {
    letters: letters
}

let axiosSource = null;

var app = new Vue({
    el: '#app',
    data: {
        query: '',
        resultQuery: '',
        results: [],
        resultSelected: -1,
        focusSearch: false,
        mouseOverRes: false,
        // Axios
        searchURL: window.location.href+'search?city=',
        apiKey: "GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn",
        apiPath: 'https://api.tomtom.com/search/2/search/',
        axiosIsCalling: false,
        axiosSource: null
    },
    methods: {
        autocomplete(){
            if ( this.axiosIsCalling ) {
                axiosSource.cancel();
            }
            this.resultSelected = -1;
            this.resultQuery = '';
            if ( this.query.length > 2 ) {
                this.axiosIsCalling = true;
                axiosSource = axios.CancelToken.source();
                axios.get( this.apiPath+this.query+'.json', {
                    cancelToken: axiosSource.token,
                    params: {
                        typeahead: true,
                        key: this.apiKey,
                        language: 'it-IT',
                        countrySet: 'IT',
                        limit: 5,
                        entityTypeSet: 'Municipality'
                    },
                })
                .then( (response) => {
                    this.axiosIsCalling = false;
                    let match = response.data;
                    this.results = match.results;
                })
                .catch(function(thrown) {
                    
                });
            } else {
                this.results = [];
            }
        },
        search() {
            if ( this.query.length > 0 ) {
                if ( this.resultQuery.length > 0 ) {
                    this.query = this.resultQuery;
                }
                window.location.href = this.searchURL+this.query;
                this.results = [];
            }
        },
        selectUp(e) {
            if ( this.resultSelected > 0 ) {
                this.resultSelected -= 1;
                e.preventDefault();
                this.addToQuery();
            }
        },
        selectDown(e) {
            if ( this.resultSelected < 4 ) {
                this.resultSelected += 1;
                e.preventDefault();
                this.addToQuery();
            }
        },
        addToQuery(e = null) {
            if ( e != null ) {
                this.query = e.target.innerText;
            } else {
                this.resultQuery = this.results[this.resultSelected].address.freeformAddress+', '+this.results[this.resultSelected].address.countrySubdivision
            }
        },
    },
});