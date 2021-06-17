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
        search(location){
            console.log(location.results[0].position.lat);
            axios.get( this.baseURL, {
                params: {
                    lat: location.results[0].position.lat,
                    long: location.results[0].position.lon
                }
            })
            .then( (response) => {
            this.apartments = response.data;
            console.log(this.apartments);
            generateMap();
            createMarkers();
            });
        },
    },
    created() {
        let urlParams = new URLSearchParams(window.location.search);
        if ( urlParams.has('city') ) {
            this.city = urlParams.get('city');
        }
        axios.get( 'https://api.tomtom.com/search/2/geocode/'+this.city+'.json', {
            params: {
                key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
                language: 'it-IT',
                limit: 1,
            }   
        })
        .then( (geoJson) => {
        this.search(geoJson.data);
        });
    }
});

function displayFence(fence) {
    axios.get( 'https://api.tomtom.com/geofencing/1/fences/'+fenceId, {
        params: {
            key: apiKey
        }   
    })
    .then( (response) => {
    fence = response.data;
    console.log(fence);
    map.addSource(userFence, {
        type: "geojson",
        data: fence
      });
    map.addLayer({
        'id': 'Milano-20km',
        'type': 'fill',
        'source': userFence,
        'layout': {},
        'paint': {
            'fill-color': 'orange',
            /* 'fill-opacity': 0.5,
            'fill-outline-color': 'black' */
        }
    });
    console.log('ok');
    });
}

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
let apartments, map;
const adminKey = "xlh5oGUrsotW4VXTAD4dNxaxJ5MGwqrL2ezDmXAlv1OfuaAk";
const apiKey = "GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn";
const projectId = "6f2ff167-1c34-400b-9561-c650b915c786";
const fenceId = "4e3cc3b6-d7b2-4cfd-9ea1-d1ff12164a9b";

function generateMap() {
    apartments = { 
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
    map = tt.map({
    // Proprietà necessaria API Key
    key: apiKey,
    // Prop. nec. ID dell' elemento HTML in cui viene mostrata la mappa
    container: 'map',

    center: [ 9.18812, 45.46362 ],

    zoom: 9,
    });

    map.on('load', function(){
        let layer = {
            'id': fenceId,
            'type': 'fill',
            'source': {
                'type': 'geojson',
                'data': {
                    'type': 'Feature',
                    'geometry': {
                        "radius": 20000,
                        'coordinates': [[[9.18812, 45.46362]]],
                        'type': 'Point',
                        'shapeType': 'Circle'
                    }
                }
            },
            'layout': {},
            'paint': {
                'fill-color': 'orange',
                /* 'fill-opacity': 0.5,
                'fill-outline-color': 'black' */
            }
        };
        map.addLayer(layer);
        /* displayFence(fenceId); */
    })
}

function createMarkers() {
    // Ciclo gli appartamenti per creare marker e voce della lista
    apartments.features.forEach(function (apartment, index) {
        // Salvo i dati
        const city = apartment.properties.city;
        const address = apartment.properties.address;
        const location = apartment.geometry.coordinates;
        const title = apartment.properties.title;
        
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