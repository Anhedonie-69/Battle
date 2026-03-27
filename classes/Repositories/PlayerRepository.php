<?php

class PlayerRepository
{
    private PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getPlayerById($id)
    {
        $request = $this->db->prepare('
            SELECT * FROM players
            WHERE id = ?
        ');
        $request->execute([$id]);
        $player = $request->fetch();

        $actor = PlayerMapper::mapToObject($player);

        return $actor;
    }

    public function getAlivePlayers()
    {
        $request = $this->db->prepare('
            SELECT * FROM players
            WHERE is_dead = 0
        ');
        $request->execute();
        $rows = $request->fetchAll();

        $players = [];

        foreach ($rows as $row) {
            $players[] = PlayerMapper::mapToObject($row);
        }

        return $players;
    }

    public function createPlayer($name)
    {
        $request = $this->db->prepare('
            INSERT INTO players (name)
            VALUES (:name)
        ');
        $request->execute([
            'name' => $name,
        ]);
    }

    public function updatePlayer(Player $player)
    {
        $request = $this->db->prepare('
            UPDATE players
            SET current_hp = :current_hp,
                current_mp = :current_mp,
                is_dead = :is_dead
            WHERE id = :id
        ');
        
        $request->execute(
            PlayerMapper::mapToArray($player)
        );
    }
}

?>