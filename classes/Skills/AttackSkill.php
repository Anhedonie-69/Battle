<?php

class AttackSkill extends SkillBase
{
    

    public function __construct()
    {
        $this->setName("Attack");
        $this->setCost(0);
    }

    public function execute(ActorBase $caster, ActorBase $target): void
    {
        $this->logs = [];
        $damage = $caster->getAtk() - $target->getDef();
        $target->takeDamage($damage);

        $this->logs[] = $caster->getName() . " attaque " . $target->getName();
        $this->logs[] = $target->getName() . " reçoit " . $damage . " points de dégâts !";  
    }

}

?>