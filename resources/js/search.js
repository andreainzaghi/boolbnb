var app = new Vue({
   el: '#app',
   data: {
       city: '',
       selected: '',
       apartments: [],
       baseURL: 'api/search',
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
           generateMap();
           });
       }
   },
   created() {
       let urlParams = new URLSearchParams(window.location.search);
       if ( urlParams.has('city') ) {
           this.city = urlParams.get('city');
       }
       this.search(this.city);
   }
});

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

function buildLocation(htmlParent, text) {
const details = htmlParent.appendChild(document.createElement('a'));
details.href = '#';
details.className = 'list-entry';
details.innerHTML = text;
return details;
}

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
                   "city": apartment.city
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
   
   const markersCity = [];
   const list = document.getElementById('apartments-list');
   
   // Ciclo gli appartamenti per creare marker e voce della lista
   apartments.features.forEach(function (apartment, index) {
   // seleziono l' elemento html
   let markerHTML = document.getElementById('markerHTML-' + index);
   // Salvo i dati
   const city = apartment.properties.city;
   const address = apartment.properties.address;
   const location = apartment.geometry.coordinates;
   let cityApartmentsList = document.getElementById(city);
   
   // Creazione del marker
   const marker = new tt.Marker({
       color: '#2271b3',
   }).setLngLat(location)
   .setPopup(new tt.Popup({offset: 35})
   .setHTML(address))
   .addTo(map);
   
   markersCity[index] = {marker, city};
   
   if (cityApartmentsList === null) {
       const cityApartmentsListHeading = list.appendChild(document.createElement('h3'));
       cityApartmentsListHeading.innerHTML = city;
       cityApartmentsList = list.appendChild(document.createElement('div'));
       cityApartmentsList.id = city;
       cityApartmentsList.className = 'list-entries-container';
       cityApartmentsListHeading.addEventListener('click', function (e) {
           map.fitBounds(getMarkersBoundsForCity(e.target.innerText), {padding: 50});
       });
   }
   
   const details = buildLocation(cityApartmentsList, address);
   
   marker._element.addEventListener('click',
       (function (details, city) {
           const activeItem = document.getElementsByClassName('selected');
           return function () {
               if (activeItem[0]) {
                   activeItem[0].classList.remove('selected');
               }
               details.classList.add('selected');
           }
       })(details, city)
   );
   
   details.addEventListener('click',
       (function (marker) {
           const activeItem = document.getElementsByClassName('selected');
           return function () {
               if (activeItem[0]) {
                   activeItem[0].classList.remove('selected');
               }
               details.classList.add('selected');
               map.easeTo({
                   center: marker.getLngLat(),
                   zoom: 18
               });
               closeAllPopups();
               marker.togglePopup();
           }
       })(marker)
   );
   })

}