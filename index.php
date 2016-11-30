<?php
	require('./Config/Autoloader.php');
	$autoloader = Autoloader::getInstance();
	$autoloader->autoload(array('Controleur', 'FunctionHTML','FrontCtrl', 'ModeleUser', 'ModeleMembre', 'ModeleAdmin', 'CtrlUser', 'CtrlMembre', 'CtrlAdmin', 'ClassBD', 'DAL', 'Validation', 'Nettoyage',
								 'Commentaire','Article'));
	DebutFichierHTML();
	$FrontCtrl = new FrontCtrl();
	FinFichierHTML();
?>
