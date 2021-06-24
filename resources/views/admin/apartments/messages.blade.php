@extends('layouts.base-box')

@section('pageTitle')
    {{ $apartment->title }} - Messaggi ricevuti
@endsection

@section('styles')
    <style>
        .ur-wrapper {
            align-content: flex-start;
        }
        .list-group {
            width: 50%;
        }
        .list-group-item span {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: inline-block;
        }
        .list-item__top {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .list-item__bottom {
            overflow: hidden;
        }
        .list-item__bottom span {
            width: 100%;
        }
    </style>
@endsection

@section('mainTitle')
    {{ $apartment->title }} - Messaggi ricevuti
@endsection

@section('MainContent')
    <div id="app-messages">
       
            <div class="list-group mt-5">
                <div :class="{ 'active': id == currentUser}" class="border list-group-item list-group-item-action message" v-for="(message, id) in messages" v-on:click="personalChat(id)">
                        <p>@{{ message.email }}</p>
                        <p>@{{ message.date }}</p>
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
        personalChat(id) {
      
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
    }
})
</script>
@endsection