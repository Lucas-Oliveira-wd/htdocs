<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar ou Atualizar dados</title>
    <link type="text/css" rel="stylesheet" href="css/geral.css"/>
</head>
<body>
    
<?php
$servername = "localhost";
$username = "root";
$password = "No";

// Create connection
$conn = new mysqli($servername, $username, FALSE);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<script>/*alert(Conexão com o banco de dados foi bem sucedida!)*/</script>";
?>

<section id = "secForm">
<div class="container">
    <h1 class = "stTitle">Upload de dados</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
        <div class="formItem">
        <?php
        /* Reoder options in alphabetical */
        //criando o array com as opcoes
        $opt = array("Serviços Financeiros Diversos","Diversos","Bancos","Construção Civil","Energia Elétrica","Petróleo, Gás e Biocombustíveis","Tecidos, Vestuário e Calçados","Máquinas e Equipamentos","Químicos","Siderurgia e Metalurgia","Exploração de Imóveis","Madeira e Papel","Outros","Construção e Engenharia");
        //criando um array ordenado
        sort($opt);
        ?>
            <label for="setor">Setor</label><br>
            <select id="setor">
                <option name = ""><?php echo $opt[0]?></option>
                <option name = ""><?php echo $opt[1]?></option>
                <option name = ""><?php echo $opt[2]?></option>
                <option name = ""><?php echo $opt[3]?></option>
                <option name = ""><?php echo $opt[4]?></option>
                <option name = ""><?php echo $opt[5]?></option>
                <option name = ""><?php echo $opt[6]?></option>
                <option name = ""><?php echo $opt[7]?></option>
                <option name = ""><?php echo $opt[8]?></option>
                <option name = ""><?php echo $opt[9]?></option>
                <option name = ""><?php echo $opt[10]?></option>
                <option name = ""><?php echo $opt[11]?></option>
                <option name = ""><?php echo $opt[12]?></option>
                <option name = ""><?php echo $opt[13]?></option>
            </select>
        </div>
        <div class="formItem">
            <label for="cod">Código da Acão</label><br>
            <select id="cod">
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
                <option name=""><?php ?></option>
            </select>
        </div>

        <div class="formItem">
            <label for="empName">Nome da Empresa</label><br>
            <input name="empName" id="empName" type="text">
        </div>
        <div class="formItem">
            <label for="ultBal">Data do Último Balanco Processado</label><br>
            <input name="ultBal" id="ultBal" type="date">
        </div>
        <div class="formItem">
            <label for="cot">Cotacão Atual</label><br>
            <input name="cot" id="cot" type="text">
        </div>
        <div class="formItem">
            <label for="roic">Roic</label><br>
            <input name='roic' id='roic' type="text">
        </div>
        <div class="formItem">
            <label for="cresres">Crescimento da Receita (5 anos)</label><br>
            <input name='cresres' id='cresres' type="text">
        </div>
        <div class="formItem">
            <label for="dYield">Dividend Yield</label><br>
            <input name='dYield' id='dYield' type="text">
        </div>
        <div class="formItem">
            <label for="nAcoes">Número de Acões</label><br>
            <input name="nAcoes" id="nAcoes" type="text">
        </div>
        <div class="formItem">
            <label for="divB">Dívida Bruta</label><br>
            <input name="divB" id="divB" type="text">
        </div>
        <div class="formItem">
            <label for="disp">Disponibilidades</label><br>
            <input name="disp" id="disp" type="text">
        </div>
        <div class="formItem">
            <label for="ativC">Ativos Circulantes</label><br>
            <input name="ativC" id="ativC" type="text">
        </div>
        <div class="formItem">
            <label for="ativ">Ativos</label><br>
            <input name="ativ" id="ativ" type="text">
        </div>
        <div class="formItem">
            <label for="patLiq">Patrimonio Líquido</label><br>
            <input name="patLiq" id="patLiq" type="text">
        </div>
        <div class="formItem">
            <label for="recL12">Receita Líquida (12 meses)</label><br>
            <input name="recL12" id="recL12" type="text">
        </div>
        <div class="formItem">
            <label for="ebit12">Ebit (12 meses)</label><br>
            <input name="ebit12" id="ebit12" type="text">
        </div>
        <div class="formItem">
            <label for="lucLiq12">Lucro Líquido (12 meses)</label><br>
            <input name="lucLiq12" id="lucLiq12" type="text">
        </div>
        <div class="formItem">
            <label for="recL3">Receita Líquida (3 meses)</label><br>
            <input name="recL3" id="recL3" type="text">
        </div>
        <input type='submit' value="Enviar">
    </form>
</div>
</section>

</body>
</html>