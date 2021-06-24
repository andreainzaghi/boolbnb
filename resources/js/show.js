import axios from 'axios';
let apartment, views, messages;

axios.get('/api/user/'+window.location.pathname.split("/").pop())
.then( (response) => {
    apartment = response.data;
    generateMap();
});

function generateMap() {
    // Ricavo i dati
    let coordinates = [ apartment.long , apartment.lat ];
    const address = apartment.address;
    // Istanza dell' oggetto mappa
    let map = tt.map({
        // ProprietÃ  necessaria API Key
        key: 'GxjgBi0sgi7GaGSXnTt0T5AWco9tXGdn',
        // Prop. nec. ID dell' elemento HTML in cui viene mostrata la mappa
        container: 'map',
        // (Non nec.) Centro della mappa iniziale
        center: coordinates,
        // (Non nec.) Zoom iniziale
        zoom: 16,

        minZoom: 6,
        // (Non nec.) Stile della mappa
        style: {
            map: 'basic_main-lite',
        }
    });

    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
    
    // Creazione del marker
    const marker = new tt.Marker({
        color: '#2271b3',
    }).setLngLat(coordinates)
    .setPopup(new tt.Popup({offset: 35})
    .setHTML(address))
    .addTo(map);
}