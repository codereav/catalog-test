<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 18:10
 */

return [
    '/' => 'IndexController/indexAction',
    '/article/::num' => 'IndexController/articleViewAction/$1'
];