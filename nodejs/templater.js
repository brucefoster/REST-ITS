module.exports = {
	loadTemplate: function( dest_template, title, replaces, callback ) {
		var fs = require( 'fs' );
		var shell = '';
		var build = '0.1.0 (prototype)';
		var menu_items = {
			'/': 'Request Master',
			'/plain': 'Plain request editor',
			'/scenarios': 'Testing Scenarios',
			'/saved-requests': 'Saved Requests',
			'/settings': 'Global Settings',
			'/logs': 'Logs & History'
		};

		var menu = '';
		var wh = require( './webpage-handler' );

		for( link in menu_items ) {
			var class_name = ( link == wh.currentURL ? ' class="active"' : '' );
			menu += `<li role="presentation"${class_name}><a href="${link}">${menu_items[ link ]}</a></li>`;
		}

		// Loading global template
		fs.readFile( './client/templates/global.html', function( error, template ) {
			if( template !== undefined ) {
				shell = template.toString();
				shell = shell.replace( '{title}', title );
				shell = shell.replace( '{tabs}', menu );
				shell = shell.replace( '{build}', build );

				var content = '';
				fs.readFile( './client/templates/' + dest_template + '.html', function( error, template ) {
					if( template ) {
						content = template.toString();
						for( keyword in replaces ) {
							content = template.replace( `{${keyword}}`, replaces[ keyword ] )
						}

						shell = shell.replace( '{content}', content );
						callback( shell );

						return;
					}
				} );
			}
			else
				return error.toString();
		} );
	}
};