<?php

require_once("../conexao.php");
require_once("./funcoes.php");

$cordefundo="#FFDEAD";
iniciapagina($cordefundo,"Agenda","incluir");

$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;
switch (TRUE)
{
  case($bloco==1):
  { 
    printf("<form action='incluir.php' method='POST'>\n");
    printf("<input type='hidden' name='bloco' value=2>\n");
    printf("<table border=1 style='border-collapse: collapse;'>\n");
  printf(" <tr><td>Codigo:</td><td><input type='text' name='pk' size='5' maxlength='3' ></td></tr>");
    printf("<tr><td>Nome:</td><td><input type='text' name='nome' size='40' maxlength='90' ></td></tr>");
    printf("<tr><td>telefone:</td><td><input type='text' name='telefone' size='15' maxlength='15' ></td></tr>");
    printf("<tr><td>Endereço:</td><td><input type='text' name='endereco' size='48' maxlength='90'></td></tr>");
    
	  printf("<tr><td>&nbsp;</td><td>");
    botoes("I",$bloco);
    printf("</td></tr>\n");
    printf("</table>\n");
    printf("</form>\n");
    break;
  }
  case ( $bloco==2 ):
  {
    $cmdsql="SELECT * FROM contatos WHERE pk='$_REQUEST[pk]'";
    $execcmd=mysqli_query($nulink,$cmdsql);
    $qtdlinhas=mysqli_num_rows($execcmd);
    if ( $qtdlinhas==1 )
    {
      printf("Já existe contato com este código<br>");
      printf("<button type='button' onclick='history.go(-1)'>Voltar ao formulário</button>");
    }
    else
    {
      
      printf("Aqui trata-se a transação");
      $tentativa=TRUE;
      while ( $tentativa )
      { 
        mysqli_query($nulink,"START TRANSACTION");
        $cmdsql="INSERT INTO contatos (nome,telefone,endereco)
                      VALUES ('$_REQUEST[nome]','$_REQUEST[telefone]',
					  '$_REQUEST[endereco]')";
        $execcmd=mysqli_query($nulink, $cmdsql);
        if ( mysqli_errno($nulink)==0 )
        { 
          mysqli_query($nulink,"COMMIT");
          $mensagem="Comando de Inclusão do contato $_REQUEST[pk], foi executado com sucesso!";
          $tentativa=FALSE;
          mostralinha($_REQUEST['pk'],"I",$bloco);
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
    }
    
    printf("$mensagem<br>\n");
    break;
  }
}
terminapagina("incluir.php","Queila Domingues Pimentel","","");
?>