<link rel="apple-touch-icon" sizes="57x57" href="imagens/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="imagens/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="imagens/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="imagens/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="imagens/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="imagens/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="imagens/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="imagens/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="imagens/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="imagens/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="imagens/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="imagens/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png">
<link rel="manifest" href="imagens/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="imagens/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<?php

header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too

//include('verifica_login.php');

$login = '';
$senha = '';
$retorno = '';
$id_combo_departamento = '0';
$exibe_imagem = '1';
$id_loja = '0';
$filial_select = '0';
$datainicio = date("Y-m-d");
$datafim = date("Y-m-d");
$dataatual = date("Y-m-d");
$filial = 0;
include_once("conectar.php");

if (isset( $_POST['combo_loja']))
{
  $filial= $_POST['combo_loja'];
 
}
if (isset( $_POST['datainicio']))
{
  $datainicio= $_POST['datainicio'];
 
}
if (isset( $_POST['datafim']))
{
  $datafim= $_POST['datafim'];
 
}




// captura parametros originais para retornar a pagina anterior com filtros corretos
if (isset( $_POST['datainicio_parametro_original']))
{
  $datainicio= $_POST['datainicio_parametro_original'];
 
}

if (isset( $_POST['datafim_parametro_original']))
{
  $datafim= $_POST['datafim_parametro_original'];
 
}

if (isset( $_POST['filial_parametro_original']))
{
  $filial= $_POST['filial_parametro_original'];
 
}

//fim da captura



?>





<title>Vendas Por Dia</title>
<meta charset="utf-8">


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
      
<style>
/* Style the header */
header {
  background-color: #666;
  background-color:  rgb(31, 91, 55);
  background-color:  rgb(255, 255, 255);
 
  overflow:auto;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: white;
}
.pesquisa {
 overflow:auto;
 width:100%
}

.botao {
    background: url('./imagens/botao.png');
      height:45px;
    width:130px;
    border:0;
    outline:0;
    -moz-outline:0;
    cursor:pointer;
}
.botao:hover {
  background: url('./imagens/botao2.png');
}
.botao:active {
  background: url('./imagens/botao3.png');
}

div.a {
	text-align: center;

}

/* Chrome, Safari, Edge, Opera  esconde os arrow do tipo numero*/
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance:textfield;
}


table {
font-family: arial, sans-serif;
font-size: 30px;

border-collapse: collapse;
border=1;
/* width: 80% !important; Importante manter o !important rs
min-width: 1000px; */
  margin: auto;

}

td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 4px;
color:black 
}
tr:nth-child(odd) {
 background-color:#f5fcf5;

}

tr:nth-child(even) {
background-color: #fcfbe6;
/*#a9ffa8; #fff9a8*/
/*#e6fcec; #fcfbe6*/

}
/* .table-responsive{
width: 100% !important;

}
*/
</style>





















<?php




$sql = "select codigo,replace  (replace  (nome,'RESTAURANTE ',''), ' LTDA','') as nome from filial

order by codigo asc";
$resultadocomboloja = pg_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados");


// termina combobox tipocomida







$valor = '';

 if (isset( $_POST['pesquisaingrediente'])) {
  $valor = $_POST['pesquisaingrediente'];
}else{
  //$valor = '2';
}

$filial_select = '';
$combofornecedor = '';




if (isset( $_POST['id_loja3'])) {

  $filial_select = $_POST['id_loja3'];
  $id_loja = $_POST['id_loja3'];
}

//echo  $_POST['id_loja3'];
               


if (isset( $_POST['combo_loja'])) {

  $filial_select = $_POST['combo_loja'];
  $id_loja = $_POST['combo_loja'];
}

 
if (isset( $_POST['combo_departamento'])) {


  $id_combo_departamento = $_POST['combo_departamento'];
}else {
  $id_combo_departamento = '0';
}
 

  if ($filial_select == '')
  {
    
    $filial_select = 0;
   
  
  }

  
  


$datainicial =  date('Y-m-d'); 
$datafinal =  date('Y-m-d'); 

if (isset( $_POST['datainicial'])) {
  $datainicial = $_POST['datainicial'];
}
if (isset( $_POST['datafinal'])) {
  $datafinal =$_POST['datafinal'];
} 



// inicio menu de opçoes
?>
		<header class="fusion-header-wrapper fusion-header-shadow">
        <div class="fusion-header-v5 fusion-logo-alignment fusion-logo-center fusion-sticky-menu- fusion-sticky-logo- fusion-mobile-logo-1 fusion-sticky-menu-only 
        fusion-header-menu-align-center fusion-mobile-menu-design-modern"  style="float:middle;">


<img src="imagens/LOGO-HORIZONTAL-m.png" alt="Smiley face" style="float:middle;width:636px;height:150px;">




