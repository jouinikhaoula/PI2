<?php

namespace AllForKids\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneCommandes
 *
 * @ORM\Table(name="ligne_commandes")
 * @ORM\Entity(repositoryClass="AllForKids\MainBundle\Repository\LigneCommandesRepository")
 */
class LigneCommandes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="PrixTotal", type="float")
     */
    private $prixTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="NbrArticles", type="integer")
     */
    private $nbrArticles;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set prixTotal
     *
     * @param float $prixTotal
     *
     * @return LigneCommandes
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return float
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set nbrArticles
     *
     * @param string $nbrArticles
     *
     * @return LigneCommandes
     */
    public function setNbrArticles($nbrArticles)
    {
        $this->nbrArticles = $nbrArticles;

        return $this;
    }

    /**
     * Get nbrArticles
     *
     * @return string
     */
    public function getNbrArticles()
    {
        return $this->nbrArticles;
    }
}

