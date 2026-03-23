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

    public function getAllPlayers()
    {

    }
}

?>