
<?php include_once("../conectar.php");

	$id_ticket = $_REQUEST['id_Combo_ingrediente'];
	$status_ticket = $_REQUEST['status_ticket'];
	$nome_usuario = $_REQUEST['nome_usuario'];
	$id_usuario = $_REQUEST['id_usuario'];
	$executado = 0;

	

	if ( $status_ticket == 0 ) {


		$sql =	" 
		insert into ticketevent (type,content, date, ticket_id , dc_evento_ticket) value
		('COMMENT','$nome_usuario: Ticket iniciado' ,now() , '$id_ticket', 1 );
		";
		
		mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");
		
		$sql =	" update ticket set dc_status_ticket = 1, owner_id = '$id_usuario'  where id = '$id_ticket' ;";
		echo $sql;
		mysqli_query($conexao,$sql) or die(mysql_error()."<br>Erro ao executar a inserção dos dados: $sql");
		
		$executado = 1;
		}
		
		
		if ( $status_ticket == 1 ) {
		
		
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
		
		  $executado =1;
		
		
		
		
		
		
		}
























	
