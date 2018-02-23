<?php

namespace Collejo\App\Http\JsValidator;

class JsValidator
{
    protected $rules;

    protected $attributes;

    public function __construct(array $rules, array $attributes)
    {
        $this->rules = collect($rules);
        $this->attributes = collect($attributes);

        $this->processRules();
    }

    /**
     * Provess rules
     */
    private function processRules()
    {
        $this->rules = $this->rules->map(function ($rules, $element) {
            return $this->processItemRules($rules);
        });
    }

    /**
     * Renders a set of rules in the Laravel json object format
     *
     * @return string
     */
    public function renderRules()
    {
        return json_encode($this->rules);
    }

    /**
     * Process form field rules
     *
     * @param $rules
     * @return \stdClass
     */
    private function processItemRules($rules)
    {
        $rules = explode('|', $rules);

        $returned = new \stdClass();

        foreach ($rules as $rule) {
            $ruleParts = explode(':', $rule);
            $rule = $ruleParts[0];
            $ruleOptions = isset($ruleParts[1]) ? explode(',', $ruleParts[1]) : null;
            $method = 'rule'.ucfirst($rule);

            switch ($rule) {
                case 'max':
                    $returned->maxlength = intval($ruleOptions[0]);
                    break;

                case 'min':
                    $returned->minlength = intval($ruleOptions[0]);
                    break;

                case 'between':
                    $returned->rangelength = [intval($ruleOptions[0]), intval($ruleOptions[1])];
                    break;

                case 'required':
                    $returned->required = true;
                    break;

                case 'email':
                    $returned->email = true;
                    break;

                case 'url':
                    $returned->url = true;
                    break;
            }
        }

        return $returned;
    }
}
