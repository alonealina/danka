<?php
try {
    $id = $_GET['id'];
    $pdo = new PDO('mysql:host=database-1.cvocqkxmcrie.ap-northeast-1.rds.amazonaws.com; dbname=danka;charset=utf8', 'admin', 'Henson-303');
    $qry = $pdo->prepare('select * from event_search_log where event_date_id = '. $id);
    $qry->execute();
    $array = [];
    foreach($qry->fetchAll() as $row){
        $array[] = array(
            'payment_before'=>$row['payment_before'],
            'payment_after'=>$row['payment_after'],
        );
    }


    echo json_encode($array);
} catch (Exception $e) {
    echo json_encode($e->getMessage());
}
?>