<?php

namespace nineparams;

require_once 'ISanitizer.php';

class HtmlPurifierSanitizer implements ISanitizer {

    private $purifier;

    public function __construct($serializercachepath = null) {
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', '');
        if ($serializercachepath) {
            $config->set('Cache.SerializerPath', $serializercachepath);
        }
        $this->purifier = new \HTMLPurifier($config);
    }

    public function sanitize($data) {
        if (is_array($data)) {
            $puri = $this->purifier;
            array_walk_recursive($data, function(&$val) use ($puri) {
                $val = $puri->purify($val);
            });
            return $data;
        }
        else {
            return $this->purifier->purify($data);
        }
    }

}
