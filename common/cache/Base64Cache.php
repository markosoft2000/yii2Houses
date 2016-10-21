<?php

namespace common\cache;

use \yii\caching\FileCache;


class Base64Cache extends FileCache {
    public $cacheFileSuffix = '.base64';

    public function getValue($key) {
        return base64_decode(parent::getValue($key));
    }

    public function setValue($key, $value, $duration) {
        return parent::setValue($key, base64_encode($value), $duration);
    }
}