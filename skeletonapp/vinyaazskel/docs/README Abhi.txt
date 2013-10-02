README
======

This is a test…..
Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
   DocumentRoot "E:/wamp/bin/apache/Apache2.4.4/htdocs/vinyaazskel/public"
   ServerName .local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development

   <Directory "E:/wamp/bin/apache/Apache2.4.4/htdocs/vinyaazskel/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>

</VirtualHost>
