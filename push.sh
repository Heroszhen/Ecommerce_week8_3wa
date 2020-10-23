#! /bin/bash
#push to github

git add -A 
git commit -m "maj"
git push origin master

if [ -n "$1" ]
then
    if [ $1 = "archive" ]
    then
        php bin/console cache:clear
        php bin/console cache:clear --env=prod
        php bin/console cache:clear --env=dev
        zip ../symfony-default.zip -r * .[^.]* -x "vendor/*" -x ".env.local"
    fi
fi