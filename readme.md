## Deployment
1. Setup Apache2
2. Push app content into `/var/www/html` dir
3. Add `.env` file
4. Generate new secure key `php artisan key:generate`
5. Add/edit `/etc/apache2/sites-available/uclancmooc.conf`, `/etc/apache2/apache2.conf` => `AllowOverride All`, `public/.htaccess` => override module rewrite configs
6. Run `sudo a2enmod rewrite` and `sudo a2ensite uclancmooc.conf` commands
7. Restart apache2
