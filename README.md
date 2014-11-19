## Запуск

```
git clone git@github.com:happyproff/spacebox-test.git .
composer global require "fxp/composer-asset-plugin:1.0.0-beta3"
composer install
cp config/local/db_example.php config/local/db.php
mcedit config/local/db.php
./yii migrate
```

`root` веб-сервера должен указывать на папку `web`.

## Демо
http://spacebox-test.happyproff.com/
