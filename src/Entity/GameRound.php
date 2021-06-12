<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Game Round with a Nr. and 2 Players playing against each other
 *
 * @ORM\Entity
 * @ORM\Table(name="gameRounds")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\HasLifecycleCallbacks
 */
class GameRound
{
    /**
     * The unique auto incremented primary key.
     *
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\GeneratedValue
     */
    protected $roundID;

    /**
     * Round Nr.
     *
     * @ORM\Column(type="integer")
     */
    protected int $roundNr;

    /**
     * Player 1
     *
     * @ORM\Column(type="string")
     */
    protected string $player1;

    /**
     * Player 2
     *
     * @ORM\Column(type="string")
     */
    protected string $player2;

    /**
     * Symbol 1
     *
     * @ORM\Column(type="blob")
     */
    protected $symbol1;

    /**
     * Symbol 2
     *
     * @ORM\Column(type="blob")
     */
    protected $symbol2;

    /**
     * GameRound constructor.
     * @param $roundNr
     * @param $player1
     * @param $player2
     * @param $symbol1
     * @param $symbol2
     */
    public function __construct($roundNr, $player1, $player2, $symbol1, $symbol2)
    {
        $this->roundNr = $roundNr;
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->symbol1 = fopen($symbol1['tmp_name'], 'rb');
        $this->symbol2 = fopen($symbol2['tmp_name'], 'rb');
    }

}