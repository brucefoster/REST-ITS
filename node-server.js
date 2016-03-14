/*
	NodeJS REST API Request Bulder
	==============================
	Web Server
*/
var http = require( 'http' );
var fs = require( 'fs' );

const http_port = 8020; 
function parseQuery(qstr) {
	var query = {};
	var a = qstr.substr(1).split('&');
	for (var i = 0; i < a.length; i++) {
		var b = a[i].split('=');
		query[decodeURIComponent(b[0])] = decodeURIComponent(b[1] || '');
	}
	return query;
}

Object.extend = function(destination, source) {
	for (var property in source) {
		if (source.hasOwnProperty(property)) {
			destination[property] = source[property];
		}
	}
	return destination;
};

function requestProcessor( request, response ) {

	var qs = require( 'querystring' );
	if( request.url === '/send' ) {
		var http_request_body = null;
		// Catching incoming parameters
		request.on( 
			'data', function( chunk ) {
				http_request_body += chunk.toString();
   			}
   		);

   		// Handling them
   		request.on( 
   			'end', function() {
				var debug = require( './nodejs/debugger' );
				debug.runDebug();
				var post_data = qs.parse( http_request_body );
				
				var url = require( 'url' );

				// Now we know all the params, let's work
				var req = require( './nodejs/processor' );
				var request_data = post_data[ 'data' ].split( '/$webps:s_and/' ).join( '&' ).split( '/$webps:s_eq/' ).join( '=' );
				if( post_data[ 'method' ] == 'GET' ) {
	   				var original_url = url.parse( post_data[ 'url' ], true );
	   				var query = original_url[ 'query' ];
					original_url[ 'query' ] = ( Object.extend( query, parseQuery( request_data ) ) );
	   				var real_url = url.format( original_url );
					post_data[ 'url' ] = real_url;
				}
				req.sendRequest(
					post_data[ 'url' ],
					post_data[ 'method' ],
					'',
					post_data[ 'auth' ],
					request_data,
					function( result ) {
						if( result[ 'errorCode' ] !== null ) {
							var client_response = {};
							client_response[ 'error' ] = result[ 'errorCode' ];
							client_response[ 'error_description' ] = result[ 'errorDescription' ];
							try {
								response.end( JSON.stringify( client_response ) );
							} catch( err ) {
							}

							return;
						}
						response.setHeader( "Content-Type", "text/html; charset=utf-8" );
						var client_response = {};
						client_response[ 'http_status_code' ] = result.httpStatusCode;
						client_response[ 'request_headers' ] = result.sentHeaders;
						client_response[ 'response_headers' ] = result.headers;
						client_response[ 'response_data' ] = result.data;

						client_response[ 'execution_time' ] = debug.getExecutionTime();
						client_response[ 'request_data' ] = request_data;

						try {
							response.write( JSON.stringify( client_response ) );
							response.end();
						} catch( err ) {
						}
					}
				);
			}
		);
	} else {
		if( request.url.substr( 0, 7 ) == '/client' ) {
			fs.readFile( __dirname + request.url, function( error, data ) {
				if( data ) {
					response.end( data );
				}
			} );

			return;
		}

		var current_request = ( request.url == '/' ? 'index' : request.url.slice( 1 ).split( '/' ).join( '-' ) );  
		fs.readFile( './client/' + current_request + '.php', function( error, data ) {
			if( data ) {
				response.setHeader( "Content-Type", "text/html; charset=utf-8" );
				response.write( data );
				response.end();
			} else
				response.end( '404 Not Found' );
		} );
	}
}

var serveStatic = require( 'serve-static' );
var serve = serveStatic( './client/' );

var server = http.createServer( requestProcessor );
server.listen( http_port, function() {
	console.log( "Server listening on: http://localhost:%s", http_port );
} );

console.log( "So: %s", __dirname );