<?php

require_once("../conexao.php");
require_once("./funcoes.php");
$cordefundo="#FFDEAD";
iniciapagina($cordefundo,"Agenda","Alterar");
$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;
switch (TRUE)
{
  case ( $bloco==1 ):
  { 
    picklist("A",$bloco);
    break;
  }
  case ( $bloco==2 ):
  { 
    printf("  <form action='./alterar.php' method='POST'>\n");
    printf("  <input type='hidden' name='bloco' value='3'>\n");
    printf("  <input type='hidden' name='pk' value='$_REQUEST[pk]'>\n");
    $regalt=mysqli_fetch_array(mysqli_query($nulink,"SELECT * FROM contatos WHERE contatos.pk='$_REQUEST[pk]'"));
    printf("<table border=1 style='border-collapse: collapse;'>\n");
	printf("<tr><td>Nome:</td><td><input type='text' name='nome' value='$regalt[nome]' size='40' maxlength='200' placeholder='Nome usual completo sem abreviação'></td></tr>");
	
	printf("<tr><td>telefone:</td><td><input type='text' name='telefone' value='$regalt[telefone]' placeholder='descriç' size='48' maxlength='80'></td></tr>");
	printf("<tr><td>endereço:</td><td><input type='text' name='endereco' value='$regalt[endereco]' size='15' maxlength='15' placeholder='Quantidade ocupada'></td></tr>");
	
	 
	printf("<tr><td>&nbsp;</td><td>");botoes("A",$bloco);
	printf("</td></tr>\n");
    printf("</table>\n");
    printf("</form>\n");
    break;
	}
	
  case ( $bloco==3 ):
  { 
    printf("Tratando a transação.<br>");
   
    $cmdsql="UPDATE contatos SET nome    ='$_REQUEST[nome]',
                              
                                telefone       ='$_REQUEST[telefone]', 
                                endereco    ='$_REQUEST[endereco]'
                            WHERE contatos.pk='$_REQUEST[pk]'";
    $tentativa=TRUE;
    while ( $tentativa )
    { 
      mysqli_query($nulink,"START TRANSACTION");
      $execcmd=mysqli_query($nulink, $cmdsql);
      if ( mysqli_errno($nulink)==0 )
      { 
        mysqli_query($nulink,"COMMIT");
        $mensagem="Comando de Alteração do contato $_REQUEST[pk], foi executado com sucesso!";
        $tentativa=FALSE;
        mostralinha($_REQUEST['pk'],"A",$bloco);
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
    break;
  }
}
terminapagina("alterar.php","Queila Domingues Pimentel","","");
?>

















