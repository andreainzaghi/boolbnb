var app = new Vue({
   el: '#app',
   data: {
     city: '',
     apartments: []
   },

   mounted() {
      alert(this.city);
   },
   methods:{

      search(){
         // axios
         // .get('localhost//...')
         // .then(response => (this.info = response))
      }
   }
 })