<?php
include 'db_connection.php';

$query_events = "SELECT id, title, color, start, end FROM events";

$events = [];

$conn->prepare($query_events);
$events_result = $conn->prepare($query_events);
$events_result->execute();

while( $row = $events_result->fetch(PDO::FETCH_ASSOC))
{
    $events[] =  
    [
        'id' => $row['id'],
        'title' => $row['title'],
        'color' => $row['color'],
        'start' => $row['start'],
        'end' => $row['end']
    ];
}

echo json_encode( $events );