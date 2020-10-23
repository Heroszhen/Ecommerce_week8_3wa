#! /bin/bash
#push to github

php bin/console cache:clear
php bin/console cache:clear --env=prod
php bin/console cache:clear --env=dev
zip ../symfony-default.zip -r * .[^.]* -x "vendor/*" -x ".env.local"