# Movie Database

I made this site as a project from Digital Nation's Generația Tech mentorship program.

It is a simple movie database that contains basic information about movies and allows users to rate
them. It also features a search form to make it easier to find movies.

## How to run

1. Have a web server set up with PHP.
2. Clone this repo and place it in your server's public folder.
3. If you're running the server on a \*NIX, you will want to chown the directory
   you cloned as the php user. To get the php user, run a php page with this
   code inside (only if your web server PHP is different from the system-wide
   php:
   ```
	$processUser = posix_getpwuid(posix_geteuid());
	print $processUser['name'];
   ```
   If your web server php is the system-wide one, you can run the previous
   command with `php -a`.
   Get the user and open a terminal, then cd to the repo's location. Run `sudo
   chown <php_user> .`, where \<php\_user\> is the user you got previously.

   **NOTE**: The functions in the command might not work on all versions of php.
   In that case, if you have the system-wide php used for web pages, your php
   user will usually be the same as the web server's user (such as 'nginx',
   'www-data', 'daemon', etc).
4. Access it from a web browser.

