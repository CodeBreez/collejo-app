<?php

    /*
    |--------------------------------------------------------------------------
    | Setup Language Lines
    |--------------------------------------------------------------------------
    */

return [
	'setup' => 'Setup',
	'about' => 'About',
	'documentation' => 'Documentation',
	'welcome' => 'Welcome...',
	'intro1' => 'Welcome to Collejo, the free and open source PHP school management system based on Laravel framework.',
	'intro2' => 'The next few steps will guide you in installing Collejo on your server.',
	'pre_install_checkup' => 'Pre-installation checkup',
	'checkup_success' => 'No problems found. We can continue.',
	'checkup_fail' => 'The following problems was detected. Please correct them and click retry.',
	'create_admin_account' => 'Create Administrator Account',
	'name' => 'Name',
	'first_name' => 'First Name',
	'last_name' => 'Last Name',
	'email' => 'Email',
	'password' => 'Password',
	'password_confirm' => 'Password Confirmation',
	'db_credentials' => 'MySQL Database Configuration',
	'host' => 'Host',
	'host_help' => 'Database server. The default value should work fine.',
	'port' => 'Port',
	'host_help' => 'Database server. The default value should work fine.',
	'database' => 'Database',
	'database_help' => 'Name of the database, you need to create this first.',
	'db_username' => 'Username',
	'db_username_help' => 'Database user username',
	'db_username' => 'Password',
	'db_password_help' => 'Database user password',

	'check_db' => [
		'info' => 'Checkes the connection to the MySQL sever with the given user credentials.',
		'success' => 'Database is reachable by the given user and password.',
		'fail' => 'A valid database connection could not be established.'
	],
	'check_env' => [
		'info' => 'Checkes wheather the .env file exists and is writable by the web server.',
		'success' => '.env file found and is writable.',
		'fail' => '.env file is not writable or does not exist.',
		'help' => 'Make sure the web server can write to the .env file.'
	],
	'check_env' => [
		'success' => 'Modules directory found and is writable.',
		'fail' => 'Modules directory is not writable or does not exist.',
		'help' => 'Make sure the web server can write to the Modules directory.',
		'info' => 'Checkes wheather the Modules directory exists and is writable by the web server.'
	],
	'installing_inprogress' => 'Instalation In Progress',
	'installing' => 'Installing...'
];