<?php

abstract class ActorBase
{   
    private string $name;
    private int $maxHp;
    private int $currentHp;
    private int $maxMp;
    private int $currentMp;
    private int $atk;
    private int $def;
    private int $velocity;
    private float $currentTime;

    public function __construct(
        string $name,
        int $maxHp,
        int $currentHp,
        int $maxMp,
        int $currentMp,
        int $atk,
        int $def,
        int $velocity,
        float $currentTime
        )
    {
        $this->setName($name);
        $this->setMaxHp($maxHp);
        $this->setCurrentHp($currentHp);
        $this->setMaxMp($maxMp);
        $this->setCurrentMp($currentMp);
        $this->setAtk($atk);
        $this->setDef($def);
        $this->setVelocity($velocity);
        $this->setCurrentTime($currentTime);
    }

    // GET & SET
    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getMaxHp()
    {
        return $this->maxHp;
    }

    public function setMaxHp(int $hp)
    {
        $this->maxHp = $hp;
    }

    public function getCurrentHp()
    {
        return $this->currentHp;
    }

    public function setCurrentHp(int $hp)
    {
        $this->currentHp = $hp;
    }

    public function getMaxMp()
    {
        return $this->maxMp;
    }

    public function setMaxMp(int $mp)
    {
        $this->maxMp = $mp;
    }

    public function getCurrentMp()
    {
        return $this->currentMp;
    }

    public function setCurrentMp(int $mp)
    {
        $this->currentMp = $mp;
    }

    public function getAtk()
    {
        return $this->atk;
    }

    public function setAtk(int $atk)
    {
        $this->atk = $atk;
    }

    public function getDef()
    {
        return $this->def;
    }

    public function setDef(int $def)
    {
        $this->def = $def;
    }

    public function getVelocity()
    {
        return $this->velocity;
    }

    public function setVelocity(int $velocity)
    {
        $this->velocity = $velocity;
    }

    public function getCurrentTime()
    {
        return $this->currentTime;
    }

    public function setCurrentTime(float $time)
    {
        $this->currentTime = $time;
    }

    // METHODS
    public function hit(){}
}

?>