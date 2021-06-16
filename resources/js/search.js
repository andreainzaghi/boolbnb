var app = new Vue({
    el: '#app',
    data: {
        city: '',
        selected: '',
        apartments: [],
        baseURL: 'api/search',
        popupSelected: '',
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
        search(city){
            axios.get( this.baseURL, {
                params: {
                    city: this.city
                }   
            })
            .then( (arr) => {
            this.apartments = arr.data;
            console.log(this.apartments);
            generateMap();
            });
        },
    },
    created() {
        let urlParams = new URLSearchParams(window.location.search);
        if ( urlParams.has('city') ) {
            this.city = urlParams.get('city');
        }
        this.search(this.city);
    }
});

function selectedScroll() {
    setTimeout(() => {
        selected = document.getElementsByClassName('selected');
        if ( selected.length != 0 ) {
            selected[0].scrollIntoView();
        }
    }, 1);
}

function closeAllPopups() {
    markersCity.forEach(markerCity => {
        if (markerCity.marker.getPopup().isOpen()) {
            markerCity.marker.togglePopup();
        }
    });
}

function getMarkersBoundsForCity(city) {
const bounds = new tt.LngLatBounds();
markersCity.forEach(markerCity => {
    if (markerCity.city === city) {
        bounds.extend(markerCity.marker.getLngLat());
    }
});
return bounds;
}

const markersCity = [];

function generateMap() {
    let apartments = { 
        "type": "FeatureCollection",
        "features": []
        };
        app._data.apartments.forEach( apartment => {
        apartments.features.push({
                "type": "Feature",
                "geometry": {
                    "type": "Point",
                    //Lng e Lat
                    "coordinates": [
                        apartment.long,
                        apartment.lat
                    ]
                },
                "properties": {
                    "address": apartment.address,
                    "city": apartment.city,
                    "title": apartment.title,
                }
            },
        );
    })
    console.log(apartments);
    let map = tt.map({
    // Proprietà necessaria API Key
    key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
    // Prop. nec. ID dell' elemento HTML in cui viene mostrata la mappa
    container: 'map',
    });

    const list = document.getElementById('apartments-list');
    
   // Ciclo gli appartamenti per creare marker e voce della lista
    apartments.features.forEach(function (apartment, index) {
   // seleziono l' elemento html
        let markerHTML = document.getElementById('markerHTML-' + index);
        // Salvo i dati
        const city = apartment.properties.city;
        const address = apartment.properties.address;
        const location = apartment.geometry.coordinates;
        const title = apartment.properties.title;
        let cityApartmentsList = document.getElementById(city);
        
        // Creazione del marker
        const marker = new tt.Marker({
            color: '#2271b3',
            id: apartment.properties.title,
        }).setLngLat(location)
        .setPopup(new tt.Popup({offset: 35})
        .setHTML('<span class="popup_title">' + title + '</span><span>' + address + '</span>'))
        .addTo(map);
        
        markersCity[index] = {marker, city};
        
        marker._element.addEventListener('click',
            function () {
                app._data.popupSelected = apartment.properties.title;
                selectedScroll();
        })
    });
    map.fitBounds(getMarkersBoundsForCity(app._data.city), {
        /* padding: 50 */
        zoom: 11
    });
}