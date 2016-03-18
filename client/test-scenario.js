module.exports = {
	start: function( request, response ) {
		function reportVisualHandler( report ) {
			var report_lines = report.split( "\n" );
			var final_report = [];
			for( line in report_lines ) {
				var type = report_lines[ line ].toString().slice( 0, 2 );
				switch( type.toLowerCase() ) {
					case '-n':
						final_report.push( '<span style="color: #3DB6BF;">Notice: ' + report_lines[ line ].slice( 2 ) + '</span>' );
						break;
					case '-i':
						final_report.push( '<span style="color: #305AA3;">Info: ' + report_lines[ line ].slice( 2 ) + '</span>' );
						break;
					case '-e':
						final_report.push( '<span style="color: #CC2E31;">Error: ' + report_lines[ line ].slice( 2 ) + '</span>' );
						break;
					case '-d':
						final_report.push( '<span style="color: #B75E45;">Data: ' + report_lines[ line ].slice( 2 ) + '</span>' );
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
			`;
		
		var result = sp._executeScript( script );
		response.setHeader( "Content-Type", "text/html; charset=utf-8" );
		response.write( '<div style="font: 14px/24px Arial;">' + reportVisualHandler( result ) );
		response.end();
			
		return;
	}
};