<?php

class UrlHasher {

    private $urldb = [];

    public function getUrlDb() {
        return $this->urldb;
    }

    private function createHash() {
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $res = '';
        for ($i = 0; $i < 11; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $res;
    }

    public function saveUrl($url) {
        $hash = $this->createHash();
        // Check if hash already exists
        while (in_array($hash, array_column($this->urldb, 'hash'))) {
            // Create new hash if it exists
            $hash = $this->createHash();
        }

        // If hash is unique, add it to urldb
        $this->urldb[] = ['url' => $url, 'hash' => $hash];
    }
}

// Add some urls
$urls = ['https://delfi.ee', 'https://google.com', 'https://facebook.com'];
$urlHasher = new UrlHasher();

foreach ($urls as $url) {
   $urlHasher->saveUrl($url);
}

var_dump($urlHasher->getUrlDb());