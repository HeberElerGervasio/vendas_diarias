
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
$nome_produto = '0';
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

if (isset( $_POST['id_filial_vendaitens']))
{
  $filial= $_POST['id_filial_vendaitens'];
 
}

if (isset( $_POST['data_inicial_vendaitens']))
{
  $datainicio= $_POST['data_inicial_vendaitens'];
 
}
if (isset( $_POST['data_final_vendaitens']))
{
  $datafim= $_POST['data_final_vendaitens'];
 
}




// captura parametros originais para retornar a pagina anterior com filtros corretos
if (isset( $_POST['datainicio_parametro_original']))
{
  $datainicio_parametro_original= $_POST['datainicio_parametro_original'];
 
}

if (isset( $_POST['datafim_parametro_original']))
{
  $datafim_parametro_original= $_POST['datafim_parametro_original'];
 
}

if (isset( $_POST['filial_parametro_original']))
{
  $filial_parametro_original= $_POST['filial_parametro_original'];
 
}




if (isset( $_POST['datainicio_parametro_original1']))
{
  $datainicio_parametro_original= $_POST['datainicio_parametro_original1'];
 
}

if (isset( $_POST['datafim_parametro_original1']))
{
  $datafim_parametro_original= $_POST['datafim_parametro_original1'];
 
}

if (isset( $_POST['filial_parametro_original1']))
{
  $filial_parametro_original= $_POST['filial_parametro_original1'];
 
}




//fim da captura


?>




<title>Itens Vendidos</title>
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


$valor = '';

 if (isset( $_POST['pesquisaingrediente'])) {
  $valor = $_POST['pesquisaingrediente'];
}else{
  //$valor = '2';
}

$nome_produto = '';
$combofornecedor = '';




if (isset( $_POST['id_loja3'])) {

  $nome_produto = $_POST['id_loja3'];
  $id_loja = $_POST['id_loja3'];
}

//echo  $_POST['id_loja3'];
               


if (isset( $_POST['combo_loja'])) {

  $nome_produto = $_POST['combo_loja'];
  $id_loja = $_POST['combo_loja'];
}

 
if (isset( $_POST['combo_departamento'])) {


  $id_combo_departamento = $_POST['combo_departamento'];
}else {
  $id_combo_departamento = '0';
}
 

  if ($nome_produto == '')
  {
    
    $nome_produto = 0;
   
  
  }

  
  

$tipopesquisa='1';

$primeirocheck ='';
$segundocheck ='';
$terceirocheck ='';

if (isset( $_POST['radio_ativos'])) {
 
 $tipopesquisa = $_POST['radio_ativos'];
 
 if ($tipopesquisa == 1)
 {
$primeirocheck = 'checked';
 }

 if ($tipopesquisa == 0)
 {
$segundocheck = 'checked';
 }
 if ($tipopesquisa == 2)
 {
$terceirocheck = 'checked';
 }
 
}else{
  $primeirocheck = 'checked';
}


$datainicial =  date('Y-m-d'); 
$datafinal =  date('Y-m-d'); 

if (isset( $_POST['datainicial'])) {
  $datainicial = $_POST['datainicial'];
}
if (isset( $_POST['datafinal'])) {
  $datafinal =$_POST['datafinal'];
} 


?>









<?php
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

<button id = "Editarl" onclick="voltar_pagina()" style="float:right;height:35px;width:auto;color:white;background-color:#c39030;" value="ignore"   class = "wpcf7-form-control wpcf7-submit button-xlarge" >Voltar</button>



 
  <form method="POST" id="visualiza_ticket" name="visualiza_ticket" action="visualizar_chamado.php" enctype=multipart/form-data>

<input type="hidden" name="id_usuario2" id="id_usuario2" value="<?php echo $grupo_produto; ?>" />

<input type="hidden" name="nome_usuario2" id="nome_usuario2" value="<?php echo $nomeusuario; ?>" />

<input type="hidden" name="id_ticket2" id="id_ticket2" value="<?php echo  $codigo_produto; ?>" />

<input type="hidden" name="id_loja2" id="id_loja2" value="<?php echo $id_loja; ?>" />
<input type="hidden" name="id_loja2" id="id_loja2" value="<?php echo $id_loja; ?>" />

<input type="hidden" name="combo_departamento2" id="combo_departamento2" value="<?php echo $id_combo_departamento; ?>" />

<input type="hidden" name="exibe_imagem2" id="exibe_imagem2" value="<?php echo $exibe_imagem; ?>" />

</form>
  
  
  <div class="a">

    
  <form method="POST"  name="principal" id="principal"  action="Itens_vendidos.php" enctype=multipart/form-data>

  <input type="hidden" name="id_usuario1" id="id_usuario1" value="<?php echo $grupo_produto; ?>" />

<input type="hidden" name="nome_usuario1" id="nome_usuario1" value="<?php echo $nomeusuario; ?>" />


<input type="hidden" name="filial_parametro_original1" id="filial_parametro_original1" value="<?php echo $filial_parametro_original; ?>" />

<input type="hidden" name="datainicio_parametro_original1" id="datainicio_parametro_original1" value="<?php echo $datainicio_parametro_original; ?>" />

<input type="hidden" name="datafim_parametro_original1" id="datafim_parametro_original1" value="<?php echo  $datafim_parametro_original; ?>" />

  <label id = valortotal name="valortotal" style="color:white;padding-left: 50px;font-size: 75px;"> </label>

  <label style="color:white;font-size: 75px;padding-left: 30px;">Itens Vendidos</label >
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
 echo '<button id = "Editarl" onclick="this.form.submit()" style="float:center;height:35px;width:auto;color:white;background-color:#c39030;" value="ignore"   class = "wpcf7-form-control wpcf7-submit button-xlarge" >Ir</button>';
 







 

 ?>

<label style="color:white;font-size: 45px;padding-left: 20px;" for="radio_ativos"></label>  


    <?php// echo $exibe_imagem; ?>




    </form> 

<form method="POST" id="volta_pagina" name="Voltarpagina" action="venda_diaria.php" enctype=multipart/form-data>

<input type="hidden" name="datainicio" id="datainicio" value="<?php echo $datainicio; ?>" />

<input type="hidden" name="datafim" id="datafim" value="<?php echo $datafim; ?>" />

<input type="hidden" name="combo_loja" id="combo_loja" value="<?php echo $filial; ?>" />

<input type="hidden" name="filial_parametro_original" id="filial_parametro_original" value="<?php echo $filial_parametro_original; ?>" />

<input type="hidden" name="datainicio_parametro_original" id="datainicio_parametro_original" value="<?php echo $datainicio_parametro_original; ?>" />

<input type="hidden" name="datafim_parametro_original" id="datafim_parametro_original" value="<?php echo  $datafim_parametro_original; ?>" />

</form>






 <script type="text/javascript" >
window.onbeforeunload = function() {

  document.forms["volta_pagina"].submit(); 
  }
  window.onunload   = function() {
   
  document.forms["volta_pagina"].submit(); 
  }

function voltar_pagina()
{



  document.forms["volta_pagina"].submit();

  
}


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

//console.info('<?php //echo $combofornecedor; ?>');

var linhaselecionada= -1;








</script>


  </div>
  <p><br>







 <tr>
 <table id="table_convercao"> 



 
 <th style="max-width:300px; min-width:300px" >Nome</th>

 <?php
 if ($nome_produto == '0') {
// <th style="max-width:130px; min-width:130px">Cod.</th>
 //<th>Data</th>
 }
 ?>
 
<th style="max-width:225px; min-width:225px" >Grupo</th>

 <th style="max-width:130px; min-width:130px" >Qtd.</th>

 <th style="max-width:150px; min-width:150px" >Venda</th>


</tr>
  </div>
</div>
<form method="POST" id="inicia_ticket" name="inicia_ticket" action="arquivos_php/processa_inicio_trabalho.php" enctype=multipart/form-data>

<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $grupo_produto; ?>" />

<input type="hidden" name="nome_usuario" id="nome_usuario" value="<?php echo $nomeusuario; ?>" />

<input type="hidden" name="id_ticket" id="id_ticket" value="<?php echo  $codigo_produto; ?>" />

<input type="hidden" name="id_loja3" id="id_loja3" value="<?php echo $id_loja; ?>" />

<input type="hidden" name="iniciar_finalizar" id="iniciar_finalizar" value="<?php echo $iniciar_finalizar; ?>" />


</form>

</div>



<?php




$filtro = '';
if($combofornecedor != '')
{
  $filtro =  " and fornecedornome = '$combofornecedor'";
}
if($nome_produto != 'Todos')
{
  $filtro =  " and lojanome = '$nome_produto'";
}



 $pesquisa = '';
if ($tipopesquisa== 1){
$pesquisa = " (upper(fornecedornome) like upper('%$valor%') or '' = '$valor') and ";
}
else if ($tipopesquisa== 0){
  $pesquisa = " (upper(lojanome) like upper('%$valor%') or '' = '$valor') and ";
  }
 else if ($tipopesquisa== 2){
    $pesquisa = " (upper(observacao ) like upper('%$valor%') or '' = '$valor') and ";
 }



// puxa dados grid

$sql = "
select   
p.codigo::bigint,              
p.nome,
substring(hierarquia.nome, 0,17) as grupo  ,             
    
   
      
   
round(sum (i.quantidade ),unidademedida.casasdecimais) as quantidade ,        
     


replace (cast(sum(i.precoliquido)as money)::text , 'R$', '') as totalliquido
   
  from  operacao op 
   
  inner join item i on ((op.tipo = -40 and op.statusnfce = 1 and op.idnfcesubstituta = i.idoperacao) or (op.tipo = 1 and op.id = i.idoperacao))
 inner join produto p on i.produto = p.codigo   left join receitasemcontribuicao rst on p.idreceitasemcontribuicao = rst.id      
left join hierarquia on p.idhierarquia = hierarquia.id
left join unidademedida on unidademedida.id = p.idunidademedida

where    i.cancelado = 0 and op.cancelado = 0        and op.data between '$datainicio ' and '$datafim' and (op.filial::int = $filial::int    or   $filial = 0)


                 group by         p.codigo,              p.nome, hierarquia.nome ,unidademedida.casasdecimais



order by p.nome asc      
                           
                             
                                                



  
";
 $resultado = pg_query($conexao,$sql) or die("Erro ao retornar dados \n $sql");


//echo $sql ;

 
 ?>


<?php
  $quantidate_tickets_tela = 0;
 // Obtendo os dados por meio de um loop while
 while ($registro = pg_fetch_array($resultado))
 {     
   $codigo_produto= $registro['codigo'];
  
    $nome_produto = $registro['nome'];
    $grupo_produto = $registro['grupo'];
   $quantidade_produto = $registro['quantidade'];
     $valor_venda_produto = $registro['totalliquido'];


  

 

    $idticket_parametro =  "'". $codigo_produto."'";
    $nome_produto_parametro =  "'".$nome_produto."'";
    $grupo_produto_parametro = "'".$grupo_produto."'";
    $nomeusuario_parametro = "'".$quantidade_produto."'";
    echo "<td style='max-width:180px; font-size: 25px;min-width:200px'> ".$nome_produto." </td>";
    

      echo "<td style='max-width:225px;font-size: 25px; min-width:225px'>".$grupo_produto."</td>";



      echo "<td  style=' text-align: center; max-width:130px; font-size: 25px;min-width:130px'>".$quantidade_produto."</td>";
   
      echo "<td  style='text-align: right; max-width:150px; font-size: 25px;min-width:150px'>".$valor_venda_produto."</td>";
  
      $titulo = "'".$grupo_produto."'";




    echo "</tr>";



 
 }
 pg_close($conexao);
 echo "</table>";




 ?>


<br><br><br><br><br><br>
<?php 
exit();
?>