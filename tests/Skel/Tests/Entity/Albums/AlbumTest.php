<?php
/**
 * This file is part of Skel system
 *
 * @copyright Skel
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Application\Tests\Entity\Albums;

use Carbon\Carbon;
use DateTime;
use Skel\Entity\Albums\Album;
use Skel\Tests\ChangeProtectedAttribute;
use PHPUnit_Framework_TestCase;

/**
 * Album test case.
 *
 * @author Walter Discher Cechinel <mistrim@gmail.com>
 */
class AlbumTest extends PHPUnit_Framework_TestCase
{

    /**
     * @see \Skel\Tests\ChangeProtectedAttribute
     */
    use ChangeProtectedAttribute;

    /**
     * @return Album
     */
    protected static function getInstance()
    {
        return new Album();
    }

    /**
     * @return multitype:multitype:number
     */
    public function validObjects()
    {
        $obj = new \stdClass();
        $obj->id = 1;
        $obj->title = 'valid title';
        $obj->description = 'a valid description';
        $obj->coverImage = md5($obj->id+'album').'jpg';
        $obj->created = Carbon::now();
        $obj->modified = $obj->created->subDay(4);
        $obj->publishedAt = $obj->created->addDay();
        $obj->status = 1;

        return [
            [
                $obj
            ]
        ];
    }

    /**
     * @return multitype:multitype:number
     */
    public function invalidObjects()
    {
        $obj = new \stdClass();
        $obj->id = 'a';
        $obj->title = 'v';
        $obj->description = 'a';
        $obj->coverImage = md5($obj->id+'invalid_album').'jpg';
        $obj->created = Carbon::now();
        $obj->modified = $obj->created->addDay(4);
        $obj->publishedAt = $obj->created->subDay(4);
        $obj->status = 'wee';

        return [
            [
                $obj
            ]
        ];
    }

    /**
     * tests if the id is returned
     *
     * @test
     * @covers Skel\Entity\Albums\Album::getId
     * @dataProvider validObjects
     * @param \stdClass $obj
     */
    public function testIfTitleIsValid($obj)
    {
        $instance = self::getInstance();

        $this->modifyAttribute($instance, 'title', $obj->title);
        $this->assertEquals($instance->getTitle(), $obj->title);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @param \stdClass $obj
     *
     * @expectedException \InvalidArgumentException
     */
    public function titleMinimumLengthMustFail($obj)
    {
        $instance = self::getInstance();
        $instance->setTitle('a');
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @param \stdClass $obj
     *
     * @expectedException \InvalidArgumentException
     */
    public function titleMaxLengthMustFail($obj)
    {
        $instance = self::getInstance();

        $title = str_repeat('a', 257);
        $instance->setTitle($title);
    }

    /**
     * @test
     * @dataProvider invalidObjects
     * @param \stdClass $obj
     *
     * @expectedException \InvalidArgumentException
     */
    public function descriptionLengthMustFail($obj)
    {
        $instance = self::getInstance();
        $instance->setDescription('a');
    }

}
