 function showRegistration() {
        var modalWin = document.getElementById('envelope');
        modalWin.style.display = 'block';
        var darkLayer = document.getElementById('fade');
        darkLayer.style.display = 'block';
    }
    function closeRegistration() {
         var modalWin =  document.getElementById('envelope');
         modalWin.style.display = 'none';
         var darkLayer = document.getElementById('fade');
         darkLayer.style.display = 'none';
         window.location.reload();
     }

 function showSignIn() {
     var modalWin = document.getElementById('envelope1');
     modalWin.style.display = 'block';
     var darkLayer = document.getElementById('fade');
     darkLayer.style.display = 'block';
 }
 function closeSignIn() {
     var modalWin =  document.getElementById('envelope1');
     modalWin.style.display = 'none';
     var darkLayer = document.getElementById('fade');
     darkLayer.style.display = 'none';
     window.location.reload();
 }
