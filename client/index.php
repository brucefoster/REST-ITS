<!DOCTYPE html>
<html ng-app="requestBuilder">
<head>
	<meta charset="utf-8" />
	<meta name="google" value="notranslate" />
	<title>WebPS REST API Testing Tool</title>
	<link rel="shortcut icon" href="/client/favicon.png" />

	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="/client/js/plugin.selectbox/js/bootstrap-select.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
	
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/client/js/plugin.selectbox/css/bootstrap-select.css" />
	<style type="text/css">
		html,body {
			padding: 0;
			margin: 0;
			width: 100%;
		}

		.heading {
			background: #F2F7FF;
			padding: 10px 20px 10px 20px;
			border-bottom: solid 1px #B7D0E5;
		}

		.heading h1 {
			color: #2A6799;
			margin: 0 0 0 50px;
			font: bold 22px Arial;
		}

		.heading h1 span {
			color: #2A6799;
			margin: 0px;
			font: 22px/34px Arial;
		}

		.label {
			font: 14px Arial;
			color: #505050;
			padding: 0px;
			margin: 0px 0px 0 0;
		}

		.full {
			width: 100%;
		}

		.window {
			display: table;
			vertical-align: top;
			width: 1000px;
			max-width: 1000px;
			margin: 0 auto 0 auto;
		}

		.container {
			padding: 50px;
			display: table-cell;
			vertical-align: top;
			margin: 0;
		}

		.sidebar {
			padding: 50px 50px 0px 0px;
			width: 320px !important;
			min-width: 320px !important;
			display: table-cell;
			vertical-align: top;
			vertical-align: top;
		}

		.menu {
			padding: 20px;
			background: #E8EAF1;
			border: solid 0px red;
			border-radius: 4px;
			margin-bottom: 10px;
		}

		.menu h3 {
			font: bold 14px Arial;
			margin: 0px;
			margin-bottom: 10px;
			color: #505050;
			text-transform: uppercase;
		}

		input[type=text]:not( .css_free ) {
			font: 16px Arial;
			margin-top: 10px;
		}

		.longinput {
			width: 400px;
			display: inline-block;
		}

		.linksblock a {
			color: #304683;
			font: 14px/30px Arial;
			text-decoration: none;
			border-bottom: solid 1px #C1C8DA;
			padding-bottom: 2px;
		}

		.linksblock a:hover {
			color: #BC2929;
			border-bottom: solid 1px #CDA4A4;
		}

		.opentree {
			border: solid 1px #304683;
			width: 18px;
			height: 18px;
			text-align: center;
			background: #304683;
			color: white;
			font: bold 10px/18px Arial;
			border-radius: 3px;
			margin-right: 5px;
			vertical-align: middle;
			display: inline-block;
		}

		.opentreetext {
			font: bold 14px/18px Arial;
			color: #304683;
			display: inline-block;
		}

		.intree {
			padding-top: 5px;
			padding-left: 14px;
			border-left: solid 1px #C5CBDC;
			margin-left: 9px;
		}

		.space {
			width: 100%;
			height: 30px;
		}

		.space-small {
			width: 100%;
			height: 15px;
		}

		label:not( .css_free ) {
			0margin-right: 30px;
		}

		.btn-group {
			margin-right: 10px;
			display: inline-block !important;
		}

		.btn-group:last-child {
			margin-right: 0px;
		}

		.inline {
			display: inline-block !important;
		}

		table tr td:first-child {
			padding-right: 10px;
		}

		table tr td:last-child {
			padding-left: 10px;
			padding-top: 10px;
		}

		table tr td:last-child button {
			vertical-align: middle !important;
		}

		.times {
			font-size: 26px;
			text-align: center;
			color: #808080;
			padding-left: 10px;
			padding-top: 10px;
			vertical-align: middle;
		}

		.csshidden {
			display: none;
		}

		textarea {
			min-height: 150px;
		}

		.requestsent {
			margin-left: 15px;
			color: green;
		}

		.tooltip-inner {
			padding: 5px 10px 5px 10px;
			font-size: 13px;
		}

		.title {
			margin: 20px 0 5px 0;
		}

		.title.empty {
			color: #959595;
		}

		.title.empty span {
			color: #BBBBBB;
			font-size: 20px;
			padding-left: 5px;
		}

		input.title {
			color: #193175 !important;
			display: block;
			font-size: 24px;
			line-height: 26.4px;
			border: solid 0px white;
			border-bottom: solid 2px #CCD4EA;
			padding: 0px 0 5px 0;
			min-width: 500px;
			margin-top: 20px;
			margin-bottom: 16px;
		}

		textarea:focus, input:focus{
			outline: none;
		}

		h3.title span {
			cursor: pointer;
		}

		label div.grey {
			color: #BBBBBB;
			padding-left: 0px;
			text-align: left;
			display: block;
			font-size: 12px;
			line-height: 24px;
			width: 230px;
		}

		label {
			padding-top: 5px;
			padding-bottom: 10px;
			vertical-align: top;
		}

		.optionmark {
			margin-left: 10px;
			margin-right: 5px;
			font-size: 18px;
			padding: 2px 5px 8px 5px;
			color: #BBBBBB;
			vertical-align: top;
			margin-top: 5px;
			border-bottom: solid 3px #EEEEEE;
		}

		.optionmark.enabled {
			color: #2767B5;
			border-bottom: solid 3px #ABC1DB;
		}

		.nav-tabs {
		}

		.bootstrap-switch {
			margin-right: 10px;
		}

		.request_error_data {
			margin-top: 20px;
		}

		.btn-default .btn-default:not( .toggle-handle ) {
			border: none;
			background: #EEEEEE;
		}

		.btn-default .toggle-handle {
			background: #FFFFFF;
		}

		.toggle {
			margin-right: 10px;
		}

		.httpauth {
			display: none;
			padding: 10px 0 0px 25px;
			margin: 15px 0 0 75px;
			border-left: solid 3px #EEEEEE;
		}
	</style>

