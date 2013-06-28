<?php
namespace Timestampable\Fixture;

use Gedmo\Timestampable\Timestampable;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class TitledArticle implements Timestampable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=128)
     */
    private $title;

    /**
     * @ORM\Column(name="text", type="string", length=128)
     */
    private $text;

    /**
     * @ORM\Column(name="state", type="string", length=128)
     */
    private $state;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(name="chtext", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field="text")
     */
    private $chtext;

    /**
     * @var \DateTime $chtitle
     *
     * @ORM\Column(name="chtitle", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field="title")
     */
    private $chtitle;

    /**    
     * @var \DateTime $closed
     *
     * @ORM\Column(name="closed", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field="state", value={"Published", "Closed"})
     */
    private $closed;

    /**
     * @param \DateTime $chtext
     */
    public function setChtext($chtext)
    {
        $this->chtext = $chtext;
    }

    /**
     * @return \DateTime
     */
    public function getChtext()
    {
        return $this->chtext;
    }

    /**
     * @param \DateTime $chtitle
     */
    public function setChtitle($chtitle)
    {
        $this->chtitle = $chtitle;
    }

    /**
     * @return \DateTime
     */
    public function getChtitle()
    {
        return $this->chtitle;
    }

    /**
     * @param \DateTime $closed
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;
    }

    /**
     * @return \DateTime
     */
    public function getClosed()
    {
        return $this->closed;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}