<title>Restaurante Dona Conceição – Comida Mineira</title>


<link rel="stylesheet" id="fusion-dynamic-css-css" href="arquivos_css/modelo_menu.css" type="text/css" media="all">

<link rel="stylesheet" id="fusion-dynamic-css-css" href="arquivos_css/102cbd620d3bb3432d4a89b52af0ee36.css" type="text/css" media="all">



			
       


</header>





</div>

</div>



  <div class="column" style="background-color:#1f5a37; background-image: url('imagens/sub-boxed-bg.png'); min-height:800px;" >
  <button id = "Editarl" onclick="fechasessao()" style="float:center;height:35px;width:auto;color:white;background-color:#c39030;" value="ignore"   class = "wpcf7-form-control wpcf7-submit button-xlarge" >Sair</button>
  


 
  <form method="POST" id="itens_vendidos" name="itens_vendidos" action="itens_vendidos.php" enctype=multipart/form-data>

<input type="hidden" name="id_filial_vendaitens" id="id_filial_vendaitens" value="<?php echo $filial; ?>" />

<input type="hidden" name="data_inicial_vendaitens" id="data_inicial_vendaitens" value="<?php echo $datainicio; ?>" />

<input type="hidden" name="data_final_vendaitens" id="data_final_vendaitens" value="<?php echo  $datafim; ?>" />

<input type="hidden" name="filial_parametro_original" id="filial_parametro_original" value="<?php echo $filial; ?>" />

<input type="hidden" name="datainicio_parametro_original" id="datainicio_parametro_original" value="<?php echo $datainicio; ?>" />

<input type="hidden" name="datafim_parametro_original" id="datafim_parametro_original" value="<?php echo  $datafim; ?>" />




</form>
  
  
  <div class="a">

    
  <form method="POST"  name="principal" id="principal"  action="venda_diaria.php" enctype=multipart/form-data>

  <input type="hidden" name="id_usuario1" id="id_usuario1" value="<?php echo $grupo_produto; ?>" />

<input type="hidden" name="nome_usuario1" id="nome_usuario1" value="<?php echo $nomeusuario; ?>" />




  <label style="color:white;font-size: 75px;padding-left: 30px;">Venda Diaria</label >
  <input type="hidden" name="exibe_imagem" id="exibe_imagem" value="<?php echo $exibe_imagem; ?>" />
 
   
 
<br>


 
 

<?php



 if (pg_num_rows($resultadocomboloja)!=0){
  echo '<label style="color:white;font-size: 45px;" for="radio_ativos">Loja:</label>  ';
  echo '<select  style="height:55px; font-size: 45px;" name="combo_loja" id="id_combo_loja" onchange="this.form.submit()">';
 
  echo '<option value="0">Todas</option>';
  while($elemento = pg_fetch_array($resultadocomboloja))
  {

    $nomeItem = $elemento['nome'];
    $iditem = $elemento['codigo'];
    if ($elemento['nome'] == '.Todos') 
    {
      $nomeItem = 'Todos';
    }
      echo '<option value="'.$iditem.'">'.$nomeItem.'</option>';


  }

 
  echo '</select>';
 }

 echo '<br>';
 echo '<label style="color:white;font-size: 45px;padding-left: 20px;" for="radio_ativos">Inicio:</label>  ';
 echo '<td><input  id = "datainicio"  name = "datainicio" type="date"  style="width:320px;height:55px; font-size: 45px;" required value= '.$datainicio.' </td>';

 echo '<label style="color:white;font-size: 45px;padding-left: 20px;" for="radio_ativos">Fim:</label>  ';
 echo '<td><input  id = "datafim"  name = "datafim" type="date"  style="width:320px;height:55px; font-size: 45px;" required value= '.$datafim.' </td>';
 echo '<button id = "Editarl" onclick="this.form.submit()" style="float:center;height:55px;width:auto;color:white;background-color:#c39030;" value="ignore"   class = "wpcf7-form-control wpcf7-submit button-xlarge" >Ir</button>';
 



 ?>
<label style="color:white;font-size: 45px;padding-left: 20px;" for="radio_ativos"></label>  


    <?php// echo $exibe_imagem; ?>

 <script type="text/javascript" >




document.getElementById('id_combo_loja').value = '<?php echo $filial; ?>';


if (document.getElementById('id_combo_loja').value == '')
{
  document.getElementById('id_combo_loja').value = 0;

  this.form.submit();

}




</script>



</form> 


<form method="POST" id="form_sair" name="form_sair" action="index.php" enctype=multipart/form-data>

</form> 


<script type="text/javascript" >
function fechasessao() {
<?php
$_SESSION = array();
?>


document.forms["form_sair"].submit();
//location.reload(); 
}



  // seleciona o index no combo tipo ingrediente igual o da variavel tipo


var linhaselecionada= -1;



function interage_tiket2( idloja, data_venda_inicial, data_venda_final,datainicio_parametro_original,datafim_parametro_original,filial_parametro_original) {



    document.getElementById('id_filial_vendaitens').value =  idloja;
    document.getElementById('data_inicial_vendaitens').value = data_venda_inicial;
    document.getElementById('data_final_vendaitens').value = data_venda_final;
    document.getElementById('datainicio_parametro_original').value = datainicio_parametro_original;
    document.getElementById('datafim_parametro_original').value = datafim_parametro_original;
    document.getElementById('filial_parametro_original').value = filial_parametro_original;
    document.forms["itens_vendidos"].submit();
   

}

</script>


  </div>
  <p><br>







 <tr>
 <table id="table_convercao"> 


 </tr>
 <?php
 if ($filial_select == '0') {

 }
 ?>

  </div>
</div>
<form method="POST" id="inicia_ticket" name="inicia_ticket" action="arquivos_php/processa_inicio_trabalho.php" enctype=multipart/form-data>

<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $grupo_produto; ?>" />

<input type="hidden" name="nome_usuario" id="nome_usuario" value="<?php echo $nomeusuario; ?>" />

<input type="hidden" name="id_ticket" id="id_ticket" value="<?php echo  $data_venda; ?>" />

<input type="hidden" name="id_loja3" id="id_loja3" value="<?php echo $id_loja; ?>" />

<input type="hidden" name="iniciar_finalizar" id="iniciar_finalizar" value="<?php echo $iniciar_finalizar; ?>" />


</form>

</div>



<?php





// puxa dados grid

$sql = "
select filial,replace  (replace  (filial.nome,'RESTAURANTE ',''), ' LTDA','') as nome_filial ,

TO_CHAR(data:: DATE, 'dd/mm/yyyy') as data_exibe,
data,

replace (cast(sum(valorliquido)as money)::text , 'R$', '') as valor_venda,

replace (cast(sum ( case when cast(horafinal as time) < '17:00:00.000'::time then valorliquido else '0' end) as money)::text , 'R$', '')  as antes16,



replace (cast( sum ( case when cast(horafinal as time) >= '17:00:00.000'::time then valorliquido else '0' end) as money)::text , 'R$', '') as depois16,
sum (sum(valorliquido))OVER (PARTITION BY operacao.filial )   as total
 from operacao 

 left join filial on filial.id = operacao.filial::int
where cancelado = 0 and tipo =1 
 and operacao.data between '$datainicio ' and '$datafim' and (operacao.filial::int = $filial::int    or   $filial = 0)

group by filial,data,filial.nome
order by total desc,filial asc,data asc
        
";
 $resultado = pg_query($conexao,$sql) or die("Erro ao retornar dados \n $sql");


//echo $sql ;

 



$filial_atual = 0;
  $quantidate_tickets_tela = 0;
  $primeirorow = 1;
 // Obtendo os dados por meio de um loop while
 while ($registro = pg_fetch_array($resultado))
 {     
  
  
  $data_exibe= $registro['data_exibe'];   
    $data_venda= $registro['data'];
     $nome_filial_select = $registro['nome_filial'];
    $filial_select = $registro['filial'];
    
    $antes16 = $registro['antes16'];
    $depois16 = $registro['depois16'];
     $valor_venda_produto = $registro['valor_venda'];


  


    $idticket_parametro =  "'". $data_venda."'";
    $filial_select_parametro =  "'".$filial_select."'";

    if ($filial_atual !=  $filial_select    )
    {


if ($primeirorow ==0){
     
  
// soma o total de vendas e joga no final da table
$sql = "

select filial,replace  (replace  (filial.nome,'RESTAURANTE ',''), ' LTDA','') as nome_filial ,


replace (cast(sum(valorliquido)as money)::text , 'R$', '') as valor_venda
 from operacao 

 left join filial on filial.id = operacao.filial::int
where cancelado = 0 and tipo =1 

 and operacao.data between '$datainicio ' and '$datafim' and operacao.filial::int = $filial_atual::int    
group by filial,filial.nome
order by filial";
$resultadototal = pg_query($conexao,$sql) or die("Erro ao retornar dados \n $sql");     
while ($registro = pg_fetch_array($resultadototal))
{     

  $valortotal= $registro['valor_venda'];   
  
  
}

echo "<td  style='text-align: center; max-width:130px; font-size: 35px;min-width:130px'>Total</td>";
echo "<td  style='text-align: right; max-width:150px; font-size: 35px;min-width:150px'>".$valortotal."</td>";



// final do somatorio das vendas
    }

   

      echo "</table>";
      echo "<table id= ticket$data_venda>";
      
      echo "<tr><td  style='text-align: right; ' '>".$nome_filial_select."</td>";
      if ( $primeirorow == 1){
      echo ' <td background="imagens/coroa5.png" style="width:50px;height:50px;">  </td>';
      }
      $primeirorow = 0;
   echo "<br>";
   $filial_atual =  $filial_select;
   echo "</table>";
   echo "<table id= ticket$data_venda>";

   echo '<tr> ';
   echo '<table id="table_convercao"> ';
  
  
   echo '<th style="max-width:150px; min-width:200px">Data</th>';
   
  
  
  
   
   echo '<th style="max-width:225px; min-width:225px" >Venda</th>';
   echo '<th style="max-width:225px; min-width:180px" >Até 17:00</th>';
   echo '<th style="max-width:225px; min-width:180px" >Depois 17:00</th>';

   echo ' </tr>';






    }
    echo ' <tr>';
// parametros originais para nao perder o q vc selecionou quando voltar a tela
   $datainicio_parametro_original ="'". $datainicio ."'";
   $datafim_parametro_original ="'".$datafim."'"; 
   $filial_parametro_original ="'". $filial."'";
// fim dos parametros originais
// parametros que estao na linha q vc clicar para abrir os dias certos
$data_venda_parametro =  "'". $data_venda."'";
 $filial_select_parametro =  "'".$filial_select."'";
 // fim dos parametros

    echo '<td style="max-width:130px;font-size: 35px; min-width:130px"> <label style="width:200px;height:100px;border:1px solid;"  onclick="interage_tiket2('.$filial_select_parametro.', '.$data_venda_parametro.', '.$data_venda_parametro.' ,'.$datainicio_parametro_original.', '. $datafim_parametro_original.', '. $filial_parametro_original .') " >'.$data_exibe.'</label>  </td>';
 
    // echo '<td>   <a href="vizualizar_chamado.php?id='. $data_venda.'&id_loja='.$filial_select.' " ><font color="black">'.$filial_select.'</font> </a>            </td>';
   // echo "<td style='max-width:180px; font-size: 25px;min-width:200px'> ".$filial_select." </td>";
    
   
      echo "<td  style='text-align: right; max-width:150px; font-size: 35px;min-width:150px'>".$valor_venda_produto."</td>";
      echo "<td  style='text-align: right; max-width:150px; font-size: 35px;min-width:150px'>".$antes16."</td>";
      echo "<td  style='text-align: right; max-width:150px; font-size: 35px;min-width:150px'>".$depois16."</td>";
  
      $titulo = "'".$filial."'";


    echo "</tr>";

 }




// soma o total de vendas e joga no final da table
$sql = "

select filial,replace  (replace  (filial.nome,'RESTAURANTE ',''), ' LTDA','') as nome_filial ,


replace (cast(sum(valorliquido)as money)::text , 'R$', '') as valor_venda
 from operacao 

 left join filial on filial.id = operacao.filial::int
where cancelado = 0 and tipo =1 

 and operacao.data between '$datainicio' and '$datafim' and operacao.filial::int = $filial_atual::int    
group by filial,filial.nome
order by filial";
$resultadototal = pg_query($conexao,$sql) or die("Erro ao retornar dados \n $sql");     
while ($registro = pg_fetch_array($resultadototal))
{     

  $valortotal= $registro['valor_venda'];   
  echo "<td  style='text-align: center; max-width:130px; font-size: 35px;min-width:130px'>Total</td>";
echo "<td  style='text-align: right; max-width:150px; font-size: 35px;min-width:150px'>".$valortotal."</td>";
  
}
// final do somatorio das vendas
//calcula o total geral das vendas

$sql = "

select 


replace (cast(sum(valorliquido)as money)::text , 'R$', '') as valor_venda
 from operacao 


where cancelado = 0 and tipo =1 

 and operacao.data between '$datainicio ' and '$datafim' 

";
$resultadototal = pg_query($conexao,$sql) or die("Erro ao retornar dados \n $sql");     
while ($registro = pg_fetch_array($resultadototal))
{     

  $valortotal= $registro['valor_venda'];   
  echo "</table>";
  echo "<br> <table>";
  echo "<tr>";
  echo "<td  style='text-align: center; max-width:230px; font-size: 35px;min-width:230px'>Total Geral</td>";
echo "<td  style='text-align: right; max-width:250px; font-size: 35px;min-width:250px'>".$valortotal."</td>";
  echo "</tr>";
  
}

//final total geral 

 pg_close($conexao);
 echo "</table>";
 ?>

<script type="text/javascript" >





var tabela = document.getElementById('table_convercao');
var totalvalores = 0;
var numeroLinhas = tabela.rows.length;
var linhas = numeroLinhas -1;







 </script>



<br><br><br><br><br><br>
<?php 
exit();
?>