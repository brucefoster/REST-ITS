module.exports = {
	start: function( request, response ) {
		var templater = require( '../nodejs/templater.js' );
		templater.loadTemplate( 'create-scenario', 'Test', {}, function( shell ) { response.write( shell ); response.end(); } );
	}
};