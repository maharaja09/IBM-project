<?php
// include config file
require '../config/config.php';
// Table Create
$product_table = "CREATE TABLE product_table (
    id int(11) NOT NULL,
    product_id varchar(25) UNIQUE NOT NULL,
    product_name varchar(50) NOT NULL,
    ram varchar(10) NOT NULL,
    storage varchar(15) NOT NULL,
    display varchar(25) NOT NULL,
    battery varchar(20) NOT NULL,
    product_price int(11) NOT NULL,
    product_total_qty int(11) NOT NULL,
    images varchar(225) NOT NULL)";

// Run the query
if($con -> query($product_table) === true){
    echo "Table created successfully";
}
else{
    echo "Table creation is error" . $con -> error;
}

$insertvalue = "INSERT INTO product_table (product_id, product_name, ram, storage, display, battery, product_price, product_total_qty,images) 
VALUES 
('101','Vivo Y91','3GB','32GB' ,'6.53inch','4030mAh',9990,100,'Vivo_Y91.PNG'),
('102','Vivo Z1Pro','4GB' ,'64 GB','6.22 inch','5000 mAh',14990,100,'Vivo_Z1Pro.PNG'),
('103','Realme C2','2 GB','16 GB','6.1 inch','4000 mAh',5999,100,'Realme_C2.PNG'),
('104','Realme 3i','4 GB' ,'64 GB','6.22 inch','4230 mAh',9999,100,'Realme_3i.PNG'),
('105','Realme X','8 GB','128 GB','6.53 inch','3765 mAh',19999,100,'Realme_X.PNG'),
('106','Realme 3 Pro','6 GB','64 GB','6.3 inch','4045 mAh',15999,100,'Realme_3_Pro.PNG'),
('107','Samsung Galaxy J6','4 GB' ,'64 GB','5.6 inch','3000 mAh',9490,100,'Samsung_Galaxy_J6.PNG'),
('108','Samsung Galaxy On8','4 GB' ,'64 GB','6 inch','3500 mAh',11990,100,'Samsung_Galaxy_On8.PNG'),
('109','Samsung Galaxy A10','2 GB','32 GB' ,'6.2 inch','3400 mAh',7990,100,'Samsung_Galaxy_A10.PNG'),
('110','Samsung Galaxy M30','4 GB' ,'64 GB','6.4 inch','5000 mAh',15356,100,'Samsung_Galaxy_M30.PNG'),
('111','Samsung Galaxy A2 Core','1 GB','16 GB','5 inch','2600 mAh',5290,100,'Samsung_Galaxy_A2_Core.PNG'),
('112','Honor 9 Lite','3 GB','32 GB' ,'5.65 inch','3000 mAh',7999,100,'Honor_9_Lite.PNG'),
('113','Honor 8C','4 GB' ,'32 GB','6.26 inch','4000 mAh',7999,100,'Honor_8C.PNG'),
('114','OPPO F5','6 GB','64 GB','6 inch','3200 mAh',24990,100,'OPPO_F5.PNG'),
('115','OPPO F11 Pro','6 GB','64 GB','6.5 inch','4000 mAh',20990,100,'OPPO_F11_Pro.PNG'),
('116','OPPO Reno 10x Zoom','6 GB','128 GB','6.6 inch','4065 mAh',39990,100,'OPPO_Reno_10x_Zoom.PNG'),
('117','OPPO Find X','8 GB','256 GB','6.4 inch','3730 mAh',58990,100,'OPPO_Find_X.PNG'),
('118','OPPO F9 Pro','6 GB','64 GB','6.3 inch','3500 mAh',20990,100,'OPPO_F9_Pro.PNG'),
('119','OPPO K1','4 GB' ,'64 GB','6.41 inch','3600 mAh',20000,100,'OPPO_K1.PNG'),
('120','OPPO F5','3 GB','32 GB','6 inch','3200 mAh',20000,100,'OPPO_F5_Youth.PNG')";

// Run the insert query
if ($con->query($insertvalue) === TRUE) {
    echo "New record created successfully";
} 
else {
    echo "Error: " . $insertvalue . "<br>" . $con->error;
}
?> 