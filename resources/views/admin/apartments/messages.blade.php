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
    <div class="list-group" id="app" >
       
            <div class="list-group-item  list-group-item-action" v-for="(message,id) in messages" v-on:click="personalChat">
                <span class="list-item__top">
                    <span>@{{ message.email }}</span>
                    <span>@{{ message.date }}</span>
                </span>
                <span class="list-item__bottom mt-2">
                    <span>@{{ message.content }}</span>
                </span>
            </div>
            <div class="container-messages">
                <span>@{{ message[CurrentUser].email }}</span>
                <span>@{{ message[CurrentUser].date }}</span>
                <span>@{{ message[CurrentUser].content }}</span>
            </div>
      
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
<script>
    new Vue({
        el: '#app',
        data : {
            
                messages :[],
                currentUser:''   
  },
  mounted : {
    axios.get('/api/user/'+{{ $apartment->id }}+'/messages/json')
        .then( (response) => {
        messages = response.data;
});
  },
  methods:{
    personalChat:function(){
        this.currentUser = id;
    }
  }
})
</script>
@endsection