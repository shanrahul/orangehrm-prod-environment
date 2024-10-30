<?php


class WebContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

    public function checkContainerIsRunning(UnitTester $I){
        $I->wantTo("verify ubuntu container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} prod_web_ubuntu");
        $I->seeInShellOutput("true");
    }

    public function checkSupervisorInstallation(UnitTester $I){
        $I->wantTo("verify supervisor is installed in the container");

        $I->runShellCommand("docker exec prod_web_ubuntu dpkg -l | grep supervisor");
        $I->seeInShellOutput('supervisor-3');

    }

    public function checkApacheInstallation(UnitTester $I){
        $I->wantTo("verify apache is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu apache2 -v");
        $I->seeInShellOutput('Server version: Apache/2.4.6');
    }

    public function checkImageMagick(UnitTester $I){
        $I->wantTo("verify imagemagick is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu apt list installed | grep ImageMagick");
        $I->seeInShellOutput('ImageMagick.x86_64');
    }
    
    public function checkApacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        //$I->runShellCommand("ping -c 10 localhost");
        $I->runShellCommand("docker exec prod_web_ubuntu service apache2 status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkCronInstallation(UnitTester $I){
        $I->wantTo("verify cron is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu dpkg -l | grep cron");
        $I->seeInShellOutput('cronie-1.4.11');

    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu service crond status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkMemcachedInstallation(UnitTester $I){
        $I->wantTo("verify memcache is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu dpkg -l | grep memcached");
        $I->seeInShellOutput('memcached-1.4.15');

    }

    public function checkMemcacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify memcache is up and running in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu service memcached status");
        $I->seeInShellOutput('active (running)');
    }

    public function checkMySQLClientInstallation(UnitTester $I){
        $I->wantTo("verify mysql-client is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu dpkg -l | grep MariaDB-client");
        $I->seeInShellOutput('MariaDB-client');

    }

     public function checkOracleClientInstallation(UnitTester $I){
            $I->wantTo("verify oralce client is installed in the container");
            $I->runShellCommand("docker exec prod_web_ubuntu sqlplus -v");
            $I->seeInShellOutput('SQL*Plus: Release 11.2.0.2.0 Production');
     }

    public function checkLibreOfficeInstallation(UnitTester $I){
        $I->wantTo("verify LibreOffice is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu libreoffice --version");
        $I->seeInShellOutput('LibreOffice');
    }

  public function checkPopplerUtilInstallation(UnitTester $I){
        $I->wantTo("verify poppler-util is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu dpkg -l | grep poppler-util");
        $I->seeInShellOutput('poppler-util');
  }

  public function checkLibSSLInstallation(UnitTester $I){
          $I->wantTo("verify openssl is installed in the container");
          $I->runShellCommand("docker exec prod_web_ubuntu dpkg -l | grep ssl");
          $I->seeInShellOutput('openssl');
  }

    public function checkLibSSHInstallation(UnitTester $I){
            $I->wantTo("verify libssh2 is installed in the container");
            $I->runShellCommand("docker exec prod_web_ubuntu dpkg -l | grep libssh2");
            $I->seeInShellOutput('libssh2');
    }

    public function checkZipInstallation(UnitTester $I){
        $I->wantTo("verify zip library is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu zip -v");
        $I->seeInShellOutput('Zip 3');
    }

    public function checkUnzipIsInstallation(UnitTester $I){
        $I->wantTo("verify UnZip library is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu unzip -v");
        $I->seeInShellOutput('UnZip 6');
    }


    public function checkCurlInstallation(UnitTester $I){
        $I->wantTo("verify curl is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu curl --version");
        $I->seeInShellOutput('curl 7.29.0');
    }

    public function checkP7zipInstallation(UnitTester $I){
        $I->wantTo("verify p7zip is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu dpkg -l | grep p7zip");
        $I->seeInShellOutput('p7zip-16');

    }

    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 7.4 is installed in the container");
        $I->runShellCommand("docker exec prod_web_ubuntu php --version");
        $I->seeInShellOutput('PHP 7.4');

    }


    public function checkPHPModules(UnitTester $I){
            $I->wantTo("verify required php modules are available");
            $I->runShellCommand("docker exec prod_web_ubuntu php -m");
            $I->seeInShellOutput('apcu');
            $I->seeInShellOutput('bcmath');
            $I->seeInShellOutput('bz2');
            $I->seeInShellOutput('calendar');
            $I->seeInShellOutput('Core');
            $I->seeInShellOutput('ctype');
            $I->seeInShellOutput('curl');
            $I->seeInShellOutput('date');
            $I->seeInShellOutput('dom');
            $I->seeInShellOutput('exif');
            $I->seeInShellOutput('fileinfo');
            $I->seeInShellOutput('filter');
            $I->seeInShellOutput('ftp');
            $I->seeInShellOutput('gd');
            $I->seeInShellOutput('gettext');
            $I->seeInShellOutput('gmp');
            $I->seeInShellOutput('hash');
            $I->seeInShellOutput('iconv');
            $I->seeInShellOutput('igbinary');
            $I->seeInShellOutput('imap');
            $I->seeInShellOutput('ionCube Loader');
            $I->seeInShellOutput('json');
            $I->seeInShellOutput('ldap');
            $I->seeInShellOutput('libxml');
            $I->seeInShellOutput('mbstring');
            $I->seeInShellOutput('mcrypt');
            $I->seeInShellOutput('memcached');
            $I->seeInShellOutput('mysqli');
            $I->seeInShellOutput('mysqlnd');
            $I->seeInShellOutput('openssl');
            $I->seeInShellOutput('pcntl');
            $I->seeInShellOutput('pcre');
            $I->seeInShellOutput('PDO');
            $I->seeInShellOutput('pdo_mysql');
            $I->seeInShellOutput('pdo_sqlite');
            $I->seeInShellOutput('Phar');
            $I->seeInShellOutput('posix');
            $I->seeInShellOutput('readline');
            $I->seeInShellOutput('Reflection');
            $I->seeInShellOutput('session');
            $I->seeInShellOutput('shmop');
            $I->seeInShellOutput('SimpleXML');
            $I->seeInShellOutput('soap');
            $I->seeInShellOutput('sockets');
            $I->seeInShellOutput('SPL');
            $I->seeInShellOutput('sqlite3');
            $I->seeInShellOutput('ssh2');
            $I->seeInShellOutput('standard');
            $I->seeInShellOutput('sysvmsg');
            $I->seeInShellOutput('sysvsem');
            $I->seeInShellOutput('tokenizer');
            $I->seeInShellOutput('xml');
            $I->seeInShellOutput('xmlreader');
            $I->seeInShellOutput('xmlwriter');
            $I->seeInShellOutput('xsl');
            $I->seeInShellOutput('zip');
            $I->seeInShellOutput('zlib');
    }

}
