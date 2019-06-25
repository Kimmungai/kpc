<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<!--<script src="{{ asset('js/app.js') }}" defer></script>-->
<script src="{{ asset('js/kpc-validator.js') }}" defer></script>
<script src="{{ asset('js/jquery-ui.min.js') }}" defer></script>
<script src="{{ asset('js/kpc-datepicker.js') }}" defer></script>
<script src="{{ asset('js/kpc-forms.js') }}" defer></script>
<script src="{{ asset('js/kpc-stock-transfer.js') }}" defer></script>
<script src="{{ asset('js/kpc-booking-types.js') }}" defer></script>
<script src="{{ asset('js/kpc-search-supplier.js') }}" defer></script>
<script src="{{ asset('js/kpc-search-product.js') }}" defer></script>
<script src="{{ asset('js/kpc-save-purchases.js') }}" defer></script>
<script src="{{ asset('js/kpc-save-booking.js') }}" defer></script>
<script src="{{ asset('js/kpc-search-booked-prod.js') }}" defer></script>
<script src="{{ asset('js/kpc-save-transfer.js') }}" defer></script>


<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //site-theme styles-->
<link href="{{url('site-theme/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{url('site-theme/css/table-style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{url('site-theme/css/basictable.css') }}" />
<link href="{{url('site-theme/css/component.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{url('site-theme/css/export.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{url('site-theme/css/flipclock.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{url('site-theme/css/circles.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{url('site-theme/css/style_grid.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{url('site-theme/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
<!-- custom Styles -->
<!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
<link href="{{ asset('css/kpc-extras.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">

<!-- font-awesome-icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link href="{{url('site-theme/css/font-awesome.css') }}" rel="stylesheet">
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
</head>
<body>
	<!-- banner -->
	<div class="wthree_agile_admin_info">

		@if( !Request::is('/') )

			@component( 'components.nav-menu' )

	    @endcomponent

		@endif

		@if (session('message'))
			<div style="position:absolute;top:7em;width:100%;" class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>{{ session('message') }}</strong>
			</div>
		@endif
		@if (session('error'))
			<div style="position:absolute;top:7em;width:100%;" class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>{{ session('error') }}</strong>
			</div>
		@endif


		@yield('content')


	</div>
 <!-- banner -->
<!--copy rights start here-->
<div class="copyrights">
  <p>© {{date('Y')}} Kitui Pastoral Center. All Rights Reserved </p>
</div>
<!--copy rights end here-->
<!-- js -->

<script type="text/javascript" src="{{url('site-theme/js/jquery-2.1.4.min.js') }}"></script>

	<!-- /amcharts -->
				<script src="{{url('site-theme/js/amcharts.js') }}"></script>
		       <script src="{{url('site-theme/js/serial.js') }}"></script>
				<script src="{{url('site-theme/js/export.js') }}"></script>
				<script src="{{url('site-theme/js/light.js') }}"></script>
				<!-- Chart code -->
	 <script>
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "startDuration": 2,
    "dataProvider": [{
        "country": "Spoons",
        "visits": 500,
        "color": "#FF0F00"
    }, {
        "country": "China",
        "visits": 1882,
        "color": "#FF6600"
    }, {
        "country": "Japan",
        "visits": 1809,
        "color": "#FF9E01"
    }, {
        "country": "Germany",
        "visits": 1322,
        "color": "#FCD202"
    }, {
        "country": "UK",
        "visits": 1122,
        "color": "#F8FF01"
    }, {
        "country": "France",
        "visits": 1114,
        "color": "#B0DE09"
    }, {
        "country": "India",
        "visits": 984,
        "color": "#04D215"
    }, {
        "country": "Spain",
        "visits": 711,
        "color": "#0D8ECF"
    }, {
        "country": "Netherlands",
        "visits": 665,
        "color": "#0D52D1"
    }, {
        "country": "Russia",
        "visits": 580,
        "color": "#2A0CD0"
    }, {
        "country": "South Korea",
        "visits": 443,
        "color": "#8A0CCF"
    }, {
        "country": "Canada",
        "visits": 441,
        "color": "#CD0D74"
    }, {
        "country": "Brazil",
        "visits": 395,
        "color": "#754DEB"
    }, {
        "country": "Italy",
        "visits": 386,
        "color": "#DDDDDD"
    }, {
        "country": "Taiwan",
        "visits": 338,
        "color": "#333333"
    }],
    "valueAxes": [{
        "position": "left",
        "axisAlpha":0,
        "gridAlpha":0
    }],
    "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "colorField": "color",
        "fillAlphas": 0.85,
        "lineAlpha": 0.1,
        "type": "column",
        "topRadius":1,
        "valueField": "visits"
    }],
    "depth3D": 40,
	"angle": 30,
    "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha":0,
        "gridAlpha":0

    },
    "export": {
    	"enabled": true
     }

}, 0);
</script>
<!-- Chart code -->
<!--<script>
var chart = AmCharts.makeChart("chartdiv1", {
    "type": "serial",
	"theme": "light",
    "legend": {
        "horizontalGap": 10,
        "maxColumns": 1,
        "position": "right",
		"useGraphSettings": true,
		"markerSize": 10
    },
    "dataProvider": [{
        "year": 2017,
        "europe": 2.5,
        "namerica": 2.5,
        "asia": 2.1,
        "lamerica": 0.3,
        "meast": 0.2,
        "africa": 0.1
    }, {
        "year": 2016,
        "europe": 2.6,
        "namerica": 2.7,
        "asia": 2.2,
        "lamerica": 0.3,
        "meast": 0.3,
        "africa": 0.1
    }, {
        "year": 2015,
        "europe": 2.8,
        "namerica": 2.9,
        "asia": 2.4,
        "lamerica": 0.3,
        "meast": 0.3,
        "africa": 0.1
    }],
    "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.5,
        "gridAlpha": 0
    }],
    "graphs": [{
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Europe",
        "type": "column",
		"color": "#000000",
        "valueField": "europe"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "North America",
        "type": "column",
		"color": "#000000",
        "valueField": "namerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Asia-Pacific",
        "type": "column",
		"color": "#000000",
        "valueField": "asia"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Latin America",
        "type": "column",
		"color": "#000000",
        "valueField": "lamerica"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Middle-East",
        "type": "column",
		"color": "#000000",
        "valueField": "meast"
    }, {
        "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 0.3,
        "title": "Africa",
        "type": "column",
		"color": "#000000",
        "valueField": "africa"
    }],
    "rotate": true,
    "categoryField": "year",
    "categoryAxis": {
        "gridPosition": "start",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left"
    },
    "export": {
    	"enabled": true
     }
});
</script>-->

	<!-- //amcharts -->
		<script src="{{url('site-theme/js/chart1.js') }}"></script>
				<script src="{{url('site-theme/js/Chart.min.js') }}"></script>
		<script src="{{url('site-theme/js/modernizr.custom.js') }}"></script>

		<script src="{{url('site-theme/js/classie.js') }}"></script>
		<script src="{{url('site-theme/js/gnmenu.js') }}"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
			<!-- script-for-menu -->

<!-- /circle-->
	 <script type="text/javascript" src="{{url('site-theme/js/circles.js') }}"></script>
					         <script>
								var colors = [
										['#ffffff', '#fd9426'], ['#ffffff', '#fc3158'],['#ffffff', '#53d769'], ['#ffffff', '#147efb']
									];
								for (var i = 1; i <= 7; i++) {
									var child = document.getElementById('circles-' + i),
										percentage = 30 + (i * 10);

									Circles.create({
										id:         child.id,
										percentage: percentage,
										radius:     80,
										width:      10,
										number:   	percentage / 1,
										text:       '%',
										colors:     colors[i - 1]
									});
								}

				</script>
	<!-- //circle -->
	<!--skycons-icons-->
<script src="{{url('site-theme/js/skycons.js') }}"></script>
<script>
									 var icons = new Skycons({"color": "#fcb216"}),
										  list  = [
											"partly-cloudy-day"
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
								<script>
									 var icons = new Skycons({"color": "#fff"}),
										  list  = [
											"clear-night","partly-cloudy-night", "cloudy", "clear-day", "sleet", "snow", "wind","fog"
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
<!--//skycons-icons-->
<!-- //js -->
<script src="{{url('site-theme/js/screenfull.js') }}"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}



			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
		});
		</script>
		<script src="{{url('site-theme/js/flipclock.js') }}"></script>

	<script type="text/javascript">
		var clock;

		$(document).ready(function() {

			clock = $('.clock').FlipClock({
		        clockFace: 'HourlyCounter'
		    });
		});
	</script>
<script src="{{url('site-theme/js/bars.js') }}"></script>
<script src="{{url('site-theme/js/jquery.nicescroll.js') }}"></script>
<script src="{{url('site-theme/js/scripts.js') }}"></script>

<script type="text/javascript" src="{{url('site-theme/js/bootstrap-3.1.1.min.js') }}"></script>
@if( Request::is('users/*') )
<script type="text/javascript" src="{{url('site-theme/js/jquery.basictable.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
@endif
</body>
</html>
