<?php
session_start();

include_once 'db_connection.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$date_start = str_replace('/', '-', $dados['start']);

$date_start_conv = date('Y-m-d H:i:s', strtotime($date_start));

$date_end = str_replace('/', '-', $dados['end']);

$date_end_conv = date('Y-m-d H:i:s', strtotime($date_end));

$query_event = "UPDATE events SET title=:title, color=:color, start=:start, end=:end WHERE id=:id;";

$update_event = $conn->prepare( $query_event );

$update_event->bindParam(':id', $dados['id']);
$update_event->bindParam(':title', $dados['title']);
$update_event->bindParam(':color', $dados['color']);
$update_event->bindParam(':start', $date_start_conv);
$update_event->bindParam(':end', $date_end_conv);

if( $update_event->execute() )
{
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento '. $dados['title'] .' editado com Sucesso. Início '.$dados['start'].' </div>'];

    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento '. $dados['title'] .' editado com Sucesso. Início '.$dados['start'].' </div>';
}
else
{
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">O evento '. $dados['title'] .' não foi editado </div>'];
}

header('Content-Type: application/json');
echo json_encode( $retorna );
