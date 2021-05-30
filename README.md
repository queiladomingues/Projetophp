# Projetophp
Banco de dados utilizado: HeidiSQL 
Para abrir o banco tanto quanto o projeto funcionar é necessário o uso do xampp 2019 com o apache e o mySQL startados. 
Para abrir o projeto execute os passos abaixo;


1- Crie um banco de dados com o nome agendatelefonica 
2- Dentro do banco de dados agendatelefonica crie uma tabela com o nome contatos
3- Para adicionar as colunas manualmente:
   Adicione uma coluna na tabela contatos com o nome pk tipo int tamanho 11 e com alto_increment
   Adicione uma coluna na tabela contatos com o nome nome tipo varchar tamanho 90
   Adicione uma coluna na tabela contatos com o nome telefone tipo varchar tamanho 15
   Adicione uma coluna na tabela contatos com o nome endereco tipo varchar tamanho 90 
4- para adicionar as colunas com o create:
CREATE TABLE `contatos` (
	`pk` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(90) NOT NULL COLLATE 'utf8mb4_general_ci',
	`telefone` VARCHAR(15) NOT NULL COLLATE 'utf8mb4_general_ci',
	`endereco` VARCHAR(90) NOT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`pk`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=12
;

5-Para fazer a conexão do projeto com o banco de dados edite o arquivo conexao.php e na linha 43 onde tem a função: 
conectamy("localhost","root","","agendatelefonica");
Troque as credenciais de acordo com o banco de dados de vocês. 

6- Baixe o projeto agenda_telefônica com os arquivos conexao.php, estilo.css e funcao-botoes.php 
7- Vá no disco local \xampp\htdocs e dentro da pasta htdocs cole o projeto agenda_telefônica que você baixou com os arquivos conexao.php, estilo.css e funcao-botoes.php 
fora da pasta agenda_telefônica.

8- Para abrir o projeto no navegador digite http://localhost/agenda_telefônica/agenda_telefonica_abertura.php.

























