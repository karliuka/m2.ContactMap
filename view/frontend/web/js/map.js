define(['jquery'],
function ($) {
    'use strict';
    return {
        config:{
            mapBoxClass: 'google-map',
            zoom:null,
            key:null,
            locale:null,
            disableDefaultUI: true,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false
        },

        locator:[],

        init:function(config){
            var script, scriptTag, src;

            this.config = $.extend({}, this.config, config);

            script = document.createElement('script');
            scriptTag = document.getElementsByTagName('script')[0];

            script.async = true;
            script.src = 'https://maps.googleapis.com/maps/api/js?key=' + this.config.key + '&language='  + this.config.locale;

            script.addEventListener('load', this.initMaps.bind(this));

            /*script.addEventListener('load', function () {
                var map = new google.maps.Map(document.getElementById('contact-map'), {
                    center: { lat: -34.397, lng: 150.644 },
                    zoom: 8,
                });
            });*/

            scriptTag.parentNode.insertBefore(script, scriptTag);

            //google.maps.event.addDomListener(window, 'load', this.initMaps.bind(this));
        },

        initMaps:function(){
            $('.' + this.config.mapBoxClass).each(function(key, mapBox) {
                this.initMap(key, mapBox);
            }.bind(this));
        },

        initMap:function(key, mapBox){
            var id = this.config.mapBoxClass + '-' + key;
            $(mapBox).attr('id', id);

            this.locator[key] = {
                bounds: new google.maps.LatLngBounds(),
                markers:[],
                map: new google.maps.Map(document.getElementById(id), {
                    disableDefaultUI: this.config.disableDefaultUI,
                    zoomControl: this.config.zoomControl,
                    mapTypeControl: this.config.mapTypeControl,
                    scaleControl: this.config.scaleControl,
                    streetViewControl: this.config.streetViewControl,
                    rotateControl: this.config.rotateControl
                })
            };
            var json = this.base64Decode($(mapBox).data('marker'));
            var collection = $.parseJSON(json);

            for (var i = 0; i < collection.length; i++) {
                if (collection[i].lat === null ||
                    collection[i].lng === null) {
                    continue;
                }
                var position = new google.maps.LatLng(
                    Number(collection[i].lat),
                    Number(collection[i].lng)
                );
                this.locator[key].bounds.extend(position);
                this.addMarker(position, key, collection[i].icon);
            }

            if (this.locator[key].markers.length < 1) {
                this.locator[key].map.setZoom(1);
                this.locator[key].map.setCenter({lat:0, lng:0});
                return;
            }

            this.setMarker(key);
            if (this.config.zoom){
                this.locator[key].map.setZoom(this.config.zoom);
                this.locator[key].map.setCenter(this.locator[key].bounds.getCenter());
            }else{
                this.locator[key].map.setCenter(
                    this.locator[key].bounds.getCenter(),
                    this.locator[key].map.fitBounds(this.locator[key].bounds)
                );
            }
        },

        /**
         * Adds a marker to the map.
         *
         * @param google.maps.LatLng position
         * @param integer key
         * @param string icon
         * @return void
         */
        addMarker: function(position, key, icon){
            var marker = new google.maps.Marker({
                position: position,
                draggable: false,
                icon: icon
            });
            this.locator[key].markers.push(marker);
        },

        /**
         * Renders the features on the specified map. If map is set to null, the features will be
         * removed from the map.
         *
         * @param integer key
         * @return void
         */
        setMarker: function(key) {
            for (var i = 0; i < this.locator[key].markers.length; i++) {
                this.locator[key].markers[i].setMap(this.locator[key].map);
            }
        },

        /**
         * Decodes data encoded with MIME base64.
         *
         * @param string data
         * @return string
         */
        base64Decode:function(data)
        {
            var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
            var o1, o2, o3, h1, h2, h3, h4, bits, i=0, enc='';
            do {
                h1 = b64.indexOf(data.charAt(i++));
                h2 = b64.indexOf(data.charAt(i++));
                h3 = b64.indexOf(data.charAt(i++));
                h4 = b64.indexOf(data.charAt(i++));

                bits = h1<<18 | h2<<12 | h3<<6 | h4;

                o1 = bits>>16 & 0xff;
                o2 = bits>>8 & 0xff;
                o3 = bits & 0xff;

                if (h3 == 64) enc += String.fromCharCode(o1);
                else if (h4 == 64) enc += String.fromCharCode(o1, o2);
                else enc += String.fromCharCode(o1, o2, o3);
            } while (i < data.length);
            return enc;
        }
    };
});
