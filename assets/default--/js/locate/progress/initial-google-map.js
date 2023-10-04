var panorama;
var map;
var markers = [];
/***** function ในการประกาศค่าเริ่มต้นให้กับแผนที่*****/
function initMap() {

/***** ประกาศตำแหน่งพิกัดกึ่งกลางให้กับการแสดงผลแผนที่ ในที่นี้กำหนดเป็นกรุงเทพมหานคร*****/
var center_point = { lat: 13.7563309, lng: 100.50176510000006 };
var sv = new google.maps.StreetViewService();

/***** เป็นส่วนของการแสดงผลภาพจาก Street View *****/
panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'));

/***** กำหนดรายละเอียดคุณสมบัติของแผนที่*****/
var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: center_point.lat, lng: center_point.lng},
    zoom: 13,
    streetViewControl: false // เป็นส่วนที่ Set เพิ่มเติมจากปกติ
});

//sv.getPanorama({ location: center_point, radius: 50 }, processSVData);

/***** กำหนด event เมื่อมีการคลิกแผนที่*****/
map.addListener('click', function(event) {

    /***** ล้างข้อมูลการกำหนดจุด เพื่อให้มีการกำหนดจุดพิกัดเพียงจุดเดียว*****/
    for (i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }

    /***** ดึงค่าข้อมูลจาก Street View ตามพิกัดที่คลิกบนแผนที่ *****/
    //sv.getPanorama({ location: event.latLng, radius: 50 }, processSVData);
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
    'latLng': event.latLng
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {

            /***** แสดงผลข้อมูลรายละเอียดสถานที่*****/
            if (results[0]) {
                var place = results[0];
                for (var i = 0; i < place.address_components.length; i++) {
                    if (place.address_components[i].types[0] == 'postal_code') {
                        document.getElementById('postal_code').value = place.address_components[i].long_name;
                    }
                    if (place.address_components[i].types[0] == 'country') {
                        document.getElementById('country').value = place.address_components[i].long_name;
                    }
                }
                document.getElementById('location').value = results[0].formatted_address;
                document.getElementById('lat').value = results[0].geometry.location.lat();
                document.getElementById('lon').value = results[0].geometry.location.lng();
            }
        }
    });
});
/***** กำหนดตำแหน่งที่ตั้งของ control ที่จะวางในแผนที่*****/
var input = document.getElementById('searchInput');
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

/***** เพิ่ม Feature ให้กับ textbox ให้สามารถพิมพ์ค้นหาสถานที่ได้*****/
var autocomplete = new google.maps.places.Autocomplete(input);
autocomplete.bindTo('bounds', map);

var infowindow = new google.maps.InfoWindow();

/***** กำหนดคุณสมบัติให้กับตัวพิกัดจุดหรือ marker *****/
var marker = new google.maps.Marker({
map: map,
anchorPoint: new google.maps.Point(0, -29)
});
markers.push(marker); //เก็บค่าการกำหนดจุดพิกัดไว้ในตัวแปร markers เพื่อใช้ล้างข้อมูลการกำหนดจุดได้

/***** ทำงานกับ event place_changed หรือเมื่อมีการเปลี่ยนแปลงค่าสถานที่ที่ค้นหา*****/
autocomplete.addListener('place_changed', function() {
infowindow.close();
marker.setVisible(false);
var place = autocomplete.getPlace();
if (!place.geometry) {
window.alert("ไม่ค้นพบพิกัดจากสถานที่ดังกล่าว");
return;
}

/***** แสดงผลบนแผนที่เมื่อพบข้อมูลที่ต้องการค้นหา *****/
if (place.geometry.viewport) {
map.fitBounds(place.geometry.viewport);
} else {
map.setCenter(place.geometry.location);
//sv.getPanorama({ location: place.geometry.location, radius: 50 }, processSVData);
map.setZoom(17);
}
marker.setIcon(({
url: place.icon,
size: new google.maps.Size(71, 71),
origin: new google.maps.Point(0, 0),
anchor: new google.maps.Point(17, 34),
scaledSize: new google.maps.Size(35, 35)
}));
marker.setPosition(place.geometry.location);
marker.setVisible(true);

/***** แสดงรายละเอียดผลลัพธ์การค้นหา *****/
var address = '';
if (place.address_components) {
    address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
    }
    /***** แสดงรายละเอียดผลลัพธ์การค้นหาเป็น popup โดยมีชื่อและสถานที่ดังกล่าว *****/
    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);

    /***** แสดงรายละเอียดผลลัพธ์การค้นหา ซึ่งประกอบด้วย ที่อยู่ รหัสไปรษณีย์ ประเทศ ละติจูดและลองจิจูด *****/
    for (var i = 0; i < place.address_components.length; i++) {
        if(place.address_components[i].types[0] == 'postal_code'){
            document.getElementById('postal_code').value = place.address_components[i].long_name;
        }
        if(place.address_components[i].types[0] == 'country'){
        document.getElementById('country').value = place.address_components[i].long_name;
        }
    }
    document.getElementById('location').value = place.formatted_address;
    document.getElementById('lat').value = place.geometry.location.lat();
    document.getElementById('lon').value = place.geometry.location.lng();
});
}