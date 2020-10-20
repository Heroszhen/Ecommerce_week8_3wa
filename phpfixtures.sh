#! /bin/bash
#FIXTURES

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load

cp public/photo/640px-Alexandra_Daddario_2016.jpg public/photo/product/10083754155f8ded5d910e67.23748912.jpg
cp public/photo/640px-Alexandra_Daddario_2016.jpg public/photo/category/10083754155f8ded5d910e67.23748912.jpg