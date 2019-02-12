<?php

namespace Kunstmaan\FormBundle\Tests\Entity;

use DateTime;
use Kunstmaan\FormBundle\Entity\FormSubmission;
use Kunstmaan\NodeBundle\Entity\Node;
use PHPUnit\Framework\TestCase;

class FormSubmissionTest extends TestCase
{
    /**
     * @var FormSubmission
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new FormSubmission();
    }

    public function testSetGetId()
    {
        $object = $this->object;
        $id = 123;
        $object->setId($id);
        $this->assertEquals($id, $object->getId());
    }

    public function testSetGetIpAddress()
    {
        $object = $this->object;
        $ip = '127.0.0.1';
        $object->setIpAddress($ip);
        $this->assertEquals($ip, $object->getIpAddress());
    }

    public function testSetGetNode()
    {
        $object = $this->object;
        $node = new Node();
        $node->setId(123);
        $object->setNode($node);
        $retrievedNode = $object->getNode();
        $this->assertEquals($node, $retrievedNode);
        $this->assertEquals($node->getId(), $retrievedNode->getId());
    }

    public function testSetGetLang()
    {
        $object = $this->object;
        $lang = 'nl';
        $object->setLang($lang);
        $this->assertEquals($lang, $object->getLang());
    }

    public function testSetGetCreated()
    {
        $object = $this->object;
        $now = new DateTime();
        $object->setCreated($now);
        $this->assertEquals($now, $object->getCreated());
    }

    public function testGetFields()
    {
        $object = $this->object;
        $object->getFields();
    }

    public function testToString()
    {
        $stringValue = $this->object->__toString();
        $this->assertNotNull($stringValue);
        $this->assertTrue(is_string($stringValue));
    }
}