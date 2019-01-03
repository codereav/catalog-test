<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 02.01.2019
 * Time: 21:01
 */

namespace App\Components;

class Request
{
    private $get;
    private $post;
    private $cookie;
    private $files;
    private $session;
    private $server;

    public function __construct()
    {
        $this->get = $this->clean($_GET);
        $this->post = $this->clean($_POST);
        $this->cookie = $this->clean($_COOKIE);
        $this->files = $this->clean($_FILES);
        $this->session = $this->clean($_SESSION);
        $this->server = $this->clean($_SERVER);
    }

    public function clean($data)
    {
        if (!empty($data)) {
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $data[$this->clean($key)] = $this->clean($value);
                }
            } else {
                $data = trim(htmlspecialchars($data));
            }
        }
        return $data;
    }

    public function get(string $var)
    {
        if (isset($this->get[$var])) {
            return $this->get[$var];
        }
    }

    public function post(string $var)
    {
        if (isset($this->post[$var])) {
            return $this->post[$var];
        }
    }

    public function cookie(string $var)
    {
        if (isset($this->cookie[$var])) {
            return $this->cookie[$var];
        }
    }

    public function files(string $var)
    {
        if (isset($this->files[$var])) {
            return $this->files[$var];
        }
    }

    public function session(string $var)
    {
        if (isset($this->session[$var])) {
            return $this->session[$var];
        }
    }

    public function server(string $var)
    {
        if (isset($this->server[$var])) {
            return $this->server[$var];
        }
    }

    public function isNotEmpty(string $var)
    {
        if (isset($this->$var)) {
            return !empty($this->$var);
        }
        return false;
    }

    public function getSafeString(string $string = '') {
        return strip_tags(stripslashes($string));
    }

    public function getSafeHtml(string $html = '') {
        return htmlentities(htmlspecialchars($html));
    }
}