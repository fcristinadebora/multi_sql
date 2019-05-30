<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$filename = "../databases.csv";

//Open the file.
$fileHandle = fopen($filename, "r");
 
$lines = [];
$count = 0;
while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
    if($count > 0){ ?>
    <tr>
        <td><?php echo $count ?></td>
        <td>
            <input type="checkbox" class="chk_db" id="chk_<?php echo $count?>" value="<?php echo $count?>">
            <input type="hidden" id="">
            <input type="hidden" id="name_<?php echo $count ?>" value="<?php echo $row[0] ?>">
            <input type="hidden" id="driver_<?php echo $count ?>" value="<?php echo $row[1] ?>">
            <input type="hidden" id="host_<?php echo $count ?>" value="<?php echo $row[2] ?>">
            <input type="hidden" id="user_<?php echo $count ?>" value="<?php echo $row[3] ?>">
            <input type="hidden" id="password_<?php echo $count ?>" value="<?php echo $row[4] ?>">
            <input type="hidden" id="database_<?php echo $count ?>" value="<?php echo $row[5] ?>">
        </td>
        <td><?php echo $row[0] ?></td>
        <td><?php echo $row[2] ?></td>
        <td><?php echo $row[3] ?></td>
        <td><?php echo $row[5] ?></td>
    </tr>
<?php
    }
    $count++;
}