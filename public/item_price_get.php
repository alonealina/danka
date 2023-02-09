<?php
try {
    $id = $_GET['id'];
    $pdo = new PDO('mysql:host=database-1.cvocqkxmcrie.ap-northeast-1.rds.amazonaws.com; dbname=danka;charset=utf8', 'admin', 'Henson-303');
    $qry = $pdo->prepare('select * from item where id = '. $id);
    $qry->execute();
    $array = [];
    foreach($qry->fetchAll() as $row){
        $array[] = array(
            'price'=>$row['price'],
        );
    }

    $qry = $pdo->prepare('select * from hikuyousya where danka_id = '. $id);
    $qry->execute();
    $hikuyousya_array = [];
    foreach($qry->fetchAll() as $row){
        $hikuyousya_array[] = array(
            'id'=>$row['id'],
            'common_name'=>$row['common_name'],
        );
    }

    $array[] = $hikuyousya_array;


    echo json_encode($array);
} catch (Exception $e) {
    echo json_encode($e->getMessage());
}
?>