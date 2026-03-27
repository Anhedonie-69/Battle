<?php

class MagicSkill extends SkillBase
{
    public function __construct()
    {
        $this->setName("Magic");
        $this->setCost(2);
    }

    public function execute(ActorBase $caster, ActorBase $target): void
    {
        $this->logs = [];
        $damage = $caster->getAtk() - $target->getDef();
        $target->takeDamage($damage);

        $this->logs[] = $caster->getName() . " lance une magie sur " . $target->getName();
        $this->logs[] = $target->getName() . " reçoit " . $damage . " points de dégâts !"; 
    }
}

?>