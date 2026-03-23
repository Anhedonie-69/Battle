<?php

session_start();

include "config/db.php";
include "config/autoloader.php";

$db = new DB();
$playerRepository = new PlayerRepository($db->getDataBase());
$battleManager = new BattleManager($playerRepository);

$battleManager->runBattle();

?>