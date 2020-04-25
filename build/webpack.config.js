const glob = require('glob');
const config = require('./tasks/inc/config');


const entries = {};

// Get list of files in entry directory and create entry list for WebPack config
glob.sync('./src/ts/entry/*.ts').forEach((value) => {
	if(matches = value.match(/\/([^\/]+).ts$/)) {
		entries[matches[1]] = value;
	}
});

module.exports = {
	entry: entries,
	output: {
		filename: config.dist_folder + '/view/js/[name].js'
	},
	devtool: 'source-map',
	resolve: {
		extensions: ['', '.webpack.js', '.web.js', '.ts', '.js']
	},
	module: {
		loaders: [
			  {test: /\.ts$/, loader: 'ts-loader'}
		]
	},
    externals: {
        "angular": "angular",
        "jquery": "jQuery"
    }
};
