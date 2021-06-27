@extends('layouts.base-box')

@section('pageTitle')
    {{ $apartment->title }} - Messaggi ricevuti
@endsection



@section('mainTitle')
    {{ $apartment->title }} - Messaggi ricevuti
@endsection

@section('MainContent')
    <div id="app-messages">
       
            <div class="list-group mt-5">
                <div :class="{ 'active': id == currentUser}" class="border list-group-item list-group-item-action message" v-for="(message, id) in messages" v-on:click="personalChat(id)">
                        <p>@{{ message.email }}</p>
                        <p class="message_button">@{{ message.date }} <i class="fas fa-trash-alt" :class="{ 'active_del': id == currentUser}" v-on:click="deleteMess(message.id)"></i></p>
                </div>
                

            </div>
            <transition id="details" name="slide-fade">
                <div class="container-messages" v-for="(message, id) in messages" v-if="currentUser == id">
                    <p>@{{ message.email }}</p>
                    <p>@{{ message.date }}</p>
                    <p>@{{ message.content }}</p>
                </div>
            </transition>    
      
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
<script>
let app = new Vue({
    el: '#app-messages',
    data: {            
        messages: [],
        idDelete: null,
        delete: false,
        currentUser: null,
        lastId: null,
        currentChat: null
    },
    mounted() {
        axios.get('/api/user/'+{{ $apartment->id }}+'/messages/json')
        .then( (response) => {
            this.messages = response.data;
        });
    },
    methods: {
        deleteMess(idMess){

            axios.get("/admin/messages/delete/"+idMess).then((response) => {

                console.log(this.messages)
                }, (err) => {

                    console.log("Error While Posting Data", err);
                });
               
                this.messages = this.messages.filter(function(e) { return e.id !== idMess })
         
                this.delete = true;
        },
        personalChat(id) {
      
            if( !this.delete ){
                if( id == this.lastId){
                    this.currentChat = null;
                    this.lastId = null;
                }
                else{
                    this.currentChat = this.messages[id];
                    this.lastId = id;
                }
                this.currentUser = this.lastId;
            }
     
            this.delete = false;
        
        }
    }
})
</script>
@endsection