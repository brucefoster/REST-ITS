module.exports = {
	handlingRules: {
		static: [],
		dynamic: {}
	},
	/*
	@func	makeStatic
	@param	obj			File, folder or array of folders to provide an static access for them or their contents
	*/
	makeStatic( obj ) {
		var $ = module.exports;
		if( typeof obj === 'Array' ) {
			for( index in obj ) {
				if( $.handlingRules[ 'static' ].indexOf( obj[ index ] ) === -1 )
					$.handlingRules.push( ( obj[ index ].slice( 0, 1 ) !== '/' ? `/${obj[ index ]}` : obj[ index ] ) );
			}
		} else if( typeof obj === 'string' ) {
			if( $.handlingRules[ 'static' ].indexOf( obj ) === -1 )
				$.handlingRules[ 'static' ].push( ( obj.slice( 0, 1 ) !== '/' ? `/${obj}` : obj ) );
		}
	},

	/*
		function callback( response, args )
	*/

	addRule( regex, callback ) {
		var $ = module.exports;
		$.handlingRules[ 'dynamic' ][ regex ] = callback;
	},

	/*
		function callback( bool wasSuccessful, object result )
	*/
	handleURL( request, response ) {
		var $ = module.exports;
		var fs = require( 'fs' );

		var url = request.url;

		// First of all, let's handle static URLs.
		for( index in $.handlingRules[ 'static' ] ) {
			if( url.slice( 0, $.handlingRules[ 'static' ][ index ].length ) == $.handlingRules[ 'static' ][ index ] ) {
				fs.readFile( 
					__dirname + '/..' + url, function( error, file_contents ) {
						if( file_contents )
							response.write( file_contents );
						else 
							response.setHeader( 'HTTP/1.0 404 Not Found' );

						response.end();
					} 
				);
			}
		}

		// Handling dynamic queries
		for( regex in $.handlingRules[ 'dynamic' ] ) {
			var rgx = new RegExp( regex ); 
			if( rgx.test( url ) === true ) {
				$.handlingRules[ 'dynamic' ][ regex ]( request, response, url.match( rgx ) );
			}
		}
	},

	displayHTMLError( code, message ) {
		return `<h1>Error ${code}</h1><i>${message}</i><hr />
			// <b>restis</b> server. <a href="//github.com/brucefoster/restis/issues">Report an issue</a>`;
	}
};