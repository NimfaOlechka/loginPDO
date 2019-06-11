# loginPDO
https://www.codeofaninja.com/2013/03/php-login-script.html

!!!Important!!!
5.3 Create .htaccess file - kinda idk why i can't copy it
The .htaccess file use very useful to make URLs pretty and easy to remember.

For example, page page on this URL "http://localhost/login.php" can be accessed using this URL "http://localhost/login".

Create ".htaccess" file. Place the following code.

#Fix Rewrite
Options -Multiviews
 
# Mod Rewrite
Options +FollowSymLinks
RewriteEngine On
RewriteBase /php-login-script-level-1/
 
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
 
# used for php pages such as "yoursite.com/login.php" will become "yoursite.com/login/"
RewriteRule ^([a-z_]+)\/?$ $1.php [NC]
To make .htaccess file work, make sure mod_rewrite Apache module was enabled in your server. Learn more here and here.
