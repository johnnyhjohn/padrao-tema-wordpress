# README #

Este é um template de desenvolvimento padrão, onde teremos funções, styles, e padrões de semânticas usados nos desenvolvimentos de sites utilizando wordpress.

### Para que este padrão? ###

* Automatizar trabalho
* Agilidade no desenvolvimento
* Padrões

### Como utilizar? ###

* Clonar este repositórios
* Criar banco de dados
* Alterar as configurações do wp-config.php
* Alterar arquivo package.json caso tenha alguma mudança
* Rodar npm install && bower install para instalar as dependencias
* Rodar GULP para compilação do SASS e JS
* Seguir para o desenvolvimento

### Quais funções padrões existem e onde? ###
--------------------------------------------------------------------------------

#### $.fn.contato() ####
** Arquivo ** : funcoes.js.

** Parametros ** : Não possui.

** Descrição ** : Evento para disparo de email em ajax, para utilização do mesmo basta incluir como plugin no objeto jquery.

** Exemplo ** : `$('#meu-elemento').contato();`

--------------------------------------------------------------------------------

#### $.fn.menuMobile( opcao ) ####
** Arquivo ** : funcoes.js.

** Parametros ** : {String} | Insira o nome do ID dos menus 'target' podendo eles serem 'menu-lateral' ou 'menu-gaveta'.

** Descrição ** : Evento para quando clicar em um botão ele abrir um menu lateral ou estilo gaveta na versão mobile.

** Exemplo ** : 
```
$('#meu-botao').contato('menu-lateral');
$('#meu-botao').contato('menu-gaveta');
```
--------------------------------------------------------------------------------

#### initMapa( pontos, local ) ####
** Arquivo ** : funcoes.js.

** Parametros ** : 
	*{Object} pontos| Objeto com todos os pontos que irão aparecer no mapa, contendo lat, lng e titulo.

 	* {Array} local| Array com o ponto que ira centralizar o mapa.

** Descrição ** : Função para montar mapa com multiplos pontos cadastrados no administrativo, para usa-lo precisa que crie uma variavel js na head do site para colocar de parametro da função quando for chama-la.
Criar uma tag com id #map para o google instanciar o mapa nela.

** Exemplo ** : 
```
---header.php
let pontos = "<?php echo getPontos() ?>";
---script.js
let local = [];
local['lat'] = -24,3244324;
local['lng'] = 50,32443242;
try{
	initMapa(pontos, local);
}catch(e){
	console.log('Pontos não esta definido');
}
```
