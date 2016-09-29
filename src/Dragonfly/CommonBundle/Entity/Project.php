<?php

namespace Dragonfly\CommonBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;
use Dragonfly\CommonBundle\Entity\Traits\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Dragonfly\CommonBundle\Entity\Repository\ProjectRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Project
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255, unique=true, nullable=false)
     */
    protected $slug;

    /**
     * @var workflow
     *
     * @ORM\ManyToOne(targetEntity="Workflow", cascade={"remove", "persist"})
     * @ORM\JoinColumn(name="workflow_id", referencedColumnName="id", nullable=true)
     */
    private $workflow;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Member", mappedBy="project", cascade={"remove", "persist"})
     */
    protected $members;

    /**
     * Constructor
     */
    public function  __construct()
    {
        $this->members = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set workflow
     *
     * @param \Dragonfly\CommonBundle\Entity\Workflow $workflow
     * @return Order
     */
    public function setWorkflow(\Dragonfly\CommonBundle\Entity\Workflow $workflow = null)
    {
        $this->workflow = $workflow;

        return $this;
    }

    /**
     * Get workflow
     *
     * @return \Dragonfly\CommonBundle\Entity\Workflow 
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

    /**
     * Add member
     *
     * @param \Dragonfly\CommonBundle\Entity\Member $member
     */
    public function addMember(\Dragonfly\CommonBundle\Entity\Member $member)
    {
        $this->members[] = $member;
    }

    /**
     * Remove member
     *
     * @param \Dragonfly\CommonBundle\Entity\Member $member
     */
    public function removeMember(\Dragonfly\CommonBundle\Entity\Member $member)
    {
        $this->members->removeElement($member);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }
}