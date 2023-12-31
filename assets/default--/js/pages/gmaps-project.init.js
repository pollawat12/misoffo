! function (r) {
    "use strict";
    var e = function () {};

    /*
    e.prototype.createBasic = function (e) {
        return new GMaps({
            div: e,
            lat: -12.043333,
            lng: -77.028333
        })
    },
    13.724717,100.633072
    */ 
    e.prototype.createMarkers = function (e) {
        var t = new GMaps({
            div: e,
            lat: 13.761728,
            lng: 100.652790
        });
        return t.addMarker({
            lat: 13.761728,
            lng: 100.652790,
            title: "Lima",
            details: {
                database_id: 42,
                author: "HPNeo"
            },
            click: function (e) {
                console.log && console.log(e), alert("You clicked in this marker")
            }
        }), t.addMarker({
            lat: 13.724717,
            lng: 100.633072,
            title: "Marker with InfoWindow",
            infoWindow: {
                content: "<p>HTML Content</p>"
            }
        }), t
    }, 
    /*
    e.prototype.createWithPolygon = function (e, t) {
        var a = new GMaps({
            div: e,
            lat: -12.043333,
            lng: -77.028333
        });
        a.drawPolygon({
            paths: t,
            strokeColor: "#BBD8E9",
            strokeOpacity: 1,
            strokeWeight: 3,
            fillColor: "#BBD8E9",
            fillOpacity: .6
        });
        return a
    }, 
    e.prototype.createWithOverlay = function (e) {
        var t = new GMaps({
            div: e,
            lat: -12.043333,
            lng: -77.028333
        });
        return t.drawOverlay({
            lat: t.getCenter().lat(),
            lng: t.getCenter().lng(),
            content: '<div class="gmaps-overlay">Our Office!<div class="gmaps-overlay_arrow above"></div></div>',
            verticalAlign: "top",
            horizontalAlign: "center"
        }), t
    }, 
    e.prototype.createWithStreetview = function (e, t, a) {
        return GMaps.createPanorama({
            el: e,
            lat: t,
            lng: a
        })
    }, 
    e.prototype.createWithRoutes = function (e, t, a) {
        var n = new GMaps({
            div: e,
            lat: t,
            lng: a
        });
        return r("#start_travel").click(function (e) {
            e.preventDefault(), n.travelRoute({
                origin: [-12.044012922866312, -77.02470665341184],
                destination: [-12.090814532191756, -77.02271108990476],
                travelMode: "driving",
                step: function (e) {
                    r("#instructions").append("<li>" + e.instructions + "</li>"), r("#instructions li:eq(" + e.step_number + ")").delay(450 * e.step_number).fadeIn(200, function () {
                        n.setCenter(e.end_location.lat(), e.end_location.lng()), n.drawPolyline({
                            path: e.path,
                            strokeColor: "#131540",
                            strokeOpacity: .6,
                            strokeWeight: 6
                        })
                    })
                }
            })
        }), n
    }, 
    e.prototype.createMapByType = function (e, t, a) {
        var n = new GMaps({
            div: e,
            lat: t,
            lng: a,
            mapTypeControlOptions: {
                mapTypeIds: ["hybrid", "roadmap", "satellite", "terrain", "osm", "cloudmade"]
            }
        });
        return n.addMapType("osm", {
            getTileUrl: function (e, t) {
                return "http://tile.openstreetmap.org/" + t + "/" + e.x + "/" + e.y + ".png"
            },
            tileSize: new google.maps.Size(256, 256),
            name: "OpenStreetMap",
            maxZoom: 18
        }), n.addMapType("cloudmade", {
            getTileUrl: function (e, t) {
                return "http://b.tile.cloudmade.com/8ee2a50541944fb9bcedded5165f09d9/1/256/" + t + "/" + e.x + "/" + e.y + ".png"
            },
            tileSize: new google.maps.Size(256, 256),
            name: "CloudMade",
            maxZoom: 18
        }), n.setMapTypeId("osm"), n
    }, 
    e.prototype.createWithMenu = function (e, t, a) {
        new GMaps({
            div: e,
            lat: t,
            lng: a
        }).setContextMenu({
            control: "map",
            options: [{
                title: "Add marker",
                name: "add_marker",
                action: function (e) {
                    this.addMarker({
                        lat: e.latLng.lat(),
                        lng: e.latLng.lng(),
                        title: "New marker"
                    }), this.hideContextMenu()
                }
            }, {
                title: "Center here",
                name: "center_here",
                action: function (e) {
                    this.setCenter(e.latLng.lat(), e.latLng.lng())
                }
            }]
        })
    }, 
    */

    e.prototype.init = function () {
        var e = this;
        r(document).ready(function () {
            //e.createBasic("#gmaps-basic"), 
            e.createMarkers("#gmaps-markers");
            /*
            e.createWithPolygon("#gmaps-polygons", [
                [-12.040397656836609, -77.03373871559225],
                [-12.040248585302038, -77.03993927003302],
                [-12.050047116528843, -77.02448169303511],
                [-12.044804866577001, -77.02154422636042]
            ]), 
            e.createWithOverlay("#gmaps-overlay"), 
            e.createWithStreetview("#panorama", 42.3455, -71.0983), 
            e.createWithRoutes("#gmaps-route", -12.043333, -77.028333), 
            e.createMapByType("#gmaps-types", -12.043333, -77.028333), 
            e.createWithMenu("#gmaps-menu", -12.043333, -77.028333)
            */
        })
    }, r.GoogleMap = new e, r.GoogleMap.Constructor = e
}(window.jQuery),
function (e) {
    "use strict";
    window.jQuery.GoogleMap.init()
}();
