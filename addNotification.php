<?php
require_once "Notification.php";

$conn = mysqli_connect("127.0.0.1", "root", "root", "sandbox");

$notification1 = new Notification();
$notification1->setTitle("Noti 1");
$notification1->setBody("Este es el cuerpo de la notificación 1");
$notification1->setTo("fjugal.dev@franciscougalde.com");
$notification1->setType(Notification::TYPE_EMAIL);

$notification2 = new Notification();
$notification2->setTitle("Noti 2");
$notification2->setBody("Este es el cuerpo de la notificación 2");
$notification2->setTo("+34691224675");
$notification2->setType(Notification::TYPE_SMS);

$notification3 = new Notification();
$notification3->setTitle("Noti 3");
$notification3->setBody("Este es el cuerpo de la notificación 3");
$notification3->setTo("info@franciscougalde.com");
$notification3->setType(Notification::TYPE_EMAIL);

$scheduled = new DateTime("now");
$scheduled = $scheduled->format("Y-m-d H:i:s");

$configuration1 = serialize($notification1);
$configuration2 = serialize($notification2);
$configuration3 = serialize($notification3);

$bulk_inserts = array(
    array(
        'name'          => 'Prueba Notificacion 1',
        'scheduled'     => $scheduled,
        'configuration' => $configuration1
    ),
    array(
        'name'          => 'Prueba Notificacion 2',
        'scheduled'     => $scheduled,
        'configuration' => $configuration2
    ),
    array(
        'name'          => 'Prueba Notificacion 3',
        'scheduled'     => $scheduled,
        'configuration' => $configuration3
    ),
);

foreach ($bulk_inserts as $item) {
    echo 'Insertando notificación: ' . $item['name'] . PHP_EOL;
    $sql = "INSERT INTO notifications (`name`,`scheduled`,`configuration`) VALUE ('{$item['name']}', '{$item['scheduled']}','{$item['configuration']}')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
}

echo 'Notificaciónes creadas con éxito!';