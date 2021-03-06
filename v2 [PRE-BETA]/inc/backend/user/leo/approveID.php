<?php
session_name('hydrid');
session_start();
require '../../../connect.php';

require '../../../config.php';

require '../../../backend/user/auth/userIsLoggedIn.php';

// Makes sure the person actually has a character set

if (!isset($_SESSION['on_duty'])) {
	header('Location: ../../../../' . $url['leo'] . '?v=nosession');
	exit();
}

// Supervisor Check
if ($_SESSION['identity_supervisor'] !== "Yes") {
  header('Location: ../../../../' . $url['leo'] . '?v=nosession');
	exit();
}

// Page PHP

$id = strip_tags($_GET['id']);
$stmt              = $pdo->prepare("UPDATE `identities` SET `status`='Active' WHERE `identity_id`=:id");
$stmt->bindValue(':id', $id);
$result = $stmt->execute();