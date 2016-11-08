#Klikasi

Erabili baino lehen derrigorrez konfiguratu behar diren atalak.

**USER_CONFIGURABLE:** hitza agertzen de leku bakoitzen dagokion hitza jarri behar da.

Hona hemen konfigurazio fitxeroak eta modifikatu behar dituzun lerroak:

/klikasi/web/library/Klikasi/Controller/Action/Helper/EmbedExternal.php:
  278
  279          $response = $restClient->restGet('/services/rest/', array(
  280:             'api_key' => 'USER_CONFIGURABLE:YOUR_FLICKR_API_KEY',
  281:             'secret'  => 'USER_CONFIGURABLE:YOUR_FLICKR_SECRET_KEY',
  282              'method' => 'flickr.photos.getInfo',
  283              'photo_id' => $id
  ...
  315
  316          $response = $restClient->restGet('/services/rest/', array(
  317:             'api_key' => 'USER_CONFIGURABLE:YOUR_FLICKR_API_KEY',
  318              'method' => 'flickr.photos.getSizes',
  319              'photo_id' => $id

/klikasi/web/library/Klikasi/Controller/Plugin/AuthApp.php:
   10      //example
   11      //protected $_key = 'r4h56dgf4h56df4h65r4h564hh4dgf56';
   12:     protected $key = 'USER_CONFIGURABLE:AUTH_BASE_KEY';
   13
   14      /**

/klikasi/web/library/Klikasi/Custom/Notifikazioa.php:
   20      protected $_from = array(
   21          "izena" => "Klikasi",
   22:         "posta" => "USER_CONFIGURABLE:YOUR_NO_REPLY_EMAIL_ADDRESS"
   23      );
