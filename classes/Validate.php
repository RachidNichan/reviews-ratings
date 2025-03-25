<?php

class Validate {
    private $_passed = false;
    private $_errors = [];
    private $_db;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    /**
     * Validate input based on given rules.
     *
     * @param array $source The data to validate.
     * @param array $items The validation rules for the data.
     * @return Validate The current instance of the validation class.
     */
    public function check($source, $items = []) {
        $lang = new Lang();

        foreach ($items as $item => $rules) {
            $value = $source[$item] ?? null;
            $name_rule = $rules['name'] ?? $item;

            foreach ($rules as $rule => $rule_value) {
                if ($rule === 'name') continue; // Skip 'name' key as it's already assigned

                // Perform validation based on rule type
                switch ($rule) {
                    case 'required':
                        if (empty($value)) {
                            $this->addError($this->getErrorMessage($lang, 'name_is_required', $name_rule));
                        }
                        break;
                    case 'min':
                        if (strlen($value) < $rule_value) {
                            $this->addError($this->getErrorMessage($lang, 'min_characters_length', $name_rule, $rule_value));
                        }
                        break;
                    case 'max':
                        if (strlen($value) > $rule_value) {
                            $this->addError($this->getErrorMessage($lang, 'max_characters_length', $name_rule, $rule_value));
                        }
                        break;
                    case 'matches':
                        if ($value !== $source[$rule_value]) {
                            $this->addError("{$rule_value} must match {$name_rule}");
                        }
                        break;
                    case 'username':
                        if (!preg_match('/^[A-Za-z0-9._-]+$/', $value)) {
                            $this->addError($this->getErrorMessage($lang, 'username_invalid_characters', $name_rule));
                        }
                        break;
                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($lang->get('email_invalid_characters'));
                        }
                        break;
                    case 'url':
                        if (!filter_var($value, FILTER_VALIDATE_URL)) {
                            $this->addError($lang->get('this_url_is_invalid'));
                        }
                        break;
                    case 'unique':
                        $this->checkUnique($item, $value, $rule_value, $name_rule);
                        break;
                }
            }
        }

        // Set validation status
        if (empty($this->_errors)) {
            $this->_passed = true;
        }

        return $this;
    }

    /**
     * Helper method to generate error messages with dynamic replacements.
     *
     * @param Lang $lang The language instance.
     * @param string $lang_key The language key for the message.
     * @param string $name_rule The name of the field.
     * @param mixed $value Additional value for replacement (e.g., min/max value).
     * @return string The error message.
     */
    private function getErrorMessage($lang, $lang_key, $name_rule, $value = null) {
        $message = str_replace('{name}', $name_rule, $lang->get($lang_key));
        if ($value !== null) {
            $message = str_replace('{value}', $value, $message);
        }
        return $message;
    }

    /**
     * Checks if the value is unique in the database.
     *
     * @param string $item The field to check.
     * @param string $value The value to check.
     * @param string $table The table to check in.
     * @param string $name_rule The name of the field.
     */
    private function checkUnique($item, $value, $table, $name_rule) {
        $check = $this->_db->get($table, [$item, '=', $value]);
        if ($check->count()) {
            $this->addError($this->getErrorMessage(new Lang(), 'name_already_exists', $name_rule));
        }
    }

    /**
     * Add error to the error list.
     *
     * @param string $error The error message.
     */
    private function addError($error) {
        $this->_errors[] = $error;
    }

    /**
     * Get all validation errors.
     *
     * @return array The list of error messages.
     */
    public function errors() {
        return $this->_errors;
    }

    /**
     * Check if validation passed.
     *
     * @return bool True if validation passed, false otherwise.
     */
    public function passed() {
        return $this->_passed;
    }
}

?>
