// Initialize and add the map
function initMap() {
    // The location of CyberConf conference hall
    var cyberconf = {lat: 59.396590, lng: 24.667810};
    // The map, centered at CyberConf conference hall
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 12, center: cyberconf});
    // The marker, positioned at CyberConf conference hall
    var marker = new google.maps.Marker({position: cyberconf, map: map});
}