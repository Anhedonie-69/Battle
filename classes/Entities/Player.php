<?php

class Player extends ActorBase
{
    private $id;
    private bool $isDead;
    private $stats = [
        'maxHp' => 10,
        'maxMp' => 5,
        'atk' => 8,
        'def' => 6,
        'velocity' => 10
    ];

    public function __construct(int $id, string $name, $hp, $mp, bool $isDead = false)
    {
        $this->id =$id;

        parent::__construct(
            $name,
            $this->stats['maxHp'],
            $hp ? $hp : $this->stats['maxHp'],
            $this->stats['maxMp'],
            $mp ? $mp : $this->stats['maxMp'],
            $this->stats['atk'],
            $this->stats['def'],
            $this->stats['velocity'],
            0 // currentTime
        );
    }

    public function getId()
    {
        return $this->id;
    }

}

?>