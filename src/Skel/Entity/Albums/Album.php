<?php
/**
 * This file is part of Skel system
 *
 * @copyright Skel
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Skel\Entity\Albums;

use InvalidArgumentException;
use Skel\Entity\Entity;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationExceptionInterface;

/**
 *
 * @author Walter Discher Cechinel <mistrim@gmail.com>
 *
 * @ORM\Table(
 *      name="album",
 *      indexes={
 *          @ORM\Index(name="album_index_id", columns={"id"}),
 *          @ORM\Index(name="album_index_title", columns={"title"})
 *      }
 * )
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Album extends Entity implements \Domain\Entity\Albums\Album
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $coverImage;

    /**
     * @var
     */
    protected $publishedAt;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        try {
            v::string()->notEmpty()->length(2, 255)->assert($title);
        } catch (NestedValidationExceptionInterface $e) {
            throw new InvalidArgumentException(
                sprintf('The given title "%s" is invalid', $title), 500, $e
            );
        }

        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        try {
            v::string()->length(10, 255)->assert($description);
        } catch (NestedValidationExceptionInterface $e) {
            throw new InvalidArgumentException(
                sprintf('Description should be between %i and %i characters', 10, 255), 500, $e
            );
        }

        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * @return string
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    /**
     * @param string $coverImage
     */
    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;
    }
}
