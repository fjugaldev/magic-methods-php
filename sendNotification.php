<?php
require_once "Notification.php";

$conn = mysqli_connect("127.0.0.1", "root", "root", "sandbox");

$sql = "SELECT * FROM notifications";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$notifications = mysqli_fetch_all($query, MYSQLI_ASSOC);

foreach($notifications as $notification) {
    /** @var Notification $objNotification */
    $objNotification = unserialize($notification['configuration']);

    echo "---------------------- NUEVA NOTIFICACIÓN ----------------------" . PHP_EOL;
    echo "Notificación a enviar:" . $notification['name'] . PHP_EOL;
    echo "Scheduled:" . $notification['scheduled'] . PHP_EOL;
    echo "Titulo: " . $objNotification->getTitle() . PHP_EOL;
    echo "Cuerpo: " . $objNotification->getBody() . PHP_EOL;
    echo "Destinatario: " . $objNotification->getTo() . PHP_EOL;
    echo "Tipo: " . $objNotification->getType() . PHP_EOL . PHP_EOL;
    echo "Enviando notificación..." . PHP_EOL;
    $objNotification->send();
    echo "----------------------------------------------------------------" . PHP_EOL . PHP_EOL;
}