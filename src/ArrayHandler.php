<?php

namespace nineparams;

class ArrayHandler {

    private $array;
   	private $typeconverter;
    private $sanitizer;

	public function __construct($arr = null, ISanitizer $sanitizer = null) {
		$this->array = $arr;
        $this->sanitizer = $sanitizer;
		$this->typeconverter = new TypeConverter();
	}

    private function trim($arr) {
		if (is_array($arr)) {
			array_walk_recursive($arr, function(&$val) {
						$val = trim($val);
					});
			return $arr;
		}
		else {
			return trim($arr);
		}
	}

    public function keyExists($key) {
        return array_key_exists($key, $this->array);
    }

    public function getValue($key, $default = null, $sanitize = true) {
		if ($this->keyExists($key)) {
			$data = $this->trim($this->array[$key]);
			if ($sanitize && $this->sanitizer) {
				$data = $this->sanitizer->sanitize($data);
			}
			return $this->trim($data);
		}
		else {
			return $default;
		}
    }

    public function getBoolValue($key, $default = false) {
		return $this->typeconverter->toBool($this->getValue($key, $default));
	}

	public function getNumValue($key, $default = 0) {
		return $this->typeconverter->toNum($this->getValue($key, $default));
	}

	public function getIntValue($key, $default = 0) {
		return $this->typeconverter->toInt($this->getValue($key, $default));
	}

	public function getFloatValue($key, $default = 0.0) {
		return $this->typeconverter->toFloat($this->getValue($key, $default));
	}

	public function getStringValue($key, $default = '') {
		return $this->typeconverter->toString($this->getValue($key, $default));
	}

	public function getOriginalStringValue($key, $default = '') {
		return $this->typeconverter->toString($this->getValue($key, $default, false));
	}

	public function getDateValue($key, $default = '') {
		return $this->typeconverter->toDate($this->getValue($key, $default));
	}

	public function getArrayValue($key, $default = array()) {
		return $this->typeconverter->toArray($this->getValue($key, $default));
	}
}