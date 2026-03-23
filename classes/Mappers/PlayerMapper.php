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
            (bool)$data['is_dead']
        );
    }
}

?>