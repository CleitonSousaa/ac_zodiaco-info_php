<?php include("layout/header.php"); ?>

<div class="show-container d-flex flex-column align-items-center justify-content-center">   
    <?php
        if (isset($_POST['data_nascimento']) && !empty($_POST['data_nascimento'])) {
            $data_nascimento = $_POST['data_nascimento'];
            $signos = simplexml_load_file("signos.xml"); 
            
            try {
                $data_nascimento = DateTime::createFromFormat("Y-m-d", $data_nascimento);
                if (!$data_nascimento) {
                    throw new Exception("Formato de data inválido.");
                }
                $signo_encontrado = false;    
                foreach ($signos->signo as $signo) {
                    $data_inicio = DateTime::createFromFormat("d/m", (string)$signo->dataInicio);
                    $data_fim = DateTime::createFromFormat("d/m", (string)$signo->dataFim);   
                    $data_inicio->setDate($data_nascimento->format("Y"), $data_inicio->format("m"), $data_inicio->format("d"));
                    $data_fim->setDate($data_nascimento->format("Y"), $data_fim->format("m"), $data_fim->format("d"));

                    if ($data_fim < $data_inicio) {
                        $data_fim->modify("+1 year");
                    }
                    if ((string)$signo->signoNome === "Capricórnio" && $data_nascimento->format("m-d") <= "01-20") {
                        $data_inicio->modify("-1 year");
                    }
                    if ($data_nascimento >= $data_inicio && $data_nascimento <= $data_fim) {
                        echo "<h1 class='show-nome text-center w-100'>{$signo->signoNome}</h1>";
                        echo "<p class='show_descricao'>{$signo->descricao}</p>";
                        $signo_encontrado = true;
                        break;
                    }
                }    
                if (!$signo_encontrado) {
                    echo "<p>Não foi possível determinar seu signo. Verifique a data informada.</p>";
                }
            } catch (Exception $e) {
                echo "<p>{$e->getMessage()}</p>";
            }
        } else {
            echo "<p>Por favor, insira uma data de nascimento.</p>";
        }
    ?>
    <a href="index.php" class="btn btn-secondary mt-3 show-btn text-white">VOLTAR</a>
</div>

<?php include("layout/footer.php"); ?>
