<?php

namespace Qtlenh\LaravelStrictValidator\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Qtlenh\LaravelStrictValidator\StrictValidator;

class StrictValidatorProvider extends ServiceProvider
{
	public function boot() {
		Validator::resolver(function ($translator, $data, $rules, $messages, $attributes) {
			$validator = new StrictValidator($translator, $data, $rules, $messages, $attributes);

			$validator->addReplacer('decimal', function($message, $attribute, $rule, $parameters, $validator) {
				return str_replace(':decimal', implode('-', $validator->excludeStrictParameter($parameters)), $message);
			});

			return $validator;
		});
	}
}