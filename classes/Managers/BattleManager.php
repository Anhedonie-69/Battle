<?php

class BattleManager
{
    private PlayerRepository $playerRepository;
    private Player $player;
    private EnemyBase $enemy;

    private array $actors;
    private array $turnOrder;

    public function __construct($playerRepo)
    {
        $this->playerRepository = $playerRepo;
    }

    public function runBattle()
    {
        $this->initialyseBattle();
    }

    private function initialyseBattle()
    {
        $this->player = $this->playerRepository->getPlayerById(1);
        $this->addActor($this->player);
        
        echo $this->player->getName() . " is in the battle !";
        echo $this->player->getMaxHp() . " <- maxHp.<br>";
        echo $this->player->getCurrentHp() . " <- currentHp.<br><br>";

        $this->enemy = new GobelinEnemy();
        $this->addActor($this->enemy);

        echo $this->enemy->getName() . " is in the battle !";
        echo $this->enemy->getMaxHp() . " <- maxHp.<br>";
        echo $this->enemy->getCurrentHp() . " <- currentHp.<br><br>";
       
        echo "Battle Start !<br><br>";

        foreach($this->actors as $actor)
            {
                $this->setCurrentTime($actor);
                echo $actor->getName() . " currentTime : " . $actor->getCurrentTime() . "<br>";
            }
        //var_dump($this->actors);
        //$this->startTurn();
    }

    private function addActor(ActorBase $actor): void
    {
        $this->actors[] = $actor;
    }

    private function setCurrentTime($actor)
    {
        $speed = 100 / $actor->getVelocity();
        $time = $actor->getCurrentTime() + $speed;
        $actor->setCurrentTime($time);
    }

    private function startTurn()
    {
        
    }

    private function endTurn()
    {

    }

    private function endBattle()
    {

    }

    // Calculer les X prochains tours
    private function generateNextTurns(int $nextTurns)
    {
        
        for($i = 0 ; $i < $nextTurns; $i++)
            {

            }
    }
}

?>