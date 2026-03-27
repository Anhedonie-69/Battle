<?php

class EnemyBase extends ActorBase
{
    public function __construct(
        string $name,
        int $maxHp,
        int $currentHp,
        int $maxMp,
        int $currentMp,
        int $atk,
        int $def,
        int $velocity,
        float $currentTime,
        bool $isDead
        )
    {
        parent::__construct(
            $name,
            $maxHp,
            $currentHp,
            $maxMp,
            $currentMp,
            $atk,
            $def,
            $velocity,
            $currentTime,
            $isDead
        );
    }
}

?>