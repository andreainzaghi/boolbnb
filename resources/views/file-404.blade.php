<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<style>
    *{
  margin:0;
  padding:0;
  box-sizing: border-box;
}
.banner{

  width: 100%;
  height:100vh;
}
.container{

  width: 100%;
  height:100vh;
  overflow: hidden;
  background:radial-gradient(#e1f1e5,#007fff);
}
#scene{
  cursor: context-menu;
  width: 100%;
  height:100vh;
  position: relative;
}
.container #scene .layer,
.container #scene .layer1,
.container #scene .layer2,
.container #scene .layer3,
.container #scene .layer4,
.container #scene .layer5,
.container #scene .layer6,
.container #scene .layer7,
.container #scene .layer77,
.container #scene .layer8,
.container #scene .layer9{
  width: 100%;
  height: 100vh;
  position: absolute;
  left:0;
  top:0;
  bottom: 0;
  right: 0;

}



.container #scene .layer img{
  width:280px;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:50%;

}
.container #scene .layer2 img{
  width:280px;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:50%;

}
.container #scene .layer3 img{
  width:280px;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:50%;

}
.container #scene .layer1 img{
  width:280px;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:50%;

}
.container #scene .layer9 img{
  width:160px;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:53%;
  top:22%;

}
.container #scene .layer img{
  width:280px;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:30%;

}
.container #scene .layer1 img {
  width:850px;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:55%;
}
.container #scene .layer2 img {
  width:108%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:70%;
}
.container #scene .layer3 img {
  width:90%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:20%;
}
.container #scene .layer4 img {
  width:90%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  top:20%;
}
.container #scene .layer5 img {
  width:109%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  bottom:-40%;
}
.container #scene .layer6 img {
  width:109%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  bottom:-28%;
}
.container #scene .layer7 img {
  width:109%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  bottom:-28%;
}
.container #scene .layer8 img {
  width:109%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  bottom:-32%;
}
.container #scene .layer9 img {
  width:15%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  bottom:62%;
}
.container #scene .layer77 img {
  width:35%;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  bottom:25%;
}
.lay2 .layer input{
  width:500px;
  height:50px;
  border: none;
  padding:10px;
  outline: none;
  font-size: 27px;
  border-radius: 40px;
  position: absolute;
  transform: translate(-50% ,-50%);
  left:50%;
  color:#fff;
  bottom:45%;
  background: linear-gradient(-45deg, rgba(0,0,0,0.22), rgba(255,255,255,0.25));
  box-shadow: 12px 12px 16px 0 rgba(0, 0, 0, 0.25),
  -8px -8px 12px 0 rgba(255, 255, 255, 0.3);
  background: linear-gradient(135deg, rgba(0,0,0,0.22), rgba(255,255,255,0.25));
}
.lay2{
  position: absolute;
  top:0;
  bottom:0;
  left:0;
  right:0;
}

</style>
<body>
  <section class="banner">
    <div class="container">
      <div id="scene">

<!-- donna -->
<!-- <div class="layer" data-depth="0.9"><img id="i1" src="img2/Background (25).png" alt=""width="100%"></div>
<div class="layer" data-depth="0.35"><img id="i9" src="img2/Background (28).png" alt=""width="100%"> </div>
<div class="layer" data-depth="0.65"><img id="i1" src="img2/Background (23).png" alt=""width="100%"></div>
<div class="layer1" data-depth="0.45"><img id="i2" src="img2/Background (22).png" alt=""width="100%"></div>
<div class="layer2" data-depth="0.4"><img id="i3" src="img2/Background (24).png" alt=""width="100%"></div>
<div class="layer3" data-depth="0.15"><img id="i9" src="img2/Background (21).png" alt=""width="100%"></div>
<div class="layer9" data-depth="0.24"><img id="i9" src="img2/Background (27).png" alt=""width="100%"> </div>
 -->

        <!-- mare -->
        <div class="layer" data-depth-x="0.25"><img id="i1" src="{{asset('img/Background (11).png')}}" alt=""width="100%"></div>
        <div class="layer1" data-depth-y="0.4"><img id="i2" src="{{asset('img/Background (14).png')}}" alt=""width="100%"></div>
        <div class="layer2" data-depth-x="0.2"><img id="i3" src="{{asset('img/Background (16).png')}}" alt=""width="100%"></div>
        <div class="layer9" data-depth-x="0.95"><img id="i9" src="{{asset('img/Background (19).png')}}" alt=""width="100%"></div>
        <div class="layer3" data-depth-y="0.1"><img id="i4" src="{{asset('img/Background (10).png')}}" alt=""width="100%"></div>
        <div class="layer4" data-depth-x="0.15"><img id="i5" src="{{asset('img/Background (9).png')}}" alt=""width="100%"></div>
        <div class="layer7" data-depth-x="0.35"><img id="i8" src="{{asset('img/Background (13).png')}}" alt=""width="100%"></div>
        <div class="layer5" data-depth-y="0.3"><img id="i6" src="{{asset('img/Background (15).png')}}" alt=""width="100%"></div>
        <div class="layer6" data-depth-x="0.5"><img id="i7" src="{{asset('img/Background (12).png')}}" alt=""width="100%"></div>
        <div class="layer8" data-depth-y="0.15"><img id="i9" src="{{asset('img/Background (18).png')}}" alt=""width="100%"></div>
        <div class="layer77" data-depth="0.25"><img id="i8" src="{{asset('img/Background (30).png')}}" alt=""width="100px"></div>
        <div class="layer77" data-depth="0.2"><img id="i8" src="{{asset('img/Background (31).png')}}" alt=""width="100px"></div>
        <div class="layer77" data-depth="0.15"><img id="i8" src="{{asset('img/Background (32).png')}}" alt=""width="100px"></div>
        <div class="layer77" data-depth="0.1"><img id="i8" src="{{asset('img/Background (33).png')}}" alt=""width="100px"></div>
      <!-- </div>
    </div>
  </section>
  <div class="lay2">
    <div class="layer">
      <input type="text" name="" value="">
    </div>-->
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
  <script >
  var scene = document.getElementById('scene');
  var parallaxInstance = new Parallax(scene);
</script>
</body>
</html>
