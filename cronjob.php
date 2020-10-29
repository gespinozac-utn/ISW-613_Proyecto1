<?php
// Desarrollar un script que busque los productos con cierto nivel de stock y que el mismo envíe un correo electrónico al administrador con el asunto “Productos con bajo stock”, en el contenido del correo indicar el SKU de los productos con bajo stock. El script recibirá como parámetro el stock mínimo a consultar, de manera que si al ejecutar el script se envía como parámetro el número 3, entonces el script identificara y reportará aquellos productos cuyo stock es menor o igual a 3. 

if ($argc == 2) {
    include('sqlConnection.php');
    $conn = getConnection();
    $adminMail = 'gespinozac@est.utn.ac.cr'; //'barroyo@adm.utn.ac.cr';
    $subject = 'Low stock products';
    $message = '<html><body>';
    $message .= "<h1>Low Stock products listen below:</h1>";
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= "<tr style='background: #eee;'><td><strong>SKU:</strong> </td><td><strong>Name:</strong> </td><td>Quantity</td></tr>";
    $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n"; //ADD type content to the email to work with html tags 
    $numMin = $argv[1];

    $sql = 'SELECT * FROM product WHERE stock <= ' . $numMin . ';';
    $result = $conn->query($sql);
    if ($conn->connect_errno) {
        echo $conn->connect_error;
        $conn->close();
        die;
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $message .= '<tr><td>' . $row['sku'] . '</td><td>' . $row['name'] . '</td><td>' . $row['stock'] . '</td></tr>';
        }
    } else {
        echo 'No low stock equal or lower than [' . $numMin . '].';
        die;
    }

    $message .= '</table></body></html>';
    if (mail($adminMail, $subject, $message, $headers))
        echo 'Mail sended to ' . $adminMail;
}