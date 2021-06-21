import axios from 'axios';
let apartment, views, messages;

axios.get(window.location.pathname.split('admin').shift()+'api/user/'+window.location.pathname.split("/").pop())
.then( (response) => {
    apartment = response.data;
    generateMap();
    generateStats();
});

function generateStats() {
    axios.get(window.location.pathname.split('admin').shift()+'api/user/'+window.location.pathname.split("/").pop()+'/views')
    .then( (response) => {
        views = response.data;
        axios.get(window.location.pathname.split('admin').shift()+'api/user/'+window.location.pathname.split("/").pop()+'/messages')
        .then( (response) => {
            messages = response.data;
            generateGraph(views, messages)
        });
    });
}

console.log(views);

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

function generateGraph(arr1, arr2) {
    var ctx = document.getElementById('myChart');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
            datasets: [
                {
                    label: 'N° di Visite',
                    data: arr1,
                    backgroundColor: [
                        'rgba(233, 74, 71, 0.2)'                    
                    ],
                    borderColor: [
                        'rgba(233, 74, 71, 1)',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'N° di Messaggi',
                    data: arr2,
                    backgroundColor: [
                        'rgba(99, 151, 208, 0.2)',                   
                    ],
                    borderColor: [
                        'rgba(99, 151, 208, 1)',
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}