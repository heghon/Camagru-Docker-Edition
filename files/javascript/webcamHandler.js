// Definition of important general variables.

var videoRunning = false;
var filterElement = document.getElementById("positionnedFilter");
var videoElement = document.getElementById("videoFeed");
var picElement = document.getElementById("outputImage");
var insertImageButton = document.getElementById("insertImageButton");
videoElement.style.display = "none";
insertImageButton.style.display = "block";
picElement.style.display = "block";

// This function launches the webcam stream if the user allows it and put all the elements at their right places.
// If the access is denied, an message is diplayed.

window.addEventListener("load", function(){

  document.getElementById("picUp").onclick = picUp;

  navigator.mediaDevices.getUserMedia({
    video: true
  })

  .then(function(stream) {
    var video = document.getElementById("videoFeed");
    video.srcObject = stream;
    video.play();
    videoRunning = true;
    videoElement.style.display = "block";
    picElement.style.display = "none";
    insertImageButton.style.display = "none";
  })

  .catch(function(err) {
    alert("Please enable access and/or attach a webcam");
  });
});

// This function allows the user to preview the chosen image if the webcam wasn't allowed.

function preview_image(event) 
{
var reader = new FileReader();
  reader.onload = function()
  {
    var output = document.getElementById('outputImage');
    output.src = reader.result;
  }
  reader.readAsDataURL(event.target.files[0]);
}

// This function takes a picture and upload it on the database.
// First, (1) it creates a snapshot from the video (or the chosen image) with a filter applied (mandatory).
// Then, (2) there is a conversion to blob data, in order to finally (3) upload it via an ajax protocol.
// At last, (4) the page is reloaded in order to see the new picture that was taken.

function picUp () {
  if (filterElement.src && (videoElement.style.display == "block" || (picElement.style.display == "block" && picElement.src)))
  {
    // (1)
    var canvas = document.createElement("canvas"),
      elementWidth = videoRunning ? document.getElementById("videoFeed").clientWidth : document.getElementById("outputImage").clientWidth,
      elementHeight = videoRunning ? document.getElementById("videoFeed").clientHeight : document.getElementById("outputImage").clientHeight,
      image = videoRunning ? document.getElementById("videoFeed") : document.getElementById("outputImage"),
      context2D = canvas.getContext("2d"),
      filterWidth = document.getElementById("positionnedFilter").clientWidth,
      filterHeight = document.getElementById("positionnedFilter").clientHeight;

    canvas.width = elementWidth;
    canvas.height = elementHeight;
    context2D.drawImage(image, 0, 0, elementWidth, elementHeight);
    context2D.drawImage(filterElement, (elementWidth / 2) - (filterWidth / 2), (elementHeight / 2) - (filterHeight / 2), filterWidth, filterHeight);


    // (2)
    canvas.toBlob(function(blob){
      var fd = new FormData();
      fd.append('upimage', blob);

      // (3)
      fetch('/upload.php', {method:"POST", body:fd})
      .then(response => {
        if (response.ok) return response;
        else throw Error(`Server returned ${response.status}: ${response.statusText}`)
      })
      .then(response => console.log(response.text()))
      .catch(err => {
        alert(err);
      });

    });
    // (4)
      setTimeout(function (){
        location.reload();      
      }, 1000);
      
  }
}

