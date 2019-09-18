/*
 * wp-install.js
 * Usage: <node wp-nstall> in cmd console
 * Description: downloading and unpacking Wordpress in folder src/wordpress
 * Version: 1.0.1
 * Author: Stanislav Shabalin
 */
 
 // Dependencies
var fs = require('fs-extra'),
	url = require('url'),
	http = require('https'),
	unzipper = require('unzipper');

// App variables
//var FILE_URL = 'http://ru.wordpress.org/latest.tar.gz';
var FILE_URL = 'https://ru.wordpress.org/latest-ru_RU.zip';
var ZIP_FILE = url.parse(FILE_URL).pathname.split('/').pop();
var EXTRACT_DIR = 'src';

function downloadHTTP(url, file_name){
	var file = fs.createWriteStream(file_name);
	return new Promise((resolve, reject) => {
	    var responseSent = false; // flag to make sure that response is sent only once.
	    http.get(url, response => {
	    	console.log('Downloading the latest WordPress [rus] from ' + url +'...');
	    	response.pipe(file);
	    	file.on('finish', () => {
	    		file.close(() => {
	    			if (responseSent) return;
	    			responseSent = true;
	    			resolve();
	    		});	
	    	});
	    }).on('error', e => {
	    	if(responseSent) return;
	    	responseSent = true;
	    	reject(e);
	    });
	});
}

function unpack(file_name, path) {

	try {
		var wpcontent_folder = path + '/wordpress/wp-content';
		fs.accessSync(file_name);     
		console.log(file_name + ' is extracting...');
		fs.createReadStream(file_name)
		.pipe(unzipper.Extract({ path: path }))
		.promise()
		.then( () => {
				console.log('Done!');
				console.log(file_name + ' is deleting...');
				fs.unlink(file_name, function(e) {
					if (e) return console.log(e);
					console.log('Delete complete!');
				});
				fs.realpath(wpcontent_folder, function(e) {
					if (e) return console.log(e);
					console.log('Deleting folder "' + wpcontent_folder + '"...');
					fs.removeSync(wpcontent_folder);
					console.log('Delete complete!');
					console.log('WORDPRESS has been installed');
				});
		})
		.catch ( err => console.error('Unpacking error', err) );
	} catch {err => console.log('There is no "' + file_name + '" file to extract') };
	
}


downloadHTTP(FILE_URL, ZIP_FILE)
	.then( () => {
		console.log('File is downloaded successfully!');
		unpack(ZIP_FILE, EXTRACT_DIR);
	})
	.catch ( err => console.error('Error while downloading', err) );
