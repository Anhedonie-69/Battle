<?php

session_start();

include "../config/db.php";
include "../config/autoloader.php";

if(isset($_POST['action']))
{
    if ($_POST['action'] === 'clearSession')
    {
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit();
    }   
}

$db = new DB();
$playerRepository = new PlayerRepository($db->getDataBase());
$battleManager = new BattleManager($playerRepository);

// 1. Charger l’état depuis la session
$battleManager->loadFromSession();

// 2. Si bouton cliqué → jouer un tour
if (isset($_POST['action']))
{
    if ($_POST['action'] === 'Attack')
    {
        $battleManager->resolveAction("Attack");
        $battleManager->updateTurn();
    }
    if ($_POST['action'] === 'Magic')
    {
        $battleManager->resolveAction("Magic");
        $battleManager->updateTurn();
    }
}

// 3. Sinon → juste afficher
$battleManager->runBattle();
$player = $battleManager->getPlayer();
$skills = $player->getSkills()->getSkills();
$enemy = $battleManager->getEnemy();
$logs = array_slice($battleManager->getLogs(), -8);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle</title>

    <link href="assets/styles/battle.css" rel="stylesheet">
</head>
    <body>
        <div class="battle-log">
            <?php foreach ($logs as $log): ?>
                <div><?= $log ?></div>
            <?php endforeach; ?>
        </div>
            
        <div class="battle-container">
            
            <!-- ENNEMI -->
            <div class="actor enemy">
                <h3><?= $enemy->getName(); ?></h3>
                <?php $hpPercent = ($enemy->getCurrentHp() / $enemy->getMaxHp()) * 100; ?>
                <div class="hp-bar">
                    <div class="hp-fill" style="width: <?= $hpPercent; ?>%;"></div>
                </div>
                <p>HP: <?= $enemy->getCurrentHp(); ?></p>
            </div>
            
            <!-- JOUEUR -->
            <div class="actor player">
                <h3><?= $player->getName(); ?></h3>
                <?php $hpPercent = ($player->getCurrentHp() / $player->getMaxHp()) * 100; ?>
                <div class="hp-bar">
                    <div class="hp-fill" style="width: <?= $hpPercent; ?>%;"></div>
                </div>
                <p>HP: <?= $player->getCurrentHp(); ?></p>
            </div>
            
        </div>
            
        <form method="POST" class="actions">
            <?php if ($battleManager->isBattleRunning()): ?>
                <?php foreach($skills as $skill): ?>
                    <button name="action" value=<?= $skill->getName() ?>><?= $skill->getName() ?></button>
                <?php endforeach; ?>
            <?php else: ?>
                <button name="action" value="clearSession">Retour à l'accueil</button>
            <?php endif; ?>
        </form>
    </body>
</html>