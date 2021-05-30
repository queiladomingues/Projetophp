<?php


require_once("../conexao.php");
require_once("./funcoes.php");

$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;

$cordefundo=($bloco<3)?"#FFDEAD":"#FFFFFF";
($bloco<3)?iniciapagina($cordefundo,"Agenda","Listar"):iniciapagina($cordefundo,"","Listar");
switch (TRUE)
{
  case($bloco==1):
  { 
    printf(" <form action='./listar.php' method='post'>\n");
    printf("  <input type='hidden' name='bloco' value='2'>\n");

    printf("Listar contatos...:(<input type='radio' name='ordem' value='M.pk' checked>)<br>\n");
 
  
    botoes("L",$bloco);
    printf(" </form>\n");
    break;
  }
  case($bloco==2 or $bloco==3):
      { 
	   $cmdsql="SELECT *
		                    FROM contatos";
								       
	   
	   
	   
	   
        $execsql=mysqli_query($nulink,$cmdsql);
        printf("<table border=1 style='border-collapse: collapse;'>\n");
        printf("<tr bgcolor=lightblue><td>Cod.</td>\n");
        printf("    <td>Nome</td>\n");
		printf("    <td>Telefone</td>\n");
	    printf("    <td>Endereço</td>\n");
 	    

    
	   
        $corlinha="white";
        while ( $le=mysqli_fetch_array($execsql) )
        {
          printf("<tr bgcolor='$corlinha'><td>$le[pk]</td>\n");
          printf("    <td>$le[nome]</td>\n");
		  printf("    <td>$le[telefone]</td>\n");
		  printf("    <td>$le[endereco]</td></tr>\n");
      
         
    
		
          
		
		
          $corlinha=( $corlinha=='white')?"lightgreen":"white";
        }
        printf("</table>\n");
        if ( $bloco==2 )
        {
          printf("<table><tr><td valign=top><button onclick='history.go(-2)'>Início</button><button onclick='history.go(-1)'>Voltar</button></td><td>");
          printf("<form action='./listar.php' method='POST' target='_NEW'>\n");
          printf("  <input type='hidden' name='bloco' value='3'>\n");
          printf("  <input type='hidden' name='ordem' value='$_REQUEST[ordem]'>\n");
          botoes("L",$bloco);
          printf("</form></td></tr></table>\n");
        }
        else
        {
          printf("<hr>\n<button type='submit' onclick='window.print();'>Imprimir</button> - Corte a folha abaixo da linha no final da página<br>\n");
        }
        break;
      }
}

?>