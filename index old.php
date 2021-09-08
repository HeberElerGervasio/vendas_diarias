<title>Ingredientes</title>
<meta charset="utf-8">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <script src="date.format.js"></script>



<?php

$login = '';
$senha = '';
$retorno = '';
if (isset($_POST['login'])) {
  $login = $_POST['login'];
}else{
  $login = '';
}
if (isset($_POST['senha'])) {
  $senha  = $_POST['senha'];
}else{
  //$valor = '2';
}
if (isset($_POST['retorno'])) {
  $retorno  = $_POST['retorno'];

}else{
  //$valor = '2';
}




if ($retorno == 1)
{


}


?>
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

</style>


<?php
// inicio menu de opçoes
?>
		<header class="fusion-header-wrapper fusion-header-shadow">
        <div class="fusion-header-v5 fusion-logo-alignment fusion-logo-center fusion-sticky-menu- fusion-sticky-logo- fusion-mobile-logo-1 fusion-sticky-menu-only 
        fusion-header-menu-align-center fusion-mobile-menu-design-modern"  style="float:middle;">


<img src="LOGO-HORIZONTAL-m.png" alt="Smiley face" style="float:middle;width:636px;height:150px;">




<title>Restaurante Dona Conceição – Comida Mineira</title>


<link rel="stylesheet" id="fusion-dynamic-css-css" href="arquivos_css/modelo_menu.css" type="text/css" media="all">

<link rel="stylesheet" id="fusion-dynamic-css-css" href="arquivos_css/102cbd620d3bb3432d4a89b52af0ee36.css" type="text/css" media="all">



</header>



<?php
// fim menu
?>
<style>
div.a {
	text-align: center;

}






</style>

<style>
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
</style>


</div>

</div>



  <div class="column" style="background-color:#1f5a37; background-image: url('https://donaconceicao.com/wp-content/uploads/2019/03/sub-boxed-bg.png'); min-height:800px;" >


  <div class="a">
    
  <form method="POST"  action="processa_login.php" enctype=multipart/form-data>
  <h2>
  <label style="color:white;">Controles Dona Conceição</label >
  <br>


<br>
</h2>


  <label  style="color:white;">Login:</label>
  <input  id = "login" name = "login" type="text" style="float:center;height:35px;width:250px;" value = '<?php echo  $login ;  ?>' >
  <br>  
  <?php 
  if($retorno == '3')
  {

echo '<label  style="color:white;">Usuario incorreto</label>';

}

?>
   <br> 
   <label  style="color:white;">Senha:</label>
  <input  id = "senha" name = "senha" type="password" style="float:center;height:35px;width:250px;" value = '<?php echo  $senha ;  ?>'  ><br>
<?php 
  if($retorno == '2')
  {

echo '<label  style="color:white;">Senha Incorreta</label>';

}

?>


<br> 
<input type="submit" name="btnpesquisa" style="float:center;height:35px;width:250px;color:white;background-color:#3bc863;" class = "wpcf7-form-control wpcf7-submit button-xlarge" value="Login">

</form>
<script>

if(<?php echo $retorno; ?> == 2)
{
  document.getElementById("senha").style.backgroundColor = "#c0392b";
}

if(<?php echo $retorno; ?> == 3)
{
  document.getElementById("login").style.backgroundColor = "#c0392b";
}

</script>


  </div>
  <p>







</div>
</div>







<br><br><br><br><br><br>