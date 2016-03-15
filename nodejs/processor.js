module.exports = {
	sendRequest: function( plain_url, method, headers, auth, data, callback ) {
		var querystring = require( 'querystring' );
		var http = require( 'http' );
		var url = require( 'url' );

		var url_parsed = url.parse( plain_url );
  		var request_options  = {
			host: url_parsed.hostname,
			port: url_parsed.port,
			path: url_parsed.path,
			method: method,
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
				'Content-Length': Buffer.byteLength( data )
			}
		};

		var debug = require( './debugger' );
		debug.runDebug();

		if( auth != null ) {
			var login_data = auth.split( '~$$', 2 );
			console.log( '== AUTH --> ');
			request_options.headers[ 'Authorization' ] = "Basic " + new Buffer( login_data[ 0 ] + ":" + login_data[ 1 ] ).toString( "base64" );
		}

		var response = {};
  		var sent_reqest = http.request( request_options, function( res ) {
			res.setEncoding( 'utf8' );
 			
 			response.headers = res.headers;
 			response.sentHeaders = request_options.headers;
 			response.httpStatusCode = res.statusCode;
 			response.errorCode = null;
			res.on( 'data', function ( chunk ) {
	   			response.data = chunk;
	   			response.executionTime = debug.getExecutionTime();
	   			try {
					callback( response );
				} catch( err ) {}
			} );
		});

		sent_reqest.on( 'socket', function (socket) {
			socket.setTimeout( 2000 );
			socket.on( 'timeout', function() {
				sent_reqest.abort();
				response.errorCode = 'Request timed out';
				response.errorDescription = 'Request was aborted automatically because it was executing for more than 2 seconds';
				try {
					callback( response );
				} catch( err ) {}
			});
		});

		sent_reqest.on( 'error', function ( err ) {
			response.errorCode = 'Request failed.';
			try {
				callback( response );
			} catch( err ) {}
		} );

		try {
			sent_reqest.write( data );
			sent_reqest.end();
		} catch( err ) {
			response.errorCode = 'Request failed at all.';
			try {
				callback( response );
			} catch( err ) {}
		}

	},

	_formatHeader( headerName ) {
		var parts = headerName.split( '-' );
		var result = [];
		for( i = 0; i < parts.length; i++ ) {
			result.push( parts[ i ].charAt( 0 ).toUpperCase() + parts[ i ].slice( 1 ) );
		}

		return result.join( '-' );
	}
};