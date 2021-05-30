<?php

function conectamy($host, $user, $passwd, $dbase)
{ 
  global $nulink;
  $nulink=mysqli_connect($host,$user,$passwd,$dbase);
  
  mysqli_query($nulink,"SET NAMES 'utf8'");
  mysqli_query($nulink,'SET character_set_connection=utf8');
  mysqli_query($nulink,'SET character_set_client=utf8');
  mysqli_query($nulink,'SET character_set_results=utf8');
}
function iniciapagina($cordefundo,$tabela,$titulo)
{ 
  printf("<html>\n");
  printf(" <head>\n");
  printf("  <meta charset='UTF-8'>\n");
  printf("  <link rel='stylesheet' type='text/css' href='../estilo.css'>\n");
  printf(" </head>\n");
  printf(" <body bgcolor='$cordefundo'>\n");
  ($tabela!="")?montamenu($tabela):"";
  printf("$tabela <red>$titulo</red><br>\n");
}
function botoes($acao,$bloco)
{ 
 $op=$acao.$bloco;

  $inicio=($op!="L2" and $op!="L3")?"<button type='button' onclick='history.go(-".$bloco.")'>Início</button>":"";
  $limpar=($op=="C1" or $op=="I1" or $op=="A1") ? "<button type='reset'>Limpar</button>" : "";
  $voltar=($op=="C2" or $op=="E2" or $op=="A2") ? "<button type='button' onclick='history.go(-1)'>Voltar</button>" : "";
  $operar=($op=="C1")?"Consultar":(($op=="E1")?"Excluir":(($op=="E2")?"Confirmar Exclusão":(($op=="A1")?"Alterar":(($op=="A2")?"Confirmar Alteração":(($op=="I1")?"Incluir":(($op=="L1")?"GerarRelatório":(($op=="L2")?"Gerar P/Impressão":(($op=="L3")?"Imprimir":""))))))));
  $operacao=($operar!="")?("<button type='submit'>".$operar."</button>"):"";
  $botao=$operacao.$limpar.$voltar.$inicio;
  printf("$botao");
}
function terminapagina($PRG,$nome,$ra,$turno)
{ 
  printf("  <hr width=75%%>\n");
  printf("<center><lgrey>$PRG - Sistema desenvolvido por: $nome | $ra |$turno</lgrey></center>\n");
  printf(" </body>\n");
  printf("</html>\n");
}
conectamy("localhost","root","","agendatelefonica");
function montamenu($Tabela)
{ 
  printf("<divmenu><table><tr><td valign=top><red>$Tabela</red>:</td><td><form>");
  printf("<button type='submit' formaction='./incluir.php'>Incluir</button>");
  printf("<button type='submit' formaction='./consultar.php'>Consultar</button>");
  printf("<button type='submit' formaction='./alterar.php'>Alterar</button>");
  printf("<button type='submit' formaction='./excluir.php'>Excluir</button>");
  printf("<button type='submit' formaction='./listar.php'>Listar</button>");
  printf("</form></td></tr></table></divmenu><br><br>\n");
}
?>
