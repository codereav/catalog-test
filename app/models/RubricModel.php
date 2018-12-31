<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 31.12.2018
 * Time: 16:19
 */

namespace App\Models;

use App\Contracts\ModelInterface;

class RubricModel implements ModelInterface
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $parentId;
    /**
     * @var string
     */
    protected $title;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     */
    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        // TODO: Implement validate() method.
        return true;
    }
}