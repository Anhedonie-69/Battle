<?php

class Skills
{
    /**
    * @var SkillBase[]
    */
    private array $skills = [];

    public function __construct()
    {
        
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function getSkillByName(string $name): ?SkillBase
    {
        foreach ($this->skills as $skill) {
            if ($skill->getName() === $name) {
                return $skill;
            }
        }
    
        return null;
    }

    public function addSkill(SkillBase $skill): void
    {
        $this->skills[] = $skill;
    }
}

?>