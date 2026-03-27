<?php
session_start();

include "config/db.php";
include "config/autoloader.php";

if (isset($_POST['selectedPlayer']))
{
    $_SESSION['player_id'] = $_POST['selectedPlayer'];

    header("Location: public/battle.php");
    exit();
}

$db = new DB();
$playerRepository = new PlayerRepository($db->getDataBase());

$players = $playerRepository->getAlivePlayers();

if (isset($_POST['action']) && $_POST['action'] === 'createPlayer')
{
    $playerRepository->createPlayer($_POST['player_name']);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="public/assets/styles/index.css" rel="stylesheet">
</head>
<body>
    <h1 class="game-title">PHP QUEST</h1>
    <p class="subtitle">Un RPG tour par tour en PHP</p>

    <h2>Choisir un joueur</h2>

    <form method="POST" class="player-list">
        <?php foreach ($players as $player): ?>
            <div class="player-card">
                <div>
                    <strong><?= $player->getName(); ?></strong>
                    <span>(HP: <?= $player->getCurrentHp(); ?>)</span>
                </div>

                <?php if (!$player->getIsDead()): ?>
                    <button name="selectedPlayer" value="<?= $player->getId(); ?>">
                        Sélectionner
                    </button>
                <?php else: ?>
                    <span class="dead">💀 Mort</span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </form>

    <h2>Créer un joueur</h2>

    <form method="POST" class="create-player">
        <input type="text" name="player_name" placeholder="Nom du joueur" required>
        <button name="action" value="createPlayer">Créer</button>
    </form>

</body>
</html>