</head>
<body>
	<div class="heading">
		<div class="window"><h1>WebPS <span>&rsaquo; REST API Request Processor</span></h1></div>
	</div>
	<div class="full">
	<div class="window">
	<div class="container">
		<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="#">Request Master</a></li>
			<li role="presentation"><a href="#">Plain request editor</a></li>
			<li role="presentation"><a href="#">Testing Scenarios</a></li>
			<li role="presentation"><a href="#">Saved Requests</a></li>
			<li role="presentation"><a href="#">Global Settings</a></li>
			<li role="presentation"><a href="#">Logs & History</a></li>
		</ul>
		<div class="tab request-builder" ng-controller="requestNameController" >
		<h3 class="title empty" ng-show="!requestRenameMarker">{{requestName + ' '}}<span ng-click="changeReqName( $event )">[click to change]</span></h3>
		<form ng-submit="updateName( $event )">
			<input type="text" ng-name="requestName" ng-blur="updateName( $event )" ng-show="requestRenameMarker" class="title requestTitle empty" placeholder="Untitled Request" />
			<input type="submit" style="visibility: hidden" />
		</form>

		<div class="label">URL of REST API provider:</div>
		<label class="checkbox" style="float: right;vertical-align: top;margin: 0;margin-top: -2px;padding: 0px;font-weight: normal;">
					<input type="checkbox" class="showrequestheaders"> Follow redirections
				</label>
		<br />
		<select name="method" class="selectpicker_method" data-width="auto">
			<option value="GET" selected>GET Request</option>
			<option value="POST" >POST Request</option>
			<option value="d" >DELETE Request</option>
			<option value="pu" >PUT Request</option>
		</select>
		<input type="text" class="form-control desturl" ng-model="test" style="display: inline-block;width: 730px;" data-toggle="tooltip" title="Enter destination URL first." placeholder="http://" />
		<div class="space"></div>
		
		<h4 style="font-weight: bold;padding: 10px 0 0 0;margin: 0;">Parameters to send</h4>
		<div class="checkbox inline">
			<label class="raw_show_label">
				<input type="checkbox" class="raw_show"> Input RAW data manually instead of dataset
			</label>
		</div>
		<div class="raw csshidden">
			<textarea class="form-control raw_data" placeholder="param1=value1&amp;param2=value2 etc."></textarea>
			<div class="space-small"></div>
			<button type="button" class="btn btn-default converttoparams">Convert to params</button>
		</div>
		<div class="dataset">
			<table class="params" style="width: 100%;margin-top: -20px;">
				<tr>
					<td style="width: 35%;"></td>
					<td style="width: 60%;"></td>
					<td style="width: 5%;"></td>
				</tr>
				<tr>
					<td><input type="text" class="form-control" placeholder="parameter" /></td>
					<td><input type="text" class="form-control" placeholder="value" /></td>
					<td><button type="button" class="btn btn-danger" onclick="deleteParam(this)">Delete</button></td>
				</tr>
			</table>
			<div class="space-small"></div>
			<button type="button" class="btn btn-default addparam">Add new parameter</button> - or - 
			<button type="button" class="btn btn-default converttoraw">Convert to RAW</button>
		</div>

		<div class="space"></div>

		<h4 style="font-weight: bold;padding: 10px 0 0 0;margin: 0;"><input type="checkbox" class="add_auth" data-toggle="toggle"> HTTP Basic authentication</h4>
		<script type="text/javascript">
		$(function() {
			$( '.add_auth' ).change(function() {
				if( $( this ).prop( 'checked' ) == true ) {
					$( '.httpauth' ).slideDown( 200 );
				} else {
					$( '.httpauth' ).slideUp( 150 );
				}
			});
		});
		</script>
		<form class="httpauth">
		  <div class="form-group ">
			<label>Username: </label>
			<input type="text" class="form-control css_free longinput httpauth_user" placeholder="HTTP Basic auth login">
		  </div>
		  <div class="form-group">
			<label>Password: </label>
			<input type="text" class="form-control css_free longinput httpauth_pass" placeholder="HTTP Basic auth password (visible)">
		  </div>
		</form>

		<h4 style="font-weight: bold;padding: 10px 0 0 0;margin: 0;"><input type="checkbox" class="add_headers" data-toggle="toggle"> Headers</h4>
		<script type="text/javascript">
		$( ".add_headers" ).bootstrapSwitch();</script>
		

		<h4 style="font-weight: bold;padding: 10px 0 0 0;margin: 0;"><input type="checkbox" class="add_headers" data-toggle="toggle"> Testing Scenario</h4>
		<script type="text/javascript">
		$( ".add_headers" ).bootstrapSwitch();</script>
		


		<div class="space"></div>
		<button type="button" class="btn btn-primary btn-lg sendrequst" onclick="runRequest();" data-loading-text="Processing request..."><span class="glyphicon glyphicon-flash"></span> Send request</button> 
		<span class="glyphicon glyphicon-share-alt optionmark enabled" ng-mouseover="redirTooltip( $event )" data-toggle="tooltip" title="Redirections enabled"></span>
		<span class="glyphicon glyphicon-lock optionmark" ng-mouseover="redirTooltip( $event )" data-toggle="tooltip" title="Authentication disabled"></span>
		<div style="display: inline-block;"><div class="requestsent csshidden"><span class="glyphicon glyphicon-ok"></span> &nbsp;Done</div></div>
		<div class="alert alert-danger csshidden request_error_data" role="alert"></div>
		<div class="result_rows csshidden">	
			<div class="csshidden headers_request_result">
				<div class="space"></div>
				<div class="label">Request headers:</div>
				<div class="space-small"></div>
				<pre></pre>
			</div>
			<div class="csshidden headers_response_result">
				<div class="space"></div>
				<div class="label">Response headers:</div>
				<div class="space-small"></div>
				<pre></pre>
			</div>
			<div class="csshidden sent_data">
				<div class="space"></div>
				<div class="label">Sent data (RAW):</div>
				<div class="space-small"></div>
				<pre></pre>
			</div>
			<div class="csshidden request_result">
				<div class="space"></div>
				<div class="label">Response: &nbsp; &nbsp; 
				<span class="glyphicon glyphicon-time"></span>&nbsp; got in <span class="time"></span>s  
				&nbsp; &nbsp; <span class="glyphicon glyphicon-hdd"></span>&nbsp; status: <span class="state"></span> 
				</div>
				<div class="space-small"></div>
				<pre></pre>
			</div>

			<div class="space-small"></div>
			<button type="button" class="btn btn-default" onclick="WebPS_Page_BackToTop()"><span class="glyphicon glyphicon-arrow-up"> </span> &nbsp; Back to params</button> &nbsp; 
			<button type="button" class="btn btn-link addparam"><span class="glyphicon glyphicon-repeat"> </span> &nbsp; Repeat request</button> &nbsp; 
			<button type="button" class="btn btn-primary saverequest"><span class="glyphicon glyphicon-floppy-disk"> </span> &nbsp; Save request</button>
		</div>
	</div>
	</div>
	<!--div class="sidebar">
		<div class="menu">
			<h3>Saved Requests</h3>
			<div class="opentree">+</div>
			<div class="opentreetext">studcenter.mtuci.ru</div>
			<div class="linksblock intree" id="saved">
			<a href="">auth user</a><br />
			<a href="">use session to auth</a>
			</div>
		</div>
		<button type="button" class="btn btn-default btn-sm">Export requests</button> &nbsp; <button type="button" class="btn btn-default btn-sm">Import requests</button>
	</div-->
	</div>
	</div>

	<div class="modal fade saveRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">Save request</h4>
		  </div>
		  <div class="modal-body">
			<form>
			  <div class="form-group">
				<label for="recipient-name" class="control-label">Name your request:</label>
				<input type="text" class="form-control" id="request-name">
			  </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			<button type="button" class="btn btn-primary" onclick="WebPS_SaveSystem_Save()">Save request</button>
		  </div>
		</div>
	  </div>
	</div>

	<div class="modal fade requestErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Error was occurred</h4>
	  </div>
	  <div class="modal-body">
		...
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="runRequest();">Repeat request</button>
	  </div>
	</div>
  </div>
</div>
	<script type="text/javascript">
		var app = angular.module( 'requestBuilder', [] );
		app.controller( 'requestNameController', function( $scope ) {
			$scope.requestName = "Untitled Request";
			$scope.requestRenameMarker = false;

			$scope.changeReqName = function(clickEvent) {
				$scope.requestRenameMarker = true;
				setTimeout( function() { $( '.requestTitle' ).focus() }, 20 );
	  		}

			$scope.updateName = function(clickEvent) {
				if( $( '.requestTitle' ).val() ) {
					$scope.requestName = $( '.requestTitle' ).val();
					$scope.requestRenameMarker = false;
					$( 'h3.title' ).css( { color: '#172D6B' } );
				} else {
					$scope.requestName = "Still Untitled Request";
					$scope.requestRenameMarker = false;
				}
				return false;
	  		}

			$scope.redirTooltip = function( obj ) {
				$( obj.target ).tooltip('show');
				return false;
	  		}
		} );

		var newParam = '<tr>' + ( $( '.params tr:eq(1)' ).html() ) + '</tr>';

		$( '.params tr:eq(1)' ).remove();
		$( '.raw_show' ).click( function() {
			if( $( '.raw_show' ).is( ':checked' ) ) {
				$( '.raw' ).slideDown( 100 );
				$( '.dataset' ).slideUp( 100 );
			} else {
				$( '.dataset' ).slideDown( 100 );
				$( '.raw' ).slideUp( 100 );
			}
		});

		$( '.addparam' ).click( function() {
			$( '.params' ).append( newParam );
			//$( '.converttoparams' ).prop( 'disabled', true );
		} );


		$( '.saverequest' ).click( function() {
			$( '.saveRequest' ).modal( 'show' );
		} );


		$( '.converttoraw' ).click( function() {
			raw = '';
			valueTime = false;
			$.each( $( '.params tr td input' ), function( index, obj ) {
				value = ( $( obj ).val() );
				if( valueTime === false ) {
					raw += ( raw === '' ? '' : '&' ) + value;
					valueTime = true;
				} else {
					raw += '=' + value;
					valueTime = false;
				}
				$( '.raw_data' ).val( raw );
				$( '.raw_show' ).prop( 'checked', true );
				$( '.raw' ).slideDown( 100 );
				$( '.dataset' ).slideUp( 100 );
			} );
			$( '.raw_show_label' ).prop( 'disabled', true );
			$( '.raw_show' ).prop( 'disabled', true );
		} );

		$( '.converttoparams' ).click( function() {
			$( '.params tr:not(:eq(0))' ).remove();
			val = $( '.raw_data' ).val().toString();
			$.each( val.split( '&' ), function( index, obj ) {
				param = obj.toString().split( '=' )[ 0 ];
				val = obj.toString().split( '=' )[ 1 ];
				$( '.params' ).append( newParam.replace( 'ter"', 'ter" value="' + param + '"').replace( 'ue"', 'ue" value="' + val + '"') );
				
			} );
			$( '.raw_show_label' ).prop( 'disabled', true );
			$( '.raw_show' ).prop( 'disabled', true );
			$( '.raw_show' ).prop( 'checked', false );
				$( '.dataset' ).slideDown( 100 );
				$( '.raw' ).slideUp( 100 );
		} );

		function deleteParam( row ) {
			$( row ).parent().parent().remove();
		}

		function getPlainRAW() {
			raw = '';
			if( $( '.raw_show' ).is( ':checked' ) ) {
				raw = $( '.raw_data' ).val().toString();
			} else {
				valueTime = false;
				$.each( $( '.params tr td input' ), function( index, obj ) {
					value = ( $( obj ).val() );
					if( valueTime === false ) {
						raw += ( raw === '' ? '' : '&' ) + value;
						valueTime = true;
					} else {
						raw += '=' + value;
						valueTime = false;
					}
				} );
			}
			return raw;
		}

		function prepareParams() {
			var raw = getPlainRAW();
			var response = 
				'webps_rp=true&data=' + 
				raw.split('&').join('/$webps:s_and/').split('=').join('/$webps:s_eq/') + 
				'&url=' + $( '.desturl' ).val() +
				'&method=' + $( '.selectpicker_method' ).val();
			if( $( '.add_auth' ).prop( 'checked' ) == true ) {
				response += '&auth=' + $( '.httpauth_user' ).val() + '~$$' + $( '.httpauth_pass' ).val();
			}
			// alert( response );
			return response;
		}

		var responseWindowShown = false;
		function runRequest() {
			var $btn = $( '.sendrequst' ).button( 'loading' );
			if( $( '.desturl' ).val().length == 0 ) {
				$( '.desturl' ).tooltip('show');
				return false;
			}

			if( responseWindowShown ) {
				$( '.result_rows' ).fadeTo( 100, 0.2 );
			}

			$.post( "/send", prepareParams(), function( data ) {
				result = JSON.parse( data );

				/*
				======================
				Handling errors
				======================
				*/
				if( result[ 'error' ] ) { 
					$( '.requestErrorModal' ).modal( 'show' );
					$( '.requestErrorModal .modal-body' ).html( '' );
					$( '.requestErrorModal .modal-body' ).append( 'This is all the info we have for this error.<br /><hr />' );
					$( '.requestErrorModal .modal-body' ).append( '<div style="display: inline-block;width: 150px;line-height: 24px;font-weight: bold;">Error name:</div>' + '<code>' + result[ 'error' ] + '</code><br />' );
					$( '.requestErrorModal .modal-body' ).append( 
						'<div style="display: inline-block;width: 150px;line-height: 24px;font-weight: bold;vertical-align: top;">Error description:</div>' + 
						'<samp style="display: inline-block;width: 380px;vertical-align: top;padding-top: 3px;">' + result[ 'error_description' ] + 
						'</samp>' 
					);
					/*$( '.request_error_data' ).html( '<b>Error: </b>' + result[ 'error' ] );
					$( '.request_error_data' ).slideDown( 200 );
					$('html, body').animate({
						scrollTop: $( ".request_result" ).offset().top
					}, 620 );*/
					$btn.button( 'reset' );
					return;
				}
				$( '.requestsent' ).fadeIn( 60 );
				setTimeout( function(){ $( '.requestsent' ).fadeOut( 60 ); }, 1000 );

				response = result[ 'response_data' ];
				//response = JSON.stringify( JSON.parse( response ), null, 3 );

				$btn.button( 'reset' );

				$( '.result_rows' ).slideDown( 100 );

				$( '.headers_request_result pre' ).html( '' );
				for( header in result[ 'request_headers' ] ) {
					$( '.headers_request_result pre' ).append( 
						'<div style="font-weight: bold; width: 180px;display: inline-block;">' + 
						_formatHeader( header ) + ': </div>' + result[ 'request_headers' ][ header ] + '<br />' );
				}
				$( '.headers_request_result' ).slideDown( 100 );

				
				$( '.headers_response_result pre' ).html( '' );
				for( header in result[ 'response_headers' ] ) {
					$( '.headers_response_result pre' ).append( 
						'<div style="font-weight: bold; width: 180px;display: inline-block;">' + 
						_formatHeader( header ) + ': </div>' + result[ 'response_headers' ][ header ] + '<br />' );
				}
				$( '.headers_response_result' ).slideDown( 100 );
				
				var HTTPCodes = {
					200: '<b style="color: green;">200 OK</b>',
					404: '<b style="color: orange;">404 Not Found</b>',
					500: '<b style="color: darkred;">500 Internal Server Error</b>',
					401: '<b style="color: red;">401 Not Authorized</b>',
				};
				$( '.sent_data pre' ).html( result[ 'request_data' ].split('=').join( '<span style="color: red;padding: 0 3px 0 3px;">=</span>').split('&').join( '<span style="color: violet;padding: 0 3px 0 3px;">&amp;</span><br />') );
				$( '.sent_data' ).slideDown( 100 );
				$( '.request_result pre' ).html( response.length == 0 ? '<span style="color: red;"><b>WebPS</b>: empty response body</span>' : response );
				$( '.time' ).html( result[ 'execution_time' ] );
				$( '.state' ).html( HTTPCodes[ result[ 'http_status_code' ] ] );


				if( responseWindowShown === false ) {

					$( '.result_rows' ).fadeIn( 100 );
					$( '.request_result' ).slideDown( 100 );
					responseWindowShown = true;
				}
				else {
					$( '.result_rows' ).fadeTo( 100, 1 );
				}

				$('html, body').animate({
					scrollTop: $( ".request_result" ).offset().top
				}, 620 );
			} ).fail(function( jqXHR, textStatus, errorThrown ) {
				alert( textStatus );
			  });
		}

		function _formatHeader( headerName ) {
			var parts = headerName.split( '-' );
			var result = [];
			for( i = 0; i < parts.length; i++ ) {
				result.push( parts[ i ].charAt( 0 ).toUpperCase() + parts[ i ].slice( 1 ) );
			}

			return result.join( '-' );
		}

		function WebPS_Page_BackToTop() {
			$('html, body').animate({
					scrollTop: $( ".container" ).offset().top
				}, 320 );
		}

		function WebPS_Backup_SaveAllData() {
			if( typeof( Storage ) !== "undefined" ) {
				localStorage.setItem( "webps_apirm_psw_dest", $( '.desturl' ).val() );
				localStorage.setItem( "webps_apirm_psw_data", getPlainRAW() );
				localStorage.setItem( "webps_apirm_psw_rawview", $( '.raw_show' ).is( ':checked' ) );
				localStorage.setItem( "webps_apirm_psw_opt_show_out_headers", $( '.showrequestheaders' ).is( ':checked' ) );
				localStorage.setItem( "webps_apirm_psw_opt_show_in_headers", $( '.showrepsonseheaders' ).is( ':checked' ) );
				localStorage.setItem( "webps_apirm_psw_opt_jsonpurify", $( '.jsonpurify' ).is( ':checked' ) );
			}
		}

		setInterval( function() { WebPS_Backup_SaveAllData(); }, 7500 );

		function WebPS_Backup_RestoreAllData() {
			$( '.desturl' ).val( localStorage.getItem( "webps_apirm_psw_dest" ) );
			$( '.raw_data' ).val( localStorage.getItem( "webps_apirm_psw_data" ) );
			if( localStorage.getItem( "webps_apirm_psw_rawview" ) != false )
				$( '.converttoparams' ).click();
			$( '.showrequestheaders' ).prop( 'checked', localStorage.getItem( "webps_apirm_psw_opt_show_out_headers" ) == 'true' );
			$( '.showrepsonseheaders' ).prop( 'checked', localStorage.getItem( "webps_apirm_psw_opt_show_in_headers" ) == 'true' );
			$( '.jsonpurify' ).prop( 'checked', localStorage.getItem( "webps_apirm_psw_opt_jsonpurify" ) == 'true' );
		}

		function WebPS_Backup_CheckDataAvailable() {
			if( localStorage.getItem( "webps_apirm_psw_dest" ).length > 0 ) {
				WebPS_Backup_RestoreAllData();
			}
		}

		function WebPS_SaveSystem_Save() {
			name = $( '#request-name').val();
			$( '.saveRequest' ).modal( 'hide' );
		}

		WebPS_Backup_CheckDataAvailable();

		$( '.selectpicker_method' ).selectpicker();
	</script>
	 <?php
		foreach( Panel::$postPageData as $item ) {
			print $item;
		}
	?>
</body>
</html>