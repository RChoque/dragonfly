<?php

namespace Dragonfly\BugTrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;
use Dragonfly\CommonBundle\Entity\Traits\Timestampable;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="Dragonfly\BugTrackerBundle\Entity\Repository\MessageRepository")
 */
class Message
{
    use Timestampable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Bug
     *
     * @ORM\ManyToOne(targetEntity="Bug", inversedBy="messages", cascade={"persist"})
     * @ORM\JoinColumn(name="bug_id", referencedColumnName="id", nullable=false)
     */
    private $bug;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="Merci de renseigner un intitulé")
     */
    private $title;
    
    /**
     * @var text
     * @ORM\Column(name="content", type="text", nullable=false)
     * @Assert\NotBlank(message="Merci de renseigner un texte")
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;
    

    /**
     * Constructor
     */
    public function  __construct()
    {
        $this->setPosition(0);
    }
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Message
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set bug
     *
     * @param \Dragonfly\BugTrackerBundle\Entity\Bug $bug
     *
     * @return Message
     */
    public function setBug(\Dragonfly\BugTrackerBundle\Entity\bug $bug)
    {
        $this->bug = $bug;

        return $this;
    }

    /**
     * Get bug
     *
     * @return \Dragonfly\BugTrackerBundle\Entity\Bug
     */
    public function getBug()
    {
        return $this->bug;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Paragraph
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }


    public function __toString(){
        return $this->getTitle();
    }

}
