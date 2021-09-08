<?php
include_once("../conectar.php");

$id_ticket = $_POST['id_ticket'];
$id_usuario = $_POST['id_usuario'];
$nome_usuario = $_POST['nome_usuario'];
if (isset( $_POST['combo_loja'])) {

    $combolojas = $_POST['combo_loja'];
  }

$sql =	" 
insert into ticketevent (type,content, date, ticket_id , dc_evento_ticket) value
('COMMENT','$nome_usuario: Ticket Finalizado' ,now() , '$id_ticket', 2 );
";

mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");

$sql =	" update ticket set dc_status_ticket = 2  , closed = 1 where id = $id_ticket ;";
mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");

?>
<form name="form1" method="POST"   action="../chamados.php" enctype=multipart/form-data>

<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>" />

<input type="hidden" name="nome_usuario" id="nome_usuario" value="<?php echo $id_usuario; ?>" />
<input type="hidden" name="combo_loja" id="combo_loja" value="<?php echo $combolojas; ?>" />
<script language="JavaScript">document.forms["form1"].submit();</script>
 
</form>