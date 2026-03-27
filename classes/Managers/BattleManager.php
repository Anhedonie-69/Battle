<?php
class BattleManager
{
    private PlayerRepository $playerRepository;
    private Player $player;
    private EnemyBase $enemy;

    private bool $isBattle;
    private array $actors = [];
    private array $logs = [];

    public function __construct($playerRepo)
    {
        $this->playerRepository = $playerRepo;
    }

    /* ===================== PUBLIC ===================== */

    public function runBattle()
    {
        if (empty($this->actors)) {
            $this->initialyseBattle();
            $this->saveToSession();
        }

        $this->sortActors();
        if ($this->isBattle)
        {
            $this->handleTurn();
        }
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getEnemy(): EnemyBase
    {
        return $this->enemy;
    }
    
    public function getLogs(): array
    {
        return $this->logs;
    }

    public function isBattleRunning(): bool
    {
        return $this->isBattle;
    }

    /* ===================== INIT ===================== */

    private function initialyseBattle()
    {
        $this->player = $this->playerRepository->getPlayerById($_SESSION['player_id']);
        $this->playerRepository->updatePlayer($this->player);
        $this->addActor($this->player);

        $this->enemy = new GobelinEnemy();
        $this->addActor($this->enemy);

        foreach($this->actors as $actor)
        {
            $this->setCurrentTime($actor);
        }

        $this->isBattle = true;
        $this->addLog("La bataille commence !");        
    }

    /* ===================== TURN ===================== */

    private function handleTurn(): void
    {
        $this->addLog($this->actors[0]->getName() . " joue son tour !");

        if(!$this->actors[0] instanceof Player){
            $this->resolveAction("Attack");
        }
    }

    public function resolveAction(string $action)
    {
        $attacker = $this->getCurrentActor();
        $target = $this->getTarget($attacker);

        $skill = $attacker->getSkills()->getSkillByName($action);
        $skill->execute($attacker, $target);
        $logs = $skill->getLogs();
        foreach($logs as $log)
        {
            $this->addLog($log);
        }
        $this->endTurn($target);
    }

    private function endTurn($target)
    {
        if($target->getIsDead()){
            if($target instanceof Player)
            {
                $log = "Vous avez perdu !";
                $this->addLog($log);
                $this->endBattle();
            }
            else
            {
                $log = "Vous avez gagné !";
                $this->addLog($log);
                $this->endBattle();
            }
        }
        else
        {
            $this->setCurrentTime($this->actors[0]);
            $this->sortActors();

            $this->updateTurn();
        }  
    }

    public function updateTurn()
    {
        $this->saveToSession();

        header("Location: ../../public/battle.php");
        exit();
    }

    public function endBattle()
    {
        $log ="Bataille terminée.";
        $this->addLog($log);
        $this->saveToSession();
        $this->isBattle = false;
    }

    /* ===================== HELPERS ===================== */

    private function getCurrentActor(): ActorBase
    {
        return $this->actors[0];
    }

    private function getTarget(ActorBase $attacker): ActorBase
    {
        return ($attacker instanceof Player) ? $this->enemy : $this->player;
    }

    private function setCurrentTime($actor)
    {
        $speed = 100 / $actor->getVelocity();
        $time = $actor->getCurrentTime() + $speed;
        $actor->setCurrentTime($time);
    }

    private function sortActors()
    {
        usort($this->actors, function ($a, $b) {
            return $a->getCurrentTime() <=> $b->getCurrentTime();
        });
    }

    private function addLog(string $message): void
    {
        $this->logs[] = $message;
    }

    private function addActor(ActorBase $actor): void
    {
        $this->actors[] = $actor;
    }

    /* ===================== SESSION ===================== */

    public function saveToSession(): void
    {
        $_SESSION['battle'] = [
            'actors' => array_map(function($actor) {
                return [
                    'type' => $actor instanceof Player ? 'player' : 'enemy',
                    'id' => $actor instanceof Player ? $actor->getId() : 0,
                    'hp' => $actor->getCurrentHp(),
                    'currentTime' => $actor->getCurrentTime()
                ];
            }, $this->actors),
            'logs' => $this->logs,
            'isBattle' => $this->isBattle
        ];

        // TODO A réactiver sur le projet final
        //$this->playerRepository->updatePlayer($this->player);

    }

    public function loadFromSession(): void
    {
        if (!isset($_SESSION['battle'])) return;

        $this->logs = $_SESSION['battle']['logs'] ?? [];
        $this->isBattle = $_SESSION['battle']['isBattle'] ?? true;

        $this->actors = [];

        foreach ($_SESSION['battle']['actors'] as $data) {
            if($data['type'] === 'player')
            {
                $this->player = $this->playerRepository->getPlayerById($data['id']);
                $this->player->setCurrentHp($data['hp']);
                $this->player->setCurrentTime($data['currentTime']);
                $this->addActor($this->player);
            }
            else if($data['type'] === 'enemy')
            {
                $this->enemy = new GobelinEnemy();
                $this->enemy->setCurrentHp($data['hp']);
                $this->enemy->setCurrentTime($data['currentTime']);
                $this->addActor($this->enemy);
            }
        }
    }
}

?>