module.exports = {
	start: function( request, response ) {
		function reportVisualHandler( report ) {
			var report_lines = report.split( "\n" );
			var final_report = [];
			for( line in report_lines ) {
				var type = report_lines[ line ].toString().slice( 0, 2 );
				switch( type.toLowerCase() ) {
					case '-n':
						final_report.push( '<span style="color: #FF8C19;">Notice: ' + report_lines[ line ].slice( 2 ) + '</span>' );
						break;
					case '-i':
						final_report.push( '<span style="color: #305AA3;">Info:   ' + report_lines[ line ].slice( 2 ) + '</span>' );
						break;
					case '-e':
						final_report.push( '<span style="color: #CC2E31;">Error:  ' + report_lines[ line ].slice( 2 ) + '</span>' );
						break;
					case '-d':
						final_report.push( '<span style="color: #B75E45;">Data:   ' + report_lines[ line ].slice( 2 ) + '</span>' );
						break;
					case '-s':
						final_report.push( '<span style="color: #77B538;">OK:     ' + report_lines[ line ].slice( 2 ) + '</span>' );
						break;
				}
			}

			return final_report.join( "<br />");
		}

		var sp = require( '../nodejs/scenario-processor' );

		var script = `
			request.params.add( 'hostname', 'data' );
			request.params.add( 'hostname', 'data' );
			options.strict = false;
			request.params.add( 'hostname', 'data' );
			request.params.delete( 'correct' );
			request.params.modify( 'alpha', false );
			request.params.clear();

			request.headers.add( 'Content-type', 'text/html' );
			request.headers.delete( 'Content-type 2' );
			request.headers.delete( 'Content-type' );
			request.headers.delete( 'Content-type' );
			request.headers.clear();
			assertion.equal( 1, 2 );
			assertion.equal( 2, 2 );
			request.send( function() {} );
			`;
		
		var result = sp._executeScript( script );
		var ap = result[ 'assertions' ][ 'passed' ];
		var af = result[ 'assertions' ][ 'failed' ];
		var ar = ( ap.length / ( af.length + 1 ) ) * 100;
		response.setHeader( "Content-Type", "text/html; charset=utf-8" );
		response.write( '<pre style="line-height: 24px;"><h1>Log</h1>' + reportVisualHandler( result[ 'log' ] ) 
			+ `<hr /><h1>Assertions (${ap.length} passed, ${af.length} failed, rate ${ar}%)</h1><h3>Passed assertions</h3>`
			+ ap.join( "\r\n" ) + '<h3>Failed assertions</h3>' + af.join( "\r\n" ) + '</pre>' );
		response.end();
			
		return;
	}
};