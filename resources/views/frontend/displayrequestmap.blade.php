@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Delivery In Hour</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

@endsection

@section('content')
    <style type="text/css">
        #map-canvas {
            border:1px solid red;
            height: 800px;
            width: 1890px;
        }
        .modal-content{
            border-radius: .1rem;
        }
        .modal-header{
            border-bottom: 1px solid #e9ecef;
        }
        .modal-footer{
            border-top: 1px solid #e9ecef;
        }
    </style>
{{--    {{dd(\Illuminate\Support\Facades\Session::get('statusofdelivery'))}}--}}
    <div class="map" id="map-canvas" style=""></div>
    <br>
    {{--    <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;margin: 0 auto">--}}
    {{--        <a href="{{url('/store_main_data')}}" class="form-control index-footer set-right text-center" id="next-button">Next <i class="fa fa-arrow-right"></i></a>--}}
    {{--    </div>--}}
    <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;margin: 0 auto">
        <a class="form-control set-right text-center back-button" href="{{url('/home_user')}}" style="width: 100%"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    @if($status=="Completed")
    <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;margin: 0 auto;margin-top: 14px;">
        <a class="form-control set-right text-center footer-button" href="{{ url('/review/'.$id.'/') }}" style="width: 100%;color: white">Give Review</a>
    </div>
    @endif


@endsection

@section('main_script')
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap&libraries=&v=weekly" defer></script>
    <script type="text/javascript">

        var myMarkers = new Array();
        var map;
        var locations = <?php print_r(json_encode($fromdata)) ?>;
        var alldata = <?php print_r(json_encode($alldata)) ?>;
        function initMap() {

            var directionsService = new google.maps.DirectionsService();

            var latlng = new google.maps.LatLng({{env('INIT_LAT')}}, {{env('INIT_LNG')}});
            var myOptions = {
                zoom: 3,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

            $.each(locations, function (index, value) {
                var data = new Array();
                $.each(alldata, function (index1, value1) {
                    if (value.id == value1.location_id) {
                        var origin = value1.fromlat + ', ' + value1.fromlong;
                        var destination = value1.tolat + ', ' + value1.tolong;

                        requestDirections(origin, destination,value1.color);
                        // calculateAndDisplayRoute(directionsService, directionsRenderer,origin,destination,value1.color,value1.packagecnt);

                        var data1 = new Array();
                        var html=`<p style="height: 10px;width: 10px;background-color:`+value1.color+`"></p>`;
                        data1.push(`<h6>`+html,value1.packagecnt+`</h6>`);
                        data1.push(`<h6>`+"Time:", value1.time+`</h6>`);
                        data1.push(`<h6>`+"Distance:", value1.km+`</h6>`);
                        data1.push(`<h6>`+value1.atobdata+`</h6>`);
                        data1.push(`<hr>`);
                        data.push(data, data1.join(' '));
                    }
                });

                var myLatLng = {lat: parseFloat(value.lat), lng: parseFloat(value.long)};
                if(data.length==0){
                addmarker(myLatLng,value.street_add);
                }
                else{
                    addmarker(myLatLng,value.street_add,data);
                }

            });

            function addmarker(myLatLng,add,data) {

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    // icon: icons[value.icon].icon,
                    title: add,
                    map: map
                });

                // create the info windows
                var infowindow = new google.maps.InfoWindow({
                    content: '<div>' +
                        data.join(' ')+
                        '</div>',
                });

                // Open the infowindow on marker click
                google.maps.event.addListener(marker, "click", function () {
                    infowindow.open(map, marker);
                });
            }

            function renderDirections(result, color) {
                // var directionsRenderer = new google.maps.DirectionsRenderer();
                var directionsRenderer = new google.maps.DirectionsRenderer({
                    suppressMarkers: true,//important to hide direction api marker
                    polylineOptions: {
                        strokeColor: color,
                    }
                });
                directionsRenderer.setMap(map);
                directionsRenderer.setDirections(result);
            }


            function requestDirections(start, end, color) {
                directionsService.route({
                    origin: start,
                    destination: end,
                    travelMode: "DRIVING",
                }, function (result) {
                    renderDirections(result, color);
                });

            }
        }




    </script>
@endsection

