@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Delivery In Hour</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
@endsection

@section('content')
    <style type="text/css">
        #map-canvas {
            border:1px solid red;margin-top: 135px;
            height: 720px;
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
    <div class="map" id="map-canvas" style=""></div>
    <br>
    {{--    <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;margin: 0 auto">--}}
    {{--        <a href="{{url('/store_main_data')}}" class="form-control index-footer set-right text-center" id="next-button">Next <i class="fa fa-arrow-right"></i></a>--}}
    {{--    </div>--}}
    <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;margin: 0 auto">
        <a class="form-control index-footer set-right text-center modaldata" id="next-button" data-target=".bs-example-modal-lg" data-toggle="modal">Next <i class="fa fa-arrow-right"></i></a>
    </div>
    <div class="modal fade in bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Plan Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button><br>

                </div>
                <div class="modal-body">
                    <form method="post" id="saveplan">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Enter Plan Name::</label>
                            <input type="text" class="form-control" id="planname" name="planname">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button"  id="submitplan" class="btn submitplan" data-id="save" style="background-color: #FFC56C;color: white;">Save Plan</button>
                    <button type="button" id="submitplanreq" class="btn submitplan" data-id="request"  style="background-color: #FFC56C;color: white;">Send Request</button>
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #FFC56C;color: white;">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('main_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
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

        $(document).ready(function() {
            $('.modaldata').on('click', function () {
                $('#exampleModal').show();
            });
            $('#saveplan').validate({
                rules: {
                    planname: {
                        required: true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        }
                    }
                },
            });

            $('.submitplan').on('click', function (e) {
                var req=$(this).attr("data-id");
                e.preventDefault();
                if ($('#saveplan').valid()) {
                    var planname = $("input[name=planname]").val();
                    $("input[name=planname]").val("");

                    window.swal({
                        title: "Submitting...",
                        text: "Please wait",
                        imageUrl: "{{url('public/images/Glowing_ring.gif')}}",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/save_request_plan')}}",
                        data: {_token: "{{ csrf_token() }}", planname: planname, req: req},
                        success: function (res) {
                            if (res.success == true) {
                                // alert("Price submitted successfully.");
                                setTimeout(function() {
                                    window.swal({
                                        title: "Finished!",
                                        text: res.message,
                                        type: "success",
                                        showConfirmButton: true,
                                        timer: 5000
                                    }, function () {
                                        window.location = "{{url('/store_plan_data')}}";
                                    });
                                },1000);

                            }
                            if (res.success == false) {
                                setTimeout(function() {
                                    window.swal({
                                        title: "Failed!",
                                        text: "Price Not submitted.",
                                        type: "error",
                                        showConfirmButton: true,
                                        timer: 5000
                                    });
                                },1000);
                            }
                        }
                    });
                }
            });
            $('#exampleModal').on('hidden.bs.modal', function () {
                $("input[name=planname]").val("");
                $("#saveplan").validate().resetForm();
            });
        });
    </script>
@endsection

