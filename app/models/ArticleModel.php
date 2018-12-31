<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 30.12.2018
 * Time: 11:46
 */

namespace App\Models;

use App\Contracts\ModelInterface;

class ArticleModel implements ModelInterface
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $content;
    /**
     * @var int
     */
    private $authorId;
    /**
     * @var int
     */
    private $rubricId;
    /**
     * @var string
     */
    private $authorName;

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
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @param int $authorId
     */
    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    /**
     * @return int
     */
    public function getRubricId(): int
    {
        return $this->rubricId;
    }

    /**
     * @param int $rubricId
     */
    public function setRubricId(int $rubricId): void
    {
        $this->rubricId = $rubricId;
    }

    /**
     * @return string
     */
    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * @param string $authorName
     */
    public function setAuthorName(?string $authorName): void
    {
        $this->authorName = $authorName;
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