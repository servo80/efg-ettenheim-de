<?php

  /*
   * call by Brandbox
   */
  if(@secure !== true)
    die('forbidden');

  \BB\config::set('maintenance', false);

  /*
   * Config:License
   */
  \BB\config::set('license', '09999-00000-01');

  /*
   * Config:Debug
   */
  //\BB\config::set('debug:mail', 'frick@konmedia.com');
  \BB\config::set('debug:mysql', 'DEBUG');
  \BB\config::set('debug:identifierTable', 'DEBUG');
  \BB\config::set('debug:identifierField', 'DEBUG');
  \BB\config::set('debug:dao', false);
  \BB\config::set('debug:template', true);
  \BB\config::set('debug:identifier', true);
  \BB\config::set('debug:pdf', false);
  \BB\config::set('debug:file', true);
  \BB\config::set('debug:ftp', false);
  \BB\config::set('debug:out', 'chrome'); // chrome|firefox|plain|html|mail|none
  \BB\config::set('log:level', 'debug'); // chrome|firefox|plain|html|mail|none

  /*
   * Config:MySQL
   */
  \BB\config::set('db:name', 'efg-ettenheim');
  \BB\config::set('db:host', 'localhost');
  \BB\config::set('db:user', 'root');
  \BB\config::set('db:password', 'root');
  \BB\config::set('db:prefix', 'brandbox_');
  \BB\config::set('db:optimize:index', true);
  \BB\config::set('db:encoding', 'utf8');

  /*
   * Config:Paths
   */
  \BB\config::set('path:protocol', $_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http', 'app');
  \BB\config::set('path:directory', '/efg-ettenheim-de-4/', 'app');
  \BB\config::set('path:http', 'http://'.$_SERVER['SERVER_NAME'].'/efg-ettenheim-de-4/', 'app');
  \BB\config::set('path:https', 'http://'.$_SERVER['SERVER_NAME'].'/efg-ettenheim-de-4/', 'app');
  \BB\config::set('path:none', '//'.$_SERVER['SERVER_NAME'].'/efg-ettenheim-de-4/', 'app');

  \BB\config::set('path:php', '/usr/bin/');
  \BB\config::set('path:mysql', '/usr/bin/');
  \BB\config::set('path:magick', '/usr/bin/');
  \BB\config::set('path:gs', '/usr/bin/gs');
  \BB\config::set('path:epdf', '');
  //\BB\config::set('path:wkhtmltopdf', '/usr/bin/wkhtmltopdf');
  \BB\config::set('path:java', '');
  \BB\config::set('path:jplayer', '');
  \BB\config::set('path:redmine:project', '');
  \BB\config::set('path:phpmyadmin', 'http://localhost/phpmyadmin/');

  /*
   * Config:Mail
   */
  //\BB\config::set('mail:debug:recipient', 'frick@konmedia.com');
  \BB\config::set('mail:address', 'philippfrick@arcor.de', 'app');
  \BB\config::set('mail:name', 'EFG Ettenheim', 'app');
  \BB\config::set('mail:smtp:host', 'mail.arcor.de');
  \BB\config::set('mail:smtp:port', 465);
  \BB\config::set('mail:smtp:username', 'philippfrick@arcor.de');
  \BB\config::set('mail:smtp:password', '20649093');
  \BB\config::set('mail:smtp:auth', true);
  \BB\config::set('mail:smtp:secure', 'ssl');


  /*
   * Config:Solr
   */
  /*
  \BB\config::set('solr:host', 'localhost');
  \BB\config::set('solr:port', '8983');
  \BB\config::set('solr:path', '/solr');
  */

  /*
   * Config:Settings
   */
  \BB\config::set('settings:download:count', 5);
  \BB\config::set('settings:media:categoryCount', 100);
  \BB\config::set('settings:media:categoryTableIDs', array(17,18));
  \BB\config::set('settings:media:categoryFolder', 'share/public/');
  \BB\config::set('settings:media:transparency', true);
  \BB\config::set('settings:web:less', null);
  #\BB\config::set('settings:web:less:debug', true);
  \BB\config::set('settings:web:canonical', true);
  #\BB\config::set('settings:session:exec', array('Test'));
  \BB\config::set('settings:salutation:format', '%2$s');
  \BB\config::set('settings:pdf:unloadimages', 'document');
  \BB\config::set('settings:pdf:defaultcmyk', 'USWebCoatedSWOP.icc'); //

  // http://www.imagemagick.org/script/command-line-options.php#limit
  \BB\config::set('settings:magick:limit:memory', '500MiB');
  \BB\config::set('settings:magick:limit:area', false);
  \BB\config::set('settings:magick:limit:map', false);
  \BB\config::set('settings:magick:limit:disk', '1GiB');
  \BB\config::set('settings:magick:limit:time', 60);
  \BB\config::set('settings:gs:timeout', false);

  /*
   * Config:Skin
   */
  \BB\config::set('path:skin', 'skins/responsive/', 'app');
  \BB\config::set('path:icons', 'skins/responsive/icons/', 'app');
  \BB\config::set('title', 'Brandbox &reg;', 'app');

  /*
   * Config:Customer
   */
  \BB\config::set('customer:company', 'Konmedia GmbH', 'app');
  \BB\config::set('customer:street', 'Gartenstraße 10', 'app');
  \BB\config::set('customer:postcode', '77815', 'app');
  \BB\config::set('customer:city', 'Bühl', 'app');

  /*
   * Config:Time
   */
  setlocale(LC_TIME, 'de_DE@euro.UTF-8', 'de_DE.UTF-8', 'deu_deu.UTF-8');
  date_default_timezone_set('UTC');

  #putenv("MAGICK_THREAD_LIMIT=1");
  #putenv("OMP_NUM_THREADS=1");

  ini_set('display_errors', 1);
  error_reporting(E_ERROR);

?>