<?php

namespace app\core;

abstract class Model {
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MATCH = 'match';

    public array $errors = [];

    public function loadData($data) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this -> {$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function validate() {
        foreach ($this -> rules() as $attribute => $rules) {
            $value = $this -> {$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && (!$value || $value === '')) {
                    $this -> addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this -> addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this -> addError($attribute, self::RULE_MIN);
                }
                if ($ruleName == self::RULE_MATCH && $value !== $this -> {$rule['match']}) {
                    $this -> addError($attribute, self::RULE_MATCH);
                }
            }
        }
        // return true if no validation errors exist
        return empty($this -> errors);
    }
    public function addError($attribute, $rule) {
        $message = $this -> errorMessages()[$rule] ?? '';
        $this -> errors[$attribute][] = $message;
    }

    public function errorMessages() {
        return [
            self::RULE_REQUIRED => 'This is required',
            self::RULE_EMAIL => 'Invalid email',
            self::RULE_MIN => 'Less than min',
            self::RULE_MATCH => 'Doesn\'t match',
        ];
    }

    public function hasError($attribute) {
        return $this -> errors[$attribute] ?? false;
    }

    public function getFirstError($attribute) {
        return $this -> errors[$attribute][0] ?? false;
    }
}