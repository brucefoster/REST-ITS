module.exports = {
	handlingRules = {
		static: [],
		dynamic: {}
	},
	/*
	@func	makeStatic
	@param	obj			File, folder or array of folders to provide an static access for them or their contents
	*/
	makeStatic( obj ) {
		var $ = module.exports;
		if( obj.isArray() === true ) {
			for( index in obj ) {
				if( $.handlingRules[ 'static' ].indexOf( obj[ index ] ) === -1 )
					$.handlingRules.push( ( obj[ index ].slice( 0, 1 ) !== '/' ? `/${obj[ index ]}` : obj[ index ] ) );
			}
		} else if( typeof obj === 'string' ) {
			if( $.handlingRules[ 'static' ].indexOf( obj ) === -1 )
				$.handlingRules.push( ( obj.slice( 0, 1 ) !== '/' ? `/${obj}` : obj ) );
		}
	},

	/*
		function callback( response, args )
	*/

	addRule( regex, callback ) {
		var $ = module.exports;
		$.dynamic[ regex ] = callback;
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
					__dirname + '..' + url, function( error, file_contents ) {
						if( file_contents )
							response.write( file_contents );
						else {
							response.setHeader( 'HTTP/1.1 404 Not Found' );
							response.end();
						}
					} 
				);
			}
		}

		// Handling dynamic queries
		for( regex in $.handlingRules[ 'static' ] ) {
			var rgx = new RegExp( regex ); 
			if( url.test( rgx ) === true ) {
				$.handlingRules[ 'static' ][ regex ]( url.match( rgx ) );
			}
		}
	}
};