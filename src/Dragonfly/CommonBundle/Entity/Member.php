<?php

namespace Dragonfly\CommonBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use \Symfony\Component\Validator\Constraints as Assert;

/**
 * Member
 *
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="Dragonfly\CommonBundle\Entity\Repository\MemberRepository")
 */
class Member
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id" , nullable=false)
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Role", cascade={"persist"})
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id" , nullable=false)
     */
    protected $role;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="members", cascade={"persist"})
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id" , nullable=false)
     */
    protected $project;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Dragonfly\CommonBundle\Entity\User $user
     *
     */
    public function setUser(\Dragonfly\CommonBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return \Dragonfly\CommonBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set role
     *
     * @param \Dragonfly\CommonBundle\Entity\Role $role
     *
     */
    public function setRole(\Dragonfly\CommonBundle\Entity\Role $role)
    {
        $this->role = $role;
    }

    /**
     * Get role
     *
     * @return \Dragonfly\CommonBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set project
     *
     * @param \Dragonfly\CommonBundle\Entity\Project $project
     *
     */
    public function setProject(\Dragonfly\CommonBundle\Entity\Project $project)
    {
        $this->project = $project;
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
}