<?php

namespace nineparams;

require_once 'IParameterHandler.php';
require_once 'TypeConverter.php';
require_once 'ISanitizer.php';
require_once 'ArrayHandler.php';

class ParameterHandler implements IParameterHandler {

	private $typeconverter;
    private $sanitizer;
    private $paramhnd;
    private $requestparamhnd;

	public function __construct($par = null, ISanitizer $sanitizer = null) {
        $this->sanitizer = $sanitizer;
		$this->typeconverter = new TypeConverter();
        $this->paramhnd = new ArrayHandler($par['params'], $sanitizer);
        $this->requestparamhnd = new ArrayHandler($par['requestparams'], $sanitizer);
	}

	public function getParam($key, $default = null, $sanitize = true) {
        $this->paramhnd->getValue($key, $default, $sanitize);
	}

	public function getRequestParam($key, $default = null, $sanitize = true) {
        $this->requestparamhnd->getValue($key, $default, $sanitize);
	}

	public function paramExists($key) {
		return $this->paramhnd->keyExists($key);
	}

	public function requestParamExists($key) {
		return $this->requestparamhnd->keyExists($key);
	}

	public function getBoolParam($key, $default = false) {
		return $this->paramhnd->getBoolValue($key, $default);
	}

	public function getNumParam($key, $default = 0) {
		return $this->paramhnd->getNumValue($key, $default);
	}

	public function getIntParam($key, $default = 0) {
		return $this->paramhnd->getIntValue($key, $default);
	}

	public function getFloatParam($key, $default = 0.0) {
		return $this->paramhnd->getFloatValue($key, $default);
	}

	public function getStringParam($key, $default = '') {
		return $this->paramhnd->getStringValue($key, $default);
	}

	public function getOriginalStringParam($key, $default = '') {
		return $this->paramhnd->getOriginalStringValue($key, $default);
	}

	public function getDateParam($key, $default = '') {
		return $this->paramhnd->getDateValue($key, $default);
	}

	public function getArrayParam($key, $default = array()) {
		return $this->paramhnd->getArrayValue($key, $default);
	}

	public function getBoolRequestParam($key, $default = false) {
		return $this->requestparamhnd->getBoolValue($key, $default);
	}

	public function getNumRequestParam($key, $default = 0) {
		return $this->requestparamhnd->getNumValue($key, $default);
	}

	public function getIntRequestParam($key, $default = 0) {
		return $this->requestparamhnd->getIntValue($key, $default);
	}

	public function getFloatRequestParam($key, $default = 0.0) {
		return $this->requestparamhnd->getFloatValue($key, $default);
	}

	public function getStringRequestParam($key, $default = '') {
		return $this->requestparamhnd->getStringValue($key, $default);
	}

	public function getOriginalStringRequestParam($key, $default = '') {
		return $this->requestparamhnd->getOriginalStringValue($key, $default);
	}

	public function getDateRequestParam($key, $default = '') {
		return $this->requestparamhnd->getDateValue($key, $default);
	}

	public function getArrayRequestParam($key, $default = array()) {
		return $this->requestparamhnd->getArrayValue($key, $default);
	}

}