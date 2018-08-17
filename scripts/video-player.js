var video = document.getElementById('video')
var seekBar = document.getElementById("seekbar")
var progress = document.getElementById("progress")
var durationSpan = document.getElementById("duration")
var currentSpan = document.getElementById("current")
var nameSpan = document.getElementById("name")

progress.addEventListener('click', clickBar, false)

durationSpan.innerHTML = "00:00:00"
currentSpan.innerHTML = "00:00:00"
nameSpan.innerHTML = "Nome do arquivo"


function playVid() { 
    video.play();
    setInterval(update, 1000)
    durationTotal()
    renderTitle(video.currentSrc)
}

function renderTitle(src){
    var text = ''
    const fim = src.length - 4
    const inicio = src.lastIndexOf('/') + 1
    text = src.substring(inicio , fim )
    text = text.charAt(0).toUpperCase() + text.slice(1)
    nameSpan.innerHTML = text
}
            
function pauseVid() { 
    video.pause()
}

function update() {
    
	if (!video.ended && !video.paused) {
		var size=parseInt(video.currentTime*750/video.duration);
        seekBar.style.width=size+'px';
        seekBar.style.backgroundColor = '#273236';
        currentSpan.innerHTML = formatTime(video.currentTime)
	} 
}

function clickBar(e){
    if(!video.ended){
        var mouseX=e.pageX-progress.offsetLeft;
		var newtime=mouseX*video.duration/750;
		video.currentTime = newtime;
        seekBar.style.width = mouseX+'px';
    }
}

function volMenos(){
    if(video.volume > 0.05){
        var volume = video.volume;
        video.volume = volume - 0.05
    }else if(video.volume > 0.005){
        var volume = video.volume;
        video.volume = volume - 0.005
    }
}

function volMais(){
    if(video.volume > 0.95){
        video.volume = 1
    }
    if(video.volume < 1){
        var volume = video.volume;
        video.volume = volume + 0.05
    }

}

function voltar() {
    var time = video.currentTime; 
    if(time > 11){
        video.currentTime = time - 10;
    }
}

function avancar() { 
    var time = video.currentTime; 
    video.currentTime = time + 10;
    
}

function durationTotal(){
    var duration = video.duration
    durationSpan.innerHTML = formatTime(duration)
}


function formatTime(time){
    var hora = '00'
    var minuto = '00'     
    var segundo = '00'

    if(time > 60){
        minuto = time / 60;
        minuto = parseInt(minuto)
        segundo = time % 60
        segundo = parseInt(segundo)
        if(segundo.toString().length === 1){
            segundo = '0'+segundo
        }
        if(minuto.toString().length === 1){
            minuto = '0'+minuto
        }if(minuto > 60){
            hora = minutos / 60
        }else if(minuto < 60){
            hora = '00';
        }
    }else if(time < 60){
        segundo = parseInt(time)
        if(segundo.toString().length === 1){
            segundo = '0'+segundo
        }
    }
    var formatado = hora+':'+minuto + ':' + segundo
    return formatado;
}