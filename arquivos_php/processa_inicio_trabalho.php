<?php
include_once("../conectar.php");

$id_ticket = $_POST['id_ticket'];
$id_usuario = $_POST['id_usuario'];
$nome_usuario = $_POST['nome_usuario'];
$iniciar_finalizar = $_POST['iniciar_finalizar'];
$realiza_ticket = $_POST['realiza_ticket'];

if (isset( $_POST['id_loja3'])) {

    $combolojas = $_POST['id_loja3'];
  }


  if ( $iniciar_finalizar == 1 ) {


$sql =	" 
insert into ticketevent (type,content, date, ticket_id , dc_evento_ticket) value
('COMMENT','$nome_usuario: Ticket iniciado' ,now() , '$id_ticket', 1 );
";

mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");

$sql =	" update ticket set dc_status_ticket = 1, owner_id = '$id_usuario'  where id = '$id_ticket' ;";
echo $sql;
mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");


}


if ( $iniciar_finalizar == 2 ) {


  $sql =	" select CONCAT(
    TIMESTAMPDIFF(DAY, STR_TO_DATE(ticketevent.date,'%Y%m%d%H%i') + INTERVAL TIMESTAMPDIFF(MONTH, STR_TO_DATE(ticketevent.date,'%Y%m%d%H%i'), now()) MONTH, now()) ,' Dias ' ,
    TIMESTAMPDIFF(HOUR, STR_TO_DATE(ticketevent.date,'%Y%m%d%H%i') + INTERVAL TIMESTAMPDIFF(DAY,  STR_TO_DATE(ticketevent.date,'%Y%m%d%H%i'), now()) DAY, now()) , ' Horas e ' ,
    TIMESTAMPDIFF(MINUTE, STR_TO_DATE(ticketevent.date,'%Y%m%d%H%i') + INTERVAL TIMESTAMPDIFF(HOUR,  STR_TO_DATE(ticketevent.date,'%Y%m%d%H%i'), now()) HOUR, now()), ' Minutos' 
    ) as tempo
    FROM opensupports_871.ticketevent
    
    where  ticketevent.ticket_id = '$id_ticket' and dc_evento_ticket = 1
    order by id desc
     limit 1 
     ";

     
  
     $resultado =  mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");


  while ($registro = mysqli_fetch_array($resultado))
  {
   $tempo = $registro['tempo'];
  }

  $sql =	" 
  insert into ticketevent (type,content, date, ticket_id , dc_evento_ticket) value
  ('COMMENT','$nome_usuario: Ticket Finalizado! <br>Tempo gasto:  $tempo' ,now() , '$id_ticket', 2 );
  ";
  
  mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");
  
  $sql =	" update ticket set dc_status_ticket = 2  , closed = 1 where id = $id_ticket ;";
  mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");








}

?>





<form name="form1" method="POST"   action="../chamados.php" enctype=multipart/form-data>

<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>" />
<input type="hidden" name="realiza_ticket" id="realiza_ticket" value="<?php echo $realiza_ticket; ?>" />
<input type="hidden" name="nome_usuario" id="nome_usuario" value="<?php echo $nome_usuario; ?>" />
<input type="hidden" name="combo_loja" id="combo_loja" value="<?php echo $combolojas; ?>" />
<script language="JavaScript">document.forms["form1"].submit();</script>

</form>