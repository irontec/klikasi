#Klikasi

Erabili baino lehen derrigorrez konfiguratu behar diren atalak.

**'USER_CONFIGURABLE:*'** hitza agertzen de leku bakoitzen dagokion hitza jarri behar da.

Hona hemen configurazio fitxeroak eta modifikatu behar dituzun lerroak:

```
/klikasi/phing/build.properties:
    6
    7  # Credentials for the database migrations
    8: db.host=USER_CONFIGURABLE:db.host
    9: db.user=USER_CONFIGURABLE:db.user
   10: db.pass=USER_CONFIGURABLE:db.pass
   11: db.name=USER_CONFIGURABLE:db.name
   12
   13  # paths to programs

/klikasi/web/application/configs/application.ini:
    1  [production]
    2: baseUrlKlikasi = "USER_CONFIGURABLE:WWW_YOUR_BASE_DNS"
    3
    4  phpSettings.display_startup_errors = 1
    .
   41  resources.db.adapter         = "Mysqli"
   42: resources.db.params.dbname   = "USER_CONFIGURABLE:db.name"
   43: resources.db.params.username = "USER_CONFIGURABLE:db.username"
   44: resources.db.params.password = "USER_CONFIGURABLE:db.password"
   45: resources.db.params.host     = "USER_CONFIGURABLE:db.host"
   ..
  116  phpSettings.date.timezone = "Europe/Madrid"
  117
  118: resources.db.params.dbname   = "USER_CONFIGURABLE:db.name"
  119: resources.db.params.username = "USER_CONFIGURABLE:db.user"
  120: resources.db.params.password = "USER_CONFIGURABLE:db.password"

/klikasi/web/library/Klikasi/Controller/Action/Helper/EmbedExternal.php:
  278
  279          $response = $restClient->restGet('/services/rest/', array(
  280:             'api_key' => 'USER_CONFIGURABLE:YOUR_FLICKR_API_KEY',
  281:             'secret'  => 'USER_CONFIGURABLE:YOUR_FLICKR_SECRET_KEY',
  282              'method' => 'flickr.photos.getInfo',
  283              'photo_id' => $id
  ...
  316          $response = $restClient->restGet('/services/rest/', array(
  317:             'api_key' => 'USER_CONFIGURABLE:YOUR_FLICKR_API_KEY',
  318              'method' => 'flickr.photos.getSizes',
  319              'photo_id' => $id

/klikasi/web/library/Klikasi/Controller/Plugin/AuthApp.php:
   10      //example
   11      //protected $_key = 'r4h56dgf4h56df4h65r4h564hh4dgf56';
   12:     protected $key = 'USER_CONFIGURABLE:AUTH_BASE_KEY';
   14      /**

/klikasi/web/library/Klikasi/Custom/Notifikazioa.php:
   20      protected $_from = array(
   21          "izena" => "Klikasi",
   22:         "posta" => "USER_CONFIGURABLE:YOUR_NO_REPLY_EMAIL_ADDRESS"
   23      );
```