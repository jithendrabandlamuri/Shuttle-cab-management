new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            scrollwheel: false,
            center: new google.maps.LatLng(25.106333, 55.164035),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: {
                lat: 25.106333,
                lng: 55.164035
            },
            map: map,
            icon: "https://ezhire.life/landing/images/pin.png",
            title: 'EzHire'
        });</script> <script src="https://ezhire.life/landing/js/jquery-1.9.1.min.js"></script> <script src="https://ezhire.life/landing/js/bootstrap.min.js"></script> <script src="https://ezhire.life/landing/js/custom.js"></script> </body></html>