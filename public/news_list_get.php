<?php
try {
    $id = $_GET['id'];
    $pdo = new PDO('mysql:host=database-1.cvocqkxmcrie.ap-northeast-1.rds.amazonaws.com; dbname=danka;charset=utf8', 'admin', 'Henson-303');
    $qry = $pdo->prepare('select * from danka where id = '. $id);
    $qry->execute();
    $array = [];
    foreach($qry->fetchAll() as $row){
        $array[] = array('name'=>$row['name'],'name_kana'=>$row['name_kana'],);
    }
    echo json_encode($array);
} catch (Exception $e) {
    echo json_encode($e->getMessage());
}
?>