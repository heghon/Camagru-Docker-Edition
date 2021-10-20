// This function uses ajax function fetch to delete an image from the database by using the php file deleteImage.php.
// Then the page is reloaded to see the result.

function deleteImage(id) {
    fetch('/deleteImage.php?id=' + id + '', {method:"GET"})
    .then(response => {
      if (response.ok) return response;
      else throw Error(`Server returned ${response.status}: ${response.statusText}`)
    })
    .then(response => console.log(response.text()))
    .catch(err => {
      alert(err);
    });
    
    setTimeout(function (){
        location.reload();      
    }, 1000);
}