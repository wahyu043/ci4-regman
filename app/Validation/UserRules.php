<?php
namespace App\Validation;

class UserRules
{
    public function check_age(string $str): bool
    {
        $birthdate = strtotime($str);
        $age = (int) ((time() - $birthdate) / (365 * 24 * 60 * 60));
        return $age >= 17;
    }
}
