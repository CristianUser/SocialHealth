let st;
function startCamera(){
    video = document.querySelector('#stream'), 
    canvas = document.querySelector('#canvas'), 
    btn = document.querySelector('#btnTake'), 
    img = document.querySelector('#img');

    navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
    if (navigator.getUserMedia){
        navigator.getUserMedia({video:true},function(stream){
            st=stream;
            video.src = window.URL.createObjectURL(stream);
            video.play();
        },function(e){console.log(e);})
    }
    else alert('Tienes un navegador obsoleto');

    video.addEventListener('loadedmetadata', function(){canvas.width = video.videoWidth; canvas.height = video.videoHeight;}, false);

    btn.addEventListener('click',function(){
        canvas.getContext('2d').drawImage(video,0,0);
        var imgData = canvas.toDataURL('image/png');
        img.setAttribute('src', imgData);
        basic.croppie('bind', {
            url: imgData,
            zoom:0
        });
        $('#example').hide();
        $('#btnCamera').show();
        $('#btnSelect').show();
        $('#btnTake').hide();
        $('#page').show();
        $('#btn').show();
        setTimeout(stopCamera,1000);
    })
}
stopCamera = ()=>{
    var track = st.getTracks()[0];
    track.stop();
};