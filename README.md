# CRUD-MVC-PHP

Crud em MVC e PHP

### Objetivo:

> Este desafio tem por objetivo avaliar a capacidade de compreensão, analise e práticas de desenvolvimento do candidato.

### Regras:

> As regras abaixo devem ser seguidas ao cadastrar/editar uma pessoa:

    - Não devem haver e-mail repetido

    - Executar a query script.sql ou importar o arquivo no phpMyAdmin para criar a table necessária.

- Editar o arquivo **banco.php**

  - $dbNome = 'nomeDaTable'
  - $dbHost = 'nomeDoDominioOuIP:Porta'
  - $dbUsuario = 'usuarioDoMysql'
  - $dbSenha 'senhaDoUsuario'

### Detalhes sobre o programa:

1.  init.php são os arquivos de configurações do sistema
2.  diretório "view" é onde fica todas as telas do sistema
3.  diretório "controller" é onde fica fica as funcionalidades do sistema que interragem com o banco de dados
4.  diretório "model" é onde fica os arquivos de conexão com o banco de dados

No diretório "view" existem 3 páginas principais: editar.php, cadastro.php e index.php. a página head e menu são os escopos do HTML e Menu do sistemas respectivamente.

No diretório "controller" estão os arquivos PHP que executam as funcionalidades do sistema.

No diretório "model" estão os arquivos de conexão com o Banco de Dados

O arquivo script.sql é o scrip em sql que cria o banco e a tabela.

# Login no sistema

    - E-mail: nivelamento@webdecsistemas.com
    - Senha: desafio_crud_nivelamento_2022

    - url: http://localhost/nivelamento/view/login.php

# Imagens utilziadas no sistema / Telas construidas

<img src="https://github.com/MarcosDanielVieira/nivelamento/blob/main/img/webdec-home.png">

<img src="https://github.com/MarcosDanielVieira/nivelamento/blob/main/img/login.png">

<img src="https://github.com/MarcosDanielVieira/nivelamento/blob/main/img/listagem.png">

<img src="https://github.com/MarcosDanielVieira/nivelamento/blob/main/img/cadastro.png">

<img src="https://github.com/MarcosDanielVieira/nivelamento/blob/main/img/editar.png">
