<?php
namespace Class;

class Validator {

    public static function isRequired($value) {
        return !empty(trim($value));
    }

    public static function isEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function isNumber($value) {
        return is_numeric($value);
    }

    public static function minLength($value, $length) {
        return strlen(trim($value)) >= $length;
    }

    public static function validateImage($file) {
        return isset($file['name']) && $file['error'] === 0;
    }

    public static function validateSelect($value) {
        return $value !== "";
    }
    public static function validateSpecie($specieid) {
        // Assuming valid species IDs are positive integers
        return self::validateSelect($specieid) && filter_var($specieid, FILTER_VALIDATE_INT) !== false && $specieid > 0;
    }

    public static function validateGender($gender) {
        $validGenders = ['M', 'F'];
        return self::validateSelect($gender) && in_array($gender, $validGenders);
    }
}
?>