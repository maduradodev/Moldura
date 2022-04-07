const video = document.querySelector('video');
const overlay = document.getElementById('overlay');
const canvas = window.canvas = document.querySelector('canvas');
canvas.width = 1354;
canvas.height = 1000;

const saveToCanvas = (canvas) => {
  canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
  canvas.getContext('2d').drawImage(overlay, 0, 0, canvas.width, canvas.height);
  document.getElementById('again').classList.remove('hidden');
  document.getElementById('save').classList.remove('hidden');
};

const startCountDownCallback = (event) => {
  let timeleft = 6;
  const countDownElement = document.getElementById("countdown");
  countDownElement.innerHTML = `<span>${timeleft}</span>`;
  countDownElement.classList.toggle('hidden');

  const downloadTimer = setInterval(() => {
    if(timeleft <= 0){
      clearInterval(downloadTimer);
      document.getElementById("countdown").innerHTML = "";
    
      saveToCanvas(canvas);

      countDownElement.classList.toggle('hidden');
      countDownElement.innerHTML = '';
      timeleft = 6;
    } else {
      timeleft -= 1;
      countDownElement.innerHTML = `<span>${timeleft}</span>`;
      
    }
  }, 1000);
}

document.getElementById('capture').addEventListener('click', startCountDownCallback);
document.getElementById('again').addEventListener('click', startCountDownCallback);
document.getElementById('save').addEventListener('click',() => {


  $.ajax({
    type: "POST",
    url: "https://madurado.tech/Viatris/camera/upload.php",
    data: { 
        imgBase64: canvas.toDataURL()
    }
  }).done(function(data) {
    console.log(data);
    const response = JSON.parse(data);
    if(response.success){
      window.location.replace("https://madurado.tech/Viatris/camera/index.php");
    } else {
      alert(response.msg);
    }
  });
});

navigator.mediaDevices
  .getUserMedia({
    audio: false,
    video: true
  })
  .then((stream) => {
    document.getElementById('video-frame').classList.remove('hidden');
    window.stream = stream; // make stream available to browser console
    video.srcObject = stream;
  })
  .catch((error) => {
    console.log('navigator.MediaDevices.getUserMedia error: ', error.message, error.name);
  });