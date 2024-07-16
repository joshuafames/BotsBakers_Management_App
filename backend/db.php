<?php
    $conn = new mysqli("127.0.0.1", "root", "", "botsbakers");

    function db($conn, $query, $params = []){
        $stmt = $conn->prepare($query);
        if($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        if(!empty($params)) {
            $types = '';
            foreach ($params as $param){
                if(is_int($param)) {
                    $types .= 'i';
                }elseif (is_double($param)) {
                    $types .= 'd';
                }elseif (is_string($param)) {
                    $types .= 's';
                }else {
                    $types .= 'b';
                }
            }

            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        if(stripos($query, 'SELECT') === 0) {
            $result = $stmt->get_result();
            $data = [];
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
            return $data;
        }else {
            $stmt->close();
            return $conn->affected_rows > 0;
        }
    }
?>

