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
<script src="{{ asset('js/kpc-generate-reports.js') }}" defer></script>
<script src="{{ asset('js/kpc-share-doc.js') }}" defer></script>


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
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/purchase.show.css') }}" rel="stylesheet">

<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">

<!-- font-awesome-icons -->
<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">-->
<link href="{{url('site-theme/css/font-awesome.css') }}" rel="stylesheet">
<!-- //font-awesome-icons -->
<!--<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">-->
</head>
<body>
	<!-- banner -->
	<div class="wthree_agile_admin_info">
		<?php $DEPATO = false; if(isset($dept)){$DEPATO = $dept;} ?>

		@if( !Request::is('login') )

			@component( 'components.nav-menu',['dept'=>$DEPATO] )

	    @endcomponent

		@endif

		@if (session('message'))
			<div style="position:absolute;top:8em;width:100%;" class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>{{ session('message') }}</strong>
			</div>
		@endif
		@if (session('error'))
			<div style="position:absolute;top:8em;width:100%;" class="alert alert-danger alert-dismissible" role="alert">
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
				@if( Route::is('dept report'))
				@if(isset($dept->product))
				@if(count($dept->product) > 2)
				<!-- Chart code -->
	 <script>
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "startDuration": 2,
    "dataProvider": [
		@if(isset($dept->product[0]))
		{
        "country": "{{$dept->product[0]->name}}",
        "visits": {{$dept->product[0]->quantity}},
        "color": "#FF0F00"
    },
		@endif
		@if(isset($dept->product[1]))
		{
        "country": "{{$dept->product[1]->name}}",
        "visits":{{$dept->product[1]->quantity}},
        "color": "#FF6600"
    },
		@endif
		@if(isset($dept->product[2]))
		{
        "country": "{{$dept->product[2]->name}}",
        "visits": {{$dept->product[2]->quantity}},
        "color": "#FF9E01"
    },
		@endif
		@if(isset($dept->product[3]))
		{
        "country": "{{$dept->product[3]->name}}",
        "visits": {{$dept->product[3]->quantity}},
        "color": "#FCD202"
    },
		@endif
		@if(isset($dept->product[4]))
		{
        "country": "{{$dept->product[4]->name}}",
        "visits": {{$dept->product[4]->quantity}},
        "color": "#F8FF01"
    },
		@endif
		@if(isset($dept->product[5]))
		{
        "country": "{{$dept->product[5]->name}}",
        "visits": {{$dept->product[5]->quantity}},
        "color": "#B0DE09"
    },
		@endif
		@if(isset($dept->product[6]))
		{
        "country": "{{$dept->product[6]->name}}",
        "visits": {{$dept->product[6]->quantity}},
        "color": "#04D215"
    },
		@endif
		@if(isset($dept->product[7]))
		{
        "country": "{{$dept->product[7]->name}}",
        "visits": {{$dept->product[7]->quantity}},
        "color": "#0D8ECF"
    },
		@endif
		@if(isset($dept->product[8]))
		{
        "country": "{{$dept->product[8]->name}}",
        "visits": {{$dept->product[8]->quantity}},
        "color": "#0D52D1"
    },
		@endif
		@if(isset($dept->product[9]))
		{
        "country": "{{$dept->product[9]->name}}",
        "visits": {{$dept->product[9]->quantity}},
        "color": "#2A0CD0"
    },
		@endif
		@if(isset($dept->product[10]))
		{
        "country": "{{$dept->product[10]->name}}",
        "visits": {{$dept->product[10]->quantity}},
        "color": "#8A0CCF"
    },
		@endif
		@if(isset($dept->product[11]))
		{
        "country": "{{$dept->product[11]->name}}",
        "visits": {{$dept->product[11]->quantity}},
        "color": "#CD0D74"
    },
		@endif
		@if(isset($dept->product[12]))
		{
        "country": "{{$dept->product[12]->name}}",
        "visits": {{$dept->product[12]->quantity}},
        "color": "#754DEB"
    },
		@endif
		@if(isset($dept->product[13]))
		{
        "country": "{{$dept->product[13]->name}}",
        "visits": {{$dept->product[13]->quantity}},
        "color": "#DDDDDD"
    },
		@endif
		@if(isset($dept->product[14]))
		{
        "country": "{{$dept->product[14]->name}}",
        "visits": {{$dept->product[14]->quantity}},
        "color": "#333333"
    }
		@endif
	],
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
@endif
@endif
@endif
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
<div class="loading-square hidden d-none">
	<img src="{{asset('images/loading.gif')}}" alt="">
</div>
</body>
</html>
