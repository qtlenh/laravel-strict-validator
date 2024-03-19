<?php

namespace Qtlenh\LaravelStrictValidator;

use Illuminate\Validation\Validator;

class StrictValidator extends Validator
{
	protected $typeMap = [
		'validateInteger' => ['integer'],
		'validateNumeric' => ['integer', 'double'],
		'validateDecimal' => ['double'],
		'validateBoolean' => ['boolean'],
	];

	protected $castParameter = 'cast';
	protected $strictParameter = 'strict';

	public function validateInteger($attribute, $value, $parameters = [])
	{
		return $this->castOrValidateStrict(__FUNCTION__, $attribute, $value, $parameters);
	}

	public function validateNumeric($attribute, $value, $parameters = [])
	{
		return $this->castOrValidateStrict(__FUNCTION__, $attribute, $value, $parameters);
	}

	public function validateDecimal($attribute, $value, $parameters)
	{
		return $this->castOrValidateStrict(__FUNCTION__, $attribute, $value, $parameters);
	}

	public function validateBoolean($attribute, $value, $parameters = [])
	{
		return $this->castOrValidateStrict(__FUNCTION__, $attribute, $value, $parameters);
	}

	protected function castOrValidateStrict($fn, $attribute, $value, $parameters)
	{
		if (in_array($this->strictParameter, $parameters) && !in_array(gettype($value), $this->typeMap[$fn])) {
			return false;
		}

		if (!parent::$fn($attribute, $value, $this->excludeStrictParameter($parameters))) {
			return false;
		}

		if (in_array($this->castParameter, $parameters)) {
			$this->container->request->replace(data_set($this->data, $attribute, $fn == 'validateBoolean' ? (bool) $value : $value + 0));
		}

		return true;
	}

	public function excludeStrictParameter($parameters)
	{
		return array_values(array_diff($parameters, [$this->castParameter, $this->strictParameter]));
	}
}