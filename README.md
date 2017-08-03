THIS IS OLD AND CAN BE DELETED SOON 
======================
QR Pub
===========
When installing make sure to modify private_sample to private

1. in app folder run curl -sS https://getcomposer.org/installer | php
1. then run php composer.phar install (this is how the ExtAuth dependency is loaded & also Google Api)
1. make tmp directory inside app with proper permissions (chgrp -R www-data tmp and chmod -R g+rw tmp)
1. make uploads folder inside app/webroot/img and apply permissions (chown -R www-data uploads and chmod -R 755 uploads)



