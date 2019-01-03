<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 28.12.2018
 * Time: 17:30
 */

namespace App\Components;

class View
{
    private const TEMPLATE_PATH = 'views';
    private $folder;
    private $parts = [];
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = Application::getInstance()->getConfig()['baseUrl'];
    }

    public function render(array $data, bool $ajax = false)
    {
        if ($ajax) {
            $result = '';
        }
        foreach ($this->parts as $part) {
            if ($ajax) {
                $data['ajax'] = 1;
                $result .= $this->renderPart($part, $data);
            } else {
                $data['ajax'] = 0;
                echo $this->renderPart($part, $data);
            }
        }
        if ($ajax) {
            return $result;
        }
    }

    public function addPart(string $partname): void
    {
        $this->parts[] = APP_PATH . DS . self::TEMPLATE_PATH . DS . ($this->folder ? (DS . $this->folder . DS) : '') . $partname . '.view.php';
    }

    protected function renderPart(string $filepath, array $data): string
    {
        if (file_exists($filepath)) {
            extract($data, EXTR_OVERWRITE);
            ob_start();
            require $filepath;
        }
        return ob_get_clean();

    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}