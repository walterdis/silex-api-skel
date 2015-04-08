<?php
/**
 * This file is part of Skel system
 *
 * @copyright Skel
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
namespace Domain\Entity\Albums;

use Domain\Entity\Entity;

/**
 * Interface Album
 * @package Domain\Entity\Users
 */
interface Album extends Entity
{
    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $coverImage
     * @return void
     */
    public function setCoverImage($coverImage);

    /**
     * @return string
     */
    public function getCoverImage();

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param DateTime $date
     * @return void
     */
    public function setPublishedAt($date);

    /**
     * @return DateTime
     */
    public function getPublishedAt();

}
