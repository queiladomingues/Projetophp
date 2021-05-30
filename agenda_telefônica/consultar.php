<?php

require_once("../conexao.php");
require_once("./funcoes.php");

$cordefundo="#FFDEAD";
iniciapagina($cordefundo,"Agenda","Consultar");

$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;
switch (TRUE)
{
  case($bloco==1):
  { 
    picklist("C",1);
    break;
  }
  case($bloco==2):
  { 
    mostralinha($_REQUEST['pk'],'C',$bloco);
    break;
  }
}
terminapagina("consultar.php","Queila Domingues Pimentel","","");
?>
