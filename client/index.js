module.exports = {
	render: function() {
		var fs = require( 'fs' );
		fs.readFile( './templates/request-master.html', function( error, data ) {
			if( data ) {
				return data;
			} else
				return 'err';
		} );
	}
};