<?php

class GobelinEnemy extends EnemyBase
{
    private $stats = [
        'maxHp' => 10,
        'maxMp' => 5,
        'atk' => 8,
        'def' => 6,
        'velocity' => 8
    ];

    public function __construct()
    {
        parent::__construct(
            'Gobelin',
            $this->stats['maxHp'],
            $this->stats['maxHp'],
            $this->stats['maxMp'],
            $this->stats['maxMp'],
            $this->stats['atk'],
            $this->stats['def'],
            $this->stats['velocity'],
            0 // currentTime
            );
    }
}

?>