<?php

class PlayerMapper
{
    public static function mapToObject(array $data): Player
    {
        return new Player(
            $data['id'],
            $data['name'],
            $data['current_hp'],
            $data['current_mp'],
            boolval($data['is_dead'])
        );
    }

    public static function mapToArray(Player $player): array
    {
        return [
            'id' => $player->getId(),
            'current_hp' => $player->getCurrentHp(),
            'current_mp' => $player->getCurrentMp(),
            'is_dead' => (int)$player->getIsDead()
        ];
    }
}

?>