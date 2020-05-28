<?php
if (isset($_POST['Nome'])) {
    $nome = $_POST['Nome'];
} else {
    $nome = 0;
}

if (isset($_POST['fem'])) {
    $fem = $_POST['fem'];
} else {
    $fem = 0;
}

if (isset($_POST['masc'])) {
    $masc = $_POST['masc'];
} else {
    $masc = 0;
}

if (isset($_POST['muay'])) {
    $muay = $_POST['muay'];
} else {
    $muay = 0;
}

if (isset($_POST['mma'])) {
    $mma = $_POST['mma'];
} else {
    $mma = 0;
}

if (isset($_POST['kick'])) {
    $kick = $_POST['kick'];
} else {
    $kick = 0;
}

if (isset($_POST['krav'])) {
    $krav = $_POST['krav'];
} else {
    $krav = 0;
}

if (isset($_POST['taek'])) {
    $taek = $_POST['taek'];
} else {
    $taek = 0;
}

if (isset($_POST['jiu'])) {
    $jiu = $_POST['jiu'];
} else {
    $jiu = 0;
}
?>
<html>

<head>
    <title> Confirmação de compra </title>
    <link rel="stylesheet" type="text/css" href="style-final.css" media="screen" />
    <meta charset="UTF-8">
</head>

<body>

    <!-- Topo da tela -->

    <header>
        <h3 class="text-left" style="color:black;
				font-family:algerian;
				font-size:82px;
				font-style:italic;
				position: relative;
				left: 835px;
				bottom: 98px;
				"> M & C Artes Marciais </h3>
        <img src="img/simbolo japones.png" style="width: 180px; position: relative; bottom: 480px; left: 585px;">
    </header>

    <!-- Tópicos de navegação canto esquerdo da tela -->

    <nav class="sidebar-left">
        <ul>
            <li> <a href="index.html"> INICIO </a> </li>
            <li> <a href="polos.html"> POLOS </a> </li>
            <li> <a href="sobre.html"> SOBRE NÓS </a> </li>
        </ul>
    </nav>

    <!-- Modalidades canto direito da tela -->

    <ul class="sidebar-right">
        <h4> CURSOS </h4>
        <?php
            $arquivo = file_get_contents('imagens.json');
            $json = json_decode($arquivo);
            
            foreach($json as $registro){
                echo $registro -> Titulo.'<br />';
                echo "<img src='". $registro->Imagem ."'>";
            }
        ?>
    </ul>

    <!-- Textos Centrais -->

    <div style="margin-left:15%;padding:1px 16px;height:928px;">
        <section class="text-one">
            <h2>Confirme os dados abaixo!</h2>
            <p>
                Você pagará sua primeira parcela apartir do
                seu primeiro dia de aula se todos os dados abaixo estiverem corretos.<br />
                Traga roupas adequadas para a ocasião.
            </p>
        </section>
        <section class="text-two">
            <h2>Dados da compra </h2>
            <p>
                Leia todos os dados da compra. Caso haja algum dado errado,
                entre em contato com nossa escola pelo telefone anexado no rodapé da página. </br></br>
                <b>Nome:</b>
                <?php
                    if ($nome == '') {
                        echo ('Você não digitou seu nome, pontanto sua Matrícula não foi concluída. Retorne a página anterior.');
                    }
                    echo $nome, ';' ?> </br></br>
                    <b>Modalidades de cursos comprados:</b> <?php
                        $modalidades = array("", "", "", "", "", "");
                        $qtde = 0;
                        if ($muay == 1) {
                            $modalidades[0] = 'Muay thai R$100,00 reais;';
                            $qtde = $qtde + 1;
                        }
                        if ($mma == 1) {
                            $modalidades[1] = ' MMA R$100,00 reais;';
                            $qtde = $qtde + 1;
                        }
                        if ($kick == 1) {
                            $modalidades[2] = ' Kick Boxing R$100,00 reais;';
                            $qtde = $qtde + 1;
                        }
                        if ($krav == 1) {
                            $modalidades[3] = ' Krav Maga R$100,00 reais;';
                            $qtde = $qtde + 1;
                        }
                        if ($taek == 1) {
                            $modalidades[4] = ' Taekwondo R$100,00 reais;';
                            $qtde = $qtde + 1;
                        }
                        if ($jiu == 1) {
                            $modalidades[5] = ' Jiu-Jitsu R$100,00 reais;';
                            $qtde = $qtde + 1;
                        }
                        if ($muay == 0 && $mma == 0 && $kick == 0 && $krav == 0 && $taek == 0 && $jiu == 0) {
                            echo ('Você não escolheu nenhuma modalide, se tem intenção de 
                            fazer alguma das lutas que temos,
                            volte a página anterior e selecione o curso desejado');
                            $mod = 0;
                        } else {
                            for ($i = 0; $i < 6; $i++) {
                                echo $modalidades[$i];
                            }
                            $ModalidadesString = $modalidades;
                            $mod = 1;
                        }
                        ?></br></br>
                        <b>Total de descontos: </b>R$ <?php
                        $subtotal = $qtde * 100;
                        if ($qtde <= 3) {
                            $desconto = 0.15;
                        } else {
                            $desconto = 0.17;
                        }
                        $Totaldesconto = $desconto * $subtotal;
                        echo number_format($Totaldesconto, 2, ",", ".");
                        ?></br></br>
                        <b>Valor total do orçamento: </b>R$ <?php
                        $TotalOrçamento = $subtotal - $Totaldesconto;
                        echo number_format($TotalOrçamento, 2, ",", ".");
                        ?></br></br>
                        <b>Validade do orçamento: </b> <?php
                        if ($nome == '' || $mod == 0) {
                            echo ("Sua matrícula não foi concluída, por favor, volte a página anterior.");
                        } else {
                            date_default_timezone_set('America/Sao_Paulo');
                            function somar_datas($numero, $tipo)
                            {
                                switch ($tipo) {
                                    case 'd':
                                        $tipo = ' day';
                                        break;
                                        case 'm':
                                            $tipo = ' month';
                                            break;
                                        case 'y':
                                            $tipo = ' year';
                                            break;
                                    }
                                    return "+" . $numero . $tipo;
                                }
                                $data = somar_datas(6, 'm'); // adiciona 3 meses a sua data
                                echo date('d/m/Y', strtotime($data));
                            }
                            ?></br></br>
                        <b>Data:</b> Jundiaí, <?php
                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                        date_default_timezone_set('America/Sao_Paulo');
                        echo strftime('%d de %B de %Y', strtotime('today'));
                        ?>
                        <br><br>                                       
                        <?php //Começo da gravação em TXT
                            $fp = fopen("confirmacao.txt","w"); // abre o arquivo
                            fwrite($fp,"Nome: ".$nome);
                            $modalidades = array("", "", "", "", "", "");
                            $qtde = 0;
                            if ($muay == 1) {
                                $modalidades[0] = 'Muay thai R$100,00 reais;';
                                $qtde = $qtde + 1;
                            }
                            if ($mma == 1) {
                                $modalidades[1] = ' MMA R$100,00 reais;';
                                $qtde = $qtde + 1;
                            }
                            if ($kick == 1) {
                                $modalidades[2] = ' Kick Boxing R$100,00 reais;';
                                $qtde = $qtde + 1;
                            }
                            if ($krav == 1) {
                                $modalidades[3] = ' Krav Maga R$100,00 reais;';
                                $qtde = $qtde + 1;
                            }
                            if ($taek == 1) {
                                $modalidades[4] = ' Taekwondo R$100,00 reais;';
                                $qtde = $qtde + 1;
                            }
                            if ($jiu == 1) {
                                $modalidades[5] = ' Jiu-Jitsu R$100,00 reais;';
                                $qtde = $qtde + 1;
                            }
                                for ($i = 0; $i < 6; $i++) {
                                    if ($modalidades[$i] == ""){

                                    }else{
                                        fwrite($fp,"\nModalidade: ".$modalidades[$i]);
                                    }
                                }
                            fwrite($fp,"\nTotal de desconto: R$ ". number_format($Totaldesconto,2,",",".")." Reais." );
                            fwrite($fp,"\nTotal do Orçamento: R$". number_format($TotalOrçamento,2,",",".")." Reais." );
                            fwrite($fp,"\nVálidade do Orçamento: ". date('d/m/Y', strtotime($data)));
                            fwrite($fp,"\nData atual: Jundiaí, ".strftime('%d de %B de %Y', strtotime('today')));
                            fclose($fp);
                        ?>
                        <?php // Começo da leitura XML
                            $link = "cursos.xml";
                            $xml = simplexml_load_file($link) -> categorias;

                            foreach($xml -> curso as $curso){
                                "<br />";
                                echo "<strong>Título:</strong> ".utf8_decode($curso -> Titulo)."<br />";
                                echo "<strong>Explicação:</strong> ".utf8_decode($curso -> Conteudo)."<br />";
                                echo "<br />"; 
                            }
                        ?>
            </p>
        </section>
    </div>


    <!-- Rodapé da página -->

    <footer>
    <div>
        <a href="index.html"> <img height="140px" width="140px" src="img/topo.png"> </a>
    </div>
        <h4> Conheça nossas redes sociais </h4>
        <ul> <a href="https://www.facebook.com/"> <img src="img/facebook.png"> </ul>

        <ul> <a href="https://instagram.com/"> <img src="img/instagram.png"> </ul>

        <ul> <a href="https://whatsapp.com/"> <img src="img/Whatsapp.png"> </ul>

        <ul> <a href="htpps://twitter.com/"> <img src="img/twitter.png"></ul>

        <p>Av. União dos Ferroviários, 1760 - Centro, Jundiaí - SP, 13201-160</p>
        <p>(11) 4522-7549</p>
    </footer>

</body>

</html>