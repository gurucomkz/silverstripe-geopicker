window.jQuery.entwine('ss', function($) {
    $('.geo-picker-input').entwine({
        onmatch: function(){
            var me=$(this);
            var checker;
            var check = function(){
                me.data('timer',window.setTimeout(checker,100));
            };
            checker = function(){
                console.log('checking for google maps for '+me.attr('data-elid'));

                if(window.google && window.google.maps) {
                    init_geolocation_picker(me.attr('data-elid'));
                    me.data('timer',null);
                } else {
                    check();
                }

            }
            checker();
        },
        onunmatch: function(a,b){
            var timer = $(this).data('timer');
            if(timer) window.clearTimeout(timer);
        },
    })
});

function init_geolocation_picker(ID) {
    var findel = function(prefix) {
        return document.getElementById(prefix + 'Form_EditForm_'+ID) || document.getElementById(prefix +ID);
    }
    var input = findel('Input_');

    var mapOptions = {
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        // center: new google.maps.LatLng(-34.397, 150.644)
    };
    var val = input.value.split(',').map(parseFloat);
    if(val[0] && val[1]) {
        mapOptions.center = new google.maps.LatLng( val[0], val[1] );
        mapOptions.zoom = 16;
    }
    var map = new google.maps.Map(findel('Map_'),mapOptions);

    var setValue = function() {
        var center = map.getCenter(),
            val = [center.lat(),center.lng()].join(',');
        input.value = val;
    }

    map.addListener('zoom_changed', setValue);
    map.addListener('center_changed', setValue);

    var ACoptions = {
        // componentRestrictions: {country: 'au'}
    };
    // ac
    var autocomplete = new google.maps.places.Autocomplete(findel('AC_'), ACoptions);
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        if(place.geometry) {
            map.setCenter(place.geometry.location);
            map.setZoom(12);
        }
    });
}

