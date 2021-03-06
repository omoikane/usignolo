<?php

/*
 * This file is part of Usignolo.
 *
 * (c) Daniele De Nobili <danieledenobili@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Usignolo\Bundle\UsignoloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Issue entity.
 *
 * @author Daniele De Nobili <danieledenobili@gmail.com>
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Usignolo\Bundle\UsignoloBundle\Entity\IssueRepository")
 */
class Issue
{
    /**
     * Issue identifier.
     *
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Issue title.
     *
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title = '';

    /**
     * Issue description.
     *
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotNull()
     */
    private $description = '';

    /**
     * Issue complete flag.
     *
     * @var bool
     *
     * @ORM\Column(name="is_complete", type="boolean")
     */
    private $complete = false;

    /**
     * Set complete.
     *
     * @param boolean $complete
     * @return $this
     */
    public function setComplete($complete = true)
    {
        $this->complete = (bool) $complete;

        return $this;
    }

    /**
     * Indicates whether the issue is completed.
     *
     * @return boolean
     */
    public function isComplete()
    {
        return $this->complete;
    }

    /**
     * Get identifier.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     * @return Issue
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string $description
     * @return Issue
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
