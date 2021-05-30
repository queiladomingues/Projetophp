<?php

require_once("../conexao.php");
require_once("./funcoes.php");
$cordefundo="#FFDEAD";
iniciapagina($cordefundo,"Agenda","Excluir");
$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;
switch (TRUE)
{
  case ( $bloco==1 ):
  { 
    picklist("E",1);
    break;
  }
  case ( $bloco==2 ):
  { 
    printf("  <form action='./excluir.php' method='POST'>\n");
    printf("  <input type='hidden' name='bloco' value='3'>\n");
    printf("  <input type='hidden' name='pk' value='$_REQUEST[pk]'>\n");
   
    mostralinha($_REQUEST['pk'],"E",$bloco);
    printf("</form>");
    break;
  }
  case ( $bloco==3 ):
  { 
    printf("Tratando a transação.<br>");
    
    $cmdsql="DELETE FROM contatos WHERE contatos.pk='$_REQUEST[pk]'";
    $tentativa=TRUE;
    while ( $tentativa )
    { 
      mysqli_query($nulink,"START TRANSACTION");
      $execcmd=mysqli_query($nulink, $cmdsql);
      if ( mysqli_errno($nulink)==0 )
      { 
        mysqli_query($nulink,"COMMIT");
        $mensagem="Comando de Exclusão do contato $_REQUEST[pk], foi executado com sucesso!";
        $tentativa=FALSE;
      }
      else
      {
        if ( mysqli_errno($nulink)==1213 )
        { 
          $tentativa=TRUE;
        }
        else
        {
          $tentativa=FALSE;
          $mensagem=mysqli_errno($nulink)." - ".mysqli_error($nulink);
        }
        mysqli_query($nulink,"ROLLBACK");
      }
    }
    printf("$mensagem<br>\n");
    botoes("E",$bloco);
    break;
  }
}
terminapagina("excluir.php","Queila Domingues Pimentel","","");
?>

















