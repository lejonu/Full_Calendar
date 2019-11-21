<?php
session_start();

include_once 'db_connection.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$date_start = str_replace('/', '-', $dados['start']);

$date_start_conv = date('Y-m-d H:i:s', strtotime($date_start));

$date_end = str_replace('/', '-', $dados['end']);

$date_end_conv = date('Y-m-d H:i:s', strtotime($date_end));

$query_event = "INSERT INTO events(`title`, `color`, `start`, `end`) VALUES(:title, :color, :start, :end);";

$insert_event = $conn->prepare( $query_event );

$insert_event->bindParam(':title', $dados['title']);
$insert_event->bindParam(':color', $dados['color']);
$insert_event->bindParam(':start', $date_start_conv);
$insert_event->bindParam(':end', $date_end_conv);

if( $insert_event->execute() )
{
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento '. $dados['title'] .' cadastrado com Sucesso. Início '.$dados['start'].' </div>'];

    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento '. $dados['title'] .' cadastrado com Sucesso. Início '.$dados['start'].' </div>';
}
else
{
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">O evento '. $dados['title'] .' não foi cadastrado </div>'];
}

header('Content-Type: application/json');
echo json_encode( $retorna );
