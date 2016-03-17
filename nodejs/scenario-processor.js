Object.prototype.removeItem = function( key ) {
	if ( !this.hasOwnProperty( key ) )
		return;
	if ( isNaN( parseInt( key ) ) || !( this instanceof Array ) )
		delete this[ key ];
	else
		this.splice( key, 1 );
};

module.exports = {
	requestOptions: {
		method: null,
		data: [],
		url: null,
		auth: null,
		headers: [],
	},

	conditions: [],
	conditionsAssertionsResults: {},
	operationResult: {},

	systemOptions: {
		trim: true,
	},

	report: '',

	reset: function() {
		module.exports.requestOptions = {
			method: null,
			data: [],
			url: null,
			auth: null,
			headers: [],
		};

		module.exports.conditions = [];
		module.exports.conditionsAssertionsResults = {};
		module.exports.operationResult = {};

		module.exports.systemOptions = {
			trim: true,
		};

		module.exports.report = '';
		module.exports.report = '';
	},

	/*
	==============
	DEPRECATED
	==============
	*/
	runScenario: function( scenario, callback ) {
		module.exports.reset();
		var scenario_lines = scenario.split( "\n" );
		for( line in scenario_lines ) {
			module.exports._processLine( scenario_lines[ line ] );
		}

		module.exports.report += "[Info] " + module.exports.requestOptions.method + " " + module.exports.requestOptions.url + "\n";
		if( module.exports.requestOptions.auth ) {
			var http_auth_login = module.exports.requestOptions.auth.split( '~$$' );
			module.exports.report += "[Info] HTTP Basic Authentication with username '" + http_auth_login[ 0 ] + "'\n";
		}

		module.exports.report += "[Data] Request have been sent to the target server\n";
		var req = require( './processor' );
		var data = module.exports.requestOptions.data.join( '&' );
		req.sendRequest( 
			module.exports.requestOptions.url,
			module.exports.requestOptions.method,
			null,
			module.exports.requestOptions.auth,
			data,
			function( result ) {
				module.exports.report += "[Data] Response is recieved from server\n";
				module.exports.report += "[Info] Request was executed in " + result.executionTime + " seconds\n";
				module.exports.operationResult = result;
				module.exports._processConditions();
				module.exports.report += "[Info] All of assertions are handled\n";
				callback( module.exports.conditionsAssertionsResults, module.exports.report );
			}
		);
	},

	/*
	==============
	DEPRECATED
	==============
	*/
	_processString( str ) {
		var result = str;
		if( module.exports.systemOptions[ 'trim' ] === true )
			result = result.trim();

		return result;
	},

	/*
	==============
	DEPRECATED
	==============
	*/
	_processLine( scenario_line ) {
		console.log( '! PROCESSING LINE ' + scenario_line );
		if( scenario_line.slice( 0, 2 ) == '//' )
			return;
		var commands = scenario_line.split( ' ', 2 );
		commands[ 1 ] = scenario_line.slice( commands[ 0 ].length + 1 );
		switch( commands[ 0 ].toLowerCase() ) {
			case 'post':
			case 'get':
			case 'put':
			case 'delete':
				module.exports.requestOptions.method = commands[ 0 ].toUpperCase();
				module.exports.requestOptions.url = commands[ 1 ].toString();
				console.log( '===== TYPEOF: ' + typeof module.exports.requestOptions.url );
				break;

			case 'param':
			case 'addparam':
			case 'add_param':
				var key_value_pair = commands[ 1 ].split( '=', 2 );
				module.exports.requestOptions.data.push( module.exports._processString( key_value_pair[ 0 ] ) + '=' + module.exports._processString( key_value_pair[ 1 ] ) );
				break;

			case 'httpauth':
				var username_password = commands[ 1 ].split( ':', 2 );
				module.exports.requestOptions.auth = username_password[ 0 ] + '~$$' + username_password[ 1 ];
				break;

			case 'assert':
				console.log( commands[ 1 ] );
				console.log( commands[ 2 ] );
				module.exports.conditions.push( commands[ 1 ] );
				break;

			case 'option':
				var option_name_value = commands[ 1 ].split( '=', 2 );
				if( !( option_name_value[ 0 ] in module.exports.systemOptions ) ) {
					module.exports.report += "[Error] Scenario Processor error: option '" + option_name_value[ 0 ] + "' is not recognized\r\n";
				} else {
					if( typeof module.exports.systemOptions[ option_name_value[ 0 ] ] === 'boolean' ) {
						module.exports.systemOptions[ option_name_value[ 0 ] ] = 
						( 
							option_name_value[ 1 ].toLowerCase() === 'true' 
							|| option_name_value[ 1 ].toLowerCase() === '1' 
						);
					} else
						module.exports.systemOptions[ option_name_value[ 0 ] ] = option_name_value[ 1 ];
				}
				break;

			default:
				module.exports.report += "[Notice] Scenario Processor notice: unknown keyword '" + commands[ 0 ] + "'\n";
				break;
		}
	},

	/*
	==============
	DEPRECATED
	==============
	*/
	_assert_equal( code, value, match ) {
		var $ = module.exports;
			if( value === match ) {
						$.report += "[Success] Assertion passed: " + code + " equals '" + match + "'\r\n";
						$.conditionsAssertionsResults[ 'assert_equal(' ] = true;
					}

					$.report += "[Error] Assertion failed: " + code + " is not equal to '" + 
					match + "', given '" + value + "'\r\n";
					$.conditionsAssertionsResults[ $.conditions[ condition ] ] = true;
	},

	_executeScript( script ) {
		var _request_info = {
			data: {},
		};

		var _history = [];
		var request = {
			params: {
				add: function( param, value ) {
					if( param in _request_info[ 'data' ] ) {
						if( options.strict === true )
							return !_history.push( `[Error] Failed to ADD request param: "${param}" is already exists` + options.getStrictMode() );
						else
							_history.push( `[Notice] Request param is MODIFIED instead of ADDING: "${param}" is already exists` + options.getStrictMode() );
					} else
						_history.push( `[Info] Added request param: "${param}" = "${value}"` );
					_request_info[ 'data' ][ param ] = value;
				},

				delete: function( param ) {
					_request_info[ 'data' ].removeItem( param );
					_history.push( '[Info] Removed request param: ' + param );
				},

				modify: function( param, value ) {
					_history.push( '[Info] Modified request param: "' + param + '" was "' + _request_info[ 'data' ][ param ] + '", changed to "' + value + '"' );
					_request_info[ 'data' ][ param ] = value;
				},

				clear: function() {
					_history.push( '[Info] Cleared all request params: ' + _request_info[ 'data' ][ param ].length + ' deleted' );
					_request_info[ 'data' ][ param ] = value;
				}
			}
		};

		var options = {
			strict: true,
			getStrictMode: function() {
				return ' (strict mode ' + ( this.strict === true ? 'enabled' : 'disabled' ) + ')';
			}
		};

		eval( script );
		return _history.join( "\n" ).toString();
	},

	/*
	==============
	DEPRECATED
	==============
	*/
	_processConditions() {
		var $ = module.exports;
		console.log( $.conditions );
		for( condition in $.conditions ) {
			var condition_data = $.conditions[ condition ].split( '=', 2 );
			var condition_parameter = $._processString( condition_data[ 0 ] ).toLowerCase().split( '.' );
			switch( condition_parameter[ 0 ] ) {
				case 'http_code':
					if( $.operationResult[ 'httpStatusCode' ] == $._processString( condition_data[ 1 ] ) ) {
						$.report += "[Success] Assertion passed: HTTP_Code equals '" + $._processString( condition_data[ 1 ] ) + "'\r\n";
						$.conditionsAssertionsResults[ $.conditions[ condition ] ] = true;
						continue;
					}

					$.report += "[Error] Assertion failed: HTTP_Code is not equal to '" + 
					$._processString( condition_data[ 1 ] ) + "', given '" + $.operationResult[ 'httpStatusCode' ] + "'\r\n";
					$.conditionsAssertionsResults[ $.conditions[ condition ] ] = true;
					break;
				case 'response_headers':
					if( !( $._processString( condition_parameter[ 1 ] ) in $.operationResult[ 'headers' ] ) ) {
						$.report += 
							"[Error] Assertion failed: header '" + 
							$._processString( condition_parameter[ 1 ] ) + 
							"' is absent in the list of response headers\r\n";
						$.conditionsAssertionsResults[ $.conditions[ condition ] ] = false;
						continue;
					}

					if( 
						$.operationResult[ 'headers' ][ $._processString( condition_parameter[ 1 ] ) ] != 
						$._processString( condition_data[ 1 ] ) 
					) {
						$.report += 
							"[Error] Assertion failed: header '" + 
							$._processString( condition_parameter[ 1 ] ) + 
							"' is not equal to '" + $._processString( condition_data[ 1 ] ) + 
							"', given '" + $.operationResult[ 'headers' ][ $._processString( condition_parameter[ 1 ] ) ] + "'\r\n";
						$.conditionsAssertionsResults[ $.conditions[ condition ] ] = false;
						continue;
					}

					$.conditionsAssertionsResults[ $.conditions[ condition ] ] = true;
					$.report += "[Success] Assertion passed: header '" + 
							$._processString( condition_parameter[ 1 ] ) + 
							"' equals to '" + $._processString( condition_data[ 1 ] ) + "'\r\n";
					break;
				case 'response':
					break;
			}
		}

		console.log( '====== ! CONDITIONS WERE HANDLED' );
	}
};