<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 30.12.2018
 * Time: 11:42
 */

namespace App\Contracts;


interface ModelInterface
{
    public function validate(): bool;
}