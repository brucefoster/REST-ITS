module.exports = {
	hr_time: 0,
	runDebug: function() {
		module.exports.hr_time = process.hrtime();
	},

	getExecutionTime: function() {
		var hr_time_end = process.hrtime( module.exports.hr_time );

		return hr_time_end[ 1 ] / 1000000000;
	}
};