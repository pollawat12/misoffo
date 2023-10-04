var x = document.getElementById("demo");

let locations = [];
function initMap(latitude="", longitude="") {
    if (latitude == "") {
        latitude = 12.690517348122633;
        longitude = 101.14488398767735;
    }
    locations = {lat:latitude, lng:longitude};
    console.log(locations);
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: new google.maps.LatLng(latitude, longitude),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    // alert(locations);
    new google.maps.Marker({
        position: locations,
        map: map,
        title: "พิกัดพบสิ่งมีชีวิต!",
    });
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } 
    // else { 
    //     x.innerHTML = "Geolocation is not supported by this browser.";
    // }
}

function showPosition(position) {
    $("#latitude").val(position.coords.latitude);
    $("#longitude").val(position.coords.longitude);
}