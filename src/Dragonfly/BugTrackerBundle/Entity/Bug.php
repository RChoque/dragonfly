<?php

namespace Dragonfly\BugTrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\Common\Collections\ArrayCollection;
use Dragonfly\CommonBundle\Entity\Traits\Timestampable;

/**
 * Bug
 *
 * @ORM\Table(name="bug")
 * @ORM\Entity(repositoryClass="Dragonfly\BugTrackerBundle\Entity\Repository\BugRepository")
 */
class Bug
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="string", length=255, nullable=true)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="bug", cascade={"remove", "persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     */
    protected $messages;

    /**
     * @var project
     *
     * @ORM\ManyToOne(targetEntity="\Dragonfly\CommonBundle\Entity\Project", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=true)
     */
    private $project;

    /**
     * @var state
     *
     * @ORM\ManyToOne(targetEntity="\Dragonfly\CommonBundle\Entity\State", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", nullable=true)
     */
    private $state;

    /**
     * Constructor
     */
    public function  __construct()
    {
        $this->setCreateDate(new \DateTime());
        $this->setUpdateDate(new \DateTime());
        $this->messages = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Bug
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
     * Set summary
     *
     * @param string $summary
     *
     * @return Bug
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Bug
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set project
     *
     * @param \Dragonfly\CommonBundle\Entity\Project $project
     * @return Order
     */
    public function setProject(\Dragonfly\CommonBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Dragonfly\CommonBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set state
     *
     * @param \Dragonfly\CommonBundle\Entity\State $state
     * @return Order
     */
    public function setState(\Dragonfly\CommonBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Dragonfly\CommonBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add message
     *
     * @param \Dragonfly\BugTrackerBundle\Entity\Message $message
     *
     * @return Bug
     */
    public function addmessage(\Dragonfly\BugTrackerBundle\Entity\Message $message)
    {
        $message->setJob($this);
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove message
     *
     * @param \Dragonfly\BugTrackerBundle\Entity\Message $message
     */
    public function removeMessage(\Dragonfly\BugTrackerBundle\Entity\Message $message)
    {
        if($this->messages->contains($message)){
            $this->messages->removeElement($message);
        }
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }

}