var app = new Vue({
   el: '#app',
   data: {
     city: '',
     citySearched: '',
     apartments: [],
   },

   created() {
      let urlParams = new URLSearchParams(window.location.search);
      if ( urlParams.has('city') ) {
          this.city = urlParams.get('city');
      }
      this.apartmentsSearch(this.city);
  },
   methods:{

         // Ricerca sul database
      apartmentsSearch() {

               axios.get('http://localhost:8000/api/search',{
                     params: {
                        city: this.city
                     }
                  }).then((result)=>{

                     this.apartments = result.data;

                  });
            
                  this.citySearched = this.city;
                
      },

      nearBySearch() {
         axios.get('https://api.tomtom.com/search/2/nearbySearch/.json?lat=45.489862&lon=9.15045&radius=20000&idxSet=Addr&key=GAGkYaAlzOjYhzUBT6eMbAJSRhBfE5Ao',{
            params: {
               city: this.city
            }
         }).then((result)=>{

            console.log("Result: " + result);
            this.apartments = result.data;

         });
   
         //this.citySearched = this.city;
      }    
   }
 });