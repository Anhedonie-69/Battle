<?php

abstract class SkillBase
{
    private string $name;
    private int $cost;

    protected $logs = [];

    public function getName(): string
    {
        return $this->name;
    }

    protected function setName(string $name)
    {
        $this->name = $name;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    protected function setCost(int $cost)
    {
        $this->cost = $cost;
    }

    public function getLogs()
    {
        return $this->logs;
    }

    abstract public function execute(ActorBase $caster, ActorBase $target): void;
}

?>