<?php

namespace nineparams;

class TypeConverter {

	public function toBool($value) {
		if (is_bool($value)) {
			return $value;
		}
        if (is_array($value)) {
            return (bool) $value;
        }
		if ($value) {
			$value = strtolower((string) $value);
			if ($value === 'false' || $value === 'no' || $value === 'off' || $value === 'not') {
				return false;
			}
			return true;
		}
		return false;
	}

	public function toNum($value) {
		return $value * 1;
	}

	public function toInt($value) {
		return (int) $value;
	}

	public function toFloat($value) {
		return (float) $value;
	}

	public function toString($value) {
        if (is_array($value)) {
            return '';
        }
		return (string) $value;
	}

	public function toArray($value) {
		return (array) $value;
	}

	public function toDate($value) {
		return (string) $value;
	}

}