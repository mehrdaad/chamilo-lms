<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Entity;

use Chamilo\CoreBundle\Traits\UserTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PortfolioCategory.
 *
 * @ORM\Table(
 *     name="portfolio_category",
 *     indexes={
 *         @ORM\Index(name="user", columns={"user_id"})
 *     }
 * )
 * @ORM\Entity
 */
class PortfolioCategory
{
    use UserTrait;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected int $id;

    /**
     * @ORM\Column(name="title", type="text", nullable=false)
     */
    protected string $title;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected ?string $description;

    /**
     * @ORM\ManyToOne(targetEntity="Chamilo\CoreBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected User $user;

    /**
     * @ORM\Column(name="is_visible", type="boolean", options={"default":true})
     */
    protected bool $isVisible = true;

    /**
     * @ORM\OneToMany(targetEntity="Chamilo\CoreBundle\Entity\Portfolio", mappedBy="category")
     */
    protected \Doctrine\Common\Collections\ArrayCollection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->title;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Set title.
     *
     * @param string $title
     *
     * @return PortfolioCategory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get description.
     *
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param null|string $description
     *
     * @return PortfolioCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->isVisible;
    }

    /**
     * Set isVisible.
     *
     * @param bool $isVisible
     *
     * @return PortfolioCategory
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get items.
     *
     * @param bool $onlyVisibles
     *
     * @return ArrayCollection
     */
    public function getItems(Course $course = null, Session $session = null, $onlyVisibles = false)
    {
        $criteria = Criteria::create();

        if ($onlyVisibles) {
            $criteria->andWhere(
                Criteria::expr()->eq('isVisible', true)
            );
        }

        if ($course) {
            $criteria
                ->andWhere(
                    Criteria::expr()->eq('course', $course)
                )
                ->andWhere(
                    Criteria::expr()->eq('session', $session)
                )
            ;
        }

        return $this->items->matching($criteria);
    }

    public function setItems(ArrayCollection $items): self
    {
        $this->items = $items;

        return $this;
    }
}
