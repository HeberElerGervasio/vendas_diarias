<?php
include_once("../conectar.php");




if (isset( $_POST['id_ticket_i']))
{
  $id_usuario= $_POST['id_usuario_i'];
  $nomeusuario= $_POST['nome_usuario_i'];
  $id_loja =  $_POST['combo_loja_i'];
  $id_ticket =  $_POST['id_ticket_i'];
  $comentario_ticket =  $_POST['comentario_ticket'];
  $exibe_imagem =  $_POST['exibe_imagem'];
  
}
if (isset( $_POST['combo_loja_i']))
{

}else
{
  $id_loja = '0';
}
if  ($id_loja == '')
{
  $id_loja = '0';
}

if (isset( $_POST['id_ticket_i']))
{

}else
{
  $id_ticket = '0';
}
if  ($id_ticket == '')
{
  $id_ticket = '0';
}





$sql =	" 
insert into ticketevent (type,content, date, ticket_id , dc_evento_ticket,author_user_id) value
('COMMENT','$comentario_ticket' ,now() , '$id_ticket', 0 ,$id_usuario);
";
echo $sql;
mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");








?>





<form name="form1" method="POST"   action="../visualizar_chamado.php" enctype=multipart/form-data>

<input type="hidden" name="id_usuario_i" id="id_usuario_i" value="<?php echo $id_usuario; ?>" />
  <input type="hidden" name="nome_usuario_i" id="nome_usuario_i" value="<?php echo $nomeusuario; ?>" />
  <input type="hidden" name="combo_loja_i" id="combo_loja_i" value="<?php echo $id_loja; ?>" />
  <input type="hidden" name="id_ticket_i" id="id_ticket_i" value="<?php echo $id_ticket; ?>" />
  <input type="hidden" name="exibe_imagem" id="exibe_imagem" value="<?php echo $exibe_imagem; ?>" />
  <input type="hidden" name="id_ticket" id="id_ticket" value="<?php echo $id_ticket; ?>" />
  
<script language="JavaScript">document.forms["form1"].submit();</script>

</form>