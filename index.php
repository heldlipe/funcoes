<?php
    $dados = require "dados_livros.php";
   /* echo"<pre>";
    var_dump($dados);
    die; */


    $ordenacao = function($elemento1, $elemento2)
    {
        return $elemento1['titulo'] <=> $elemento2['titulo'];
    };
    /* $ordenacao2 = function ($elemento1, $elemento2)
    {
        return $elemento2['preco'] <=> $elemento1['preco'];
    }; */
    usort($dados, $ordenacao);
    // usort($dados, $ordenacao2);

    $pesquisa = $_GET['pesquisa'] ?? null;
    if($pesquisa){
        $funcaopesquisa = function($livro) use ($pesquisa){
            $titulo = mb_strtolower($livro['titulo']);
            $pesquisa = mb_strtolower($pesquisa);
            $pos = mb_strpos($titulo, $pesquisa);
            return $pos !== False;
        };
        $dados = array_filter($dados, $funcaopesquisa);
    }
    $categoria = $_GET['categoria'] ?? null;
    if($categoria){
        $filtracategoria = function($livro) use ($categoria){
            return $livro['categoria'] == $categoria;
        };
        $dados = array_filter($dados, $filtracategoria);
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros & Cia</title>
    <link href="livros.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1><a href="livros.php">Livros & Cia</a></h1>
       
            <form action="index.php" method="get" class="pesquisa">
                <input type="search" name="pesquisa" placeholder="Pesquise aqui o livro desejado">
                <button><svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" fill="white"></path> </svg></button>
            </form>
       
    </header>
    <main>
    <aside>
        <h2>Categorias</h2>
        <ul>
            <li><a href="index.php?categoria=Clássico">Clássico</a></li>
            <li><a href="index.php?categoria=Ficção">Ficção</a></li>
            <li><a href="index.php?categoria=Fantasia">Fantasia</a></li>
            <li><a href="index.php?categoria=Realismo">Realismo</a></li>
            <li><a href="index.php?categoria=Romance">Romance</a></li>
            <li><a href="index.php?categoria=Infantil">Infantil</a></li>
            <li><a href="index.php?categoria=Biografia">Biografia</a></li>
            <li><a href="index.php?categoria=Suspense">Suspense</a></li>
            <li><a href="index.php?categoria=Aventura">Aventura</a></li>
        </ul>
    </aside>
   <section class="livros">
     <h2>Todos os Livros</h2>
     <section class="cards-livros">

        <?php
     foreach ($dados as $livro) {
        ?>

         <!-- INICIO DO CARD LIVRO --->
        <div class="card-livro">
            <div class="livro-imagem">
                <img src="<?=$livro['imagem']?>">
            </div>
            
            <div class="livro-texto">
                <h3><?=$livro['titulo'] ?> </h3>
                <p><?=$livro['autor'] ?> </p>
                <p class="preco">R$<?=number_format($livro['preco'], 2, ",") ?></p>
            </div>
        </div>
         <!-- FIM DO CARD LIVRO --->
         <?php 
            }
        ?>
     </section>   
    </main>
    
</body>
</html>