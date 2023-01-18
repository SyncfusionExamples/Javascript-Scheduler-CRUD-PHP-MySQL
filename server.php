<?php
        $servername = "localhost";
		$username = "root";
		$password = "Ram@09121997";
		$dbname = "syncfusion";
	
		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error) {        
			die("Connection failed" . $conn->connect_error);
		}

    header("Content-type:application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: *");
    header("Access-Control-Allow-Headers: *");
    header('Access-Control-Allow-Origin: *', false);
    if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header( "HTTP/1.1 200 OK" );
        exit;
    }

    $json_param = file_get_contents('php://input');
    $param = json_decode($json_param,true);

    if(isset($param['action'])) {
        if ($param['action'] == "insert" || ($param['action'] == "batch" && !empty($param['added']))) {
            error_log("This is an error message");
            if ($param['action'] == "insert") {
                $id = isset($param['value']['Id']) ? $param['value']['Id'] : null;
                $subject = isset($param['value']['Subject']) ? $param['value']['Subject'] : null;
                $startTime = isset($param['value']['StartTime']) ? $param['value']['StartTime'] : null;
                $endTime = isset($param['value']['EndTime']) ? $param['value']['EndTime'] : null;
                $location = isset($param['value']['Location']) ? $param['value']['Location'] : null;
                $description = isset($param['value']['Description']) ? $param['value']['Description'] : null;
                $isAllDay = isset($param['value']['IsAllDay']) ? $param['value']['IsAllDay'] : null;
                $recurrenceId = isset($param['value']['RecurrenceID']) && $param['value']['RecurrenceID'] > 0 ? $param['value']['RecurrenceID'] : null;
                $recurrenceRule = isset($param['value']['RecurrenceRule']) ? $param['value']['RecurrenceRule'] : null;
                $recurrenceException = isset($param['value']['RecurrenceException']) && !empty($param['value']['RecurrenceException']) ? $param['value']['RecurrenceException'] : null;
                $roomId = isset($param['value']['RoomID']) && !empty($param['value']['RoomID']) ? $param['value']['RoomID'] : null;
    
                $startTime = clone new DateTime($startTime);
                $timezone = new DateTimeZone('Asia/Calcutta');
                $startTime->setTimezone($timezone);
                $startTime = $startTime->format('Y-m-d H:i:s');
                $endTime = clone new DateTime($endTime);
                $timezone = new DateTimeZone('Asia/Calcutta');
                $endTime->setTimezone($timezone);
                $endTime = $endTime->format('Y-m-d H:i:s');
               
                if($recurrenceRule == null) {
                    $sql = "INSERT INTO `appointments` (`Id`, `Subject`, `StartTime`, `EndTime`, `Location`, `Description`, `IsAllDay`, `RoomID`) VALUES ('$id', '$subject', '$startTime', '$endTime', '$location','$description', '$isAllDay', '$roomId')";
                } else {
                    if($recurrenceId == null) {
                        $sql = "INSERT INTO `appointments` (`Id`, `Subject`, `StartTime`, `EndTime`, `Location`, `Description`, `IsAllDay`, `RecurrenceRule`, `RoomID`) VALUES ('$id', '$subject', '$startTime', '$endTime', '$location','$description', '$isAllDay', '$recurrenceRule', '$roomId')";
                    } else {
                        $sql = "INSERT INTO `appointments` (`Id`, `Subject`, `StartTime`, `EndTime`, `Location`, `Description`, `IsAllDay`, `RecurrenceID`, `RecurrenceRule`, `RecurrenceException`, `RoomID`) VALUES ('$id', '$subject', '$startTime', '$endTime', '$location','$description', '$isAllDay', '$recurrenceId', '$recurrenceRule', '$recurrenceException', '$roomId')";
                    }
                }
                $result = $conn->query($sql);
            }
            else if ($param['action'] == "batch" && !empty($param['added'])) {
                foreach($param['added'] as $add) {
                    $id =isset($add['Id']) ? $add['Id'] : null;
                    $subject = isset($add['Subject']) ? $add['Subject'] : null;
                    $startTime = isset($add['StartTime']) ? $add['StartTime'] : null;
                    $endTime = isset($add['EndTime']) ? $add['EndTime'] : null;
                    $location = isset($add['Location']) ? $add['Location'] : null;
                    $description = isset($add['Description']) ? $add['Description'] : null;
                    $isAllDay = isset($add['IsAllDay']) ? $add['IsAllDay'] : null;
                    $recurrenceId = isset($add['RecurrenceID']) && $add['RecurrenceID'] > 0 ? $add['RecurrenceID'] : null;
                    $recurrenceRule = isset($add['RecurrenceRule']) ? $add['RecurrenceRule'] : null;
                    $recurrenceException = isset($add['RecurrenceException']) && !empty($add['RecurrenceException']) ? $add['RecurrenceException'] : null;
                    $roomId = isset($add['RoomID']) && !empty($add['RoomID']) ? $add['RoomID'] : null;
    
                    $startTime = clone new DateTime($startTime);
                    $timezone = new DateTimeZone('Asia/Calcutta');
                    $startTime->setTimezone($timezone);
                    $startTime = $startTime->format('Y-m-d H:i:s');
                    $endTime = clone new DateTime($endTime);
                    $timezone = new DateTimeZone('Asia/Calcutta');
                    $endTime->setTimezone($timezone);
                    $endTime = $endTime->format('Y-m-d H:i:s');
                    
                    if($recurrenceRule == null) {
                        $sql = "INSERT INTO `appointments` (`Id`, `Subject`, `StartTime`, `EndTime`, `Location`, `Description`, `IsAllDay`, `RoomID`) VALUES ('$id', '$subject', '$startTime', '$endTime', '$location','$description', '$isAllDay', '$roomId')";
                    } else {
                        if($recurrenceId == null) {
                            $sql = "INSERT INTO `appointments` (`Id`, `Subject`, `StartTime`, `EndTime`, `Location`, `Description`, `IsAllDay`, `RecurrenceRule`, `RoomID`) VALUES ('$id', '$subject', '$startTime', '$endTime', '$location','$description', '$isAllDay', '$recurrenceRule', '$roomId')";
                        } else {
                            $sql = "INSERT INTO `appointments` (`Id`, `Subject`, `StartTime`, `EndTime`, `Location`, `Description`, `IsAllDay`, `RecurrenceID`, `RecurrenceRule`, `RecurrenceException`, `RoomID`) VALUES ('$id', '$subject', '$startTime', '$endTime', '$location','$description', '$isAllDay', '$recurrenceId', '$recurrenceRule', '$recurrenceException', '$roomId')";
                        }
                    }
                    $result = $conn->query($sql);
                }
            }
        }

        if ($param['action'] == "update" || ($param['action'] == "batch" && !empty($param['changed']))) {
            if ($param['action'] == "update") {
                $id = isset($param['value']['Id']) ? $param['value']['Id'] : null;
                $subject = isset($param['value']['Subject']) ? $param['value']['Subject'] : null;
                $startTime = isset($param['value']['StartTime']) ? $param['value']['StartTime'] : null;
                $endTime = isset($param['value']['EndTime']) ? $param['value']['EndTime'] : null;
                $location = isset($param['value']['Location']) ? $param['value']['Location'] : null;
                $description = isset($param['value']['Description']) ? $param['value']['Description'] : null;
                $isAllDay = isset($param['value']['IsAllDay']) ? $param['value']['IsAllDay'] : false;
                $recurrenceId = isset($param['value']['RecurrenceID']) && $param['value']['RecurrenceID'] > 0 ? $param['value']['RecurrenceID'] : null;
                $recurrenceRule = isset($param['value']['RecurrenceRule']) ? $param['value']['RecurrenceRule'] : null;
                $recurrenceException = isset($param['value']['RecurrenceException']) && !empty($param['RecurrenceException']) ? $param['value']['RecurrenceException'] : null;
                $roomId = isset($param['value']['RoomID']) && !empty($param['RoomID']) ? $param['value']['RoomID'] : null;
    
                $startTime = clone new DateTime($startTime);
                $timezone = new DateTimeZone('Asia/Calcutta');
                $startTime->setTimezone($timezone);
                $startTime = $startTime->format('Y-m-d H:i:s');
                $endTime = clone new DateTime($endTime);
                $timezone = new DateTimeZone('Asia/Calcutta');
                $endTime->setTimezone($timezone);
                $endTime = $endTime->format('Y-m-d H:i:s');
    
                if($recurrenceRule == null){
                    $sql = "UPDATE `appointments` SET `Subject` = '$subject', `StartTime` = '$startTime', `EndTime` = '$endTime', `Location` = '$location', `Description` = '$description', `IsAllDay` = '$isAllDay', `RoomID` = '$roomId' WHERE `appointments`.`Id` = '$id'";
                }
                else {
                    $sql = "UPDATE `appointments` SET `Subject` = '$subject', `StartTime` = '$startTime', `EndTime` = '$endTime', `Location` = '$location', `Description` = '$description', `IsAllDay` = $isAllDay, `RecurrenceID` = $recurrenceId,`RecurrenceRule` = $recurrenceRule,`RecurrenceException` = $recurrenceException, `RoomID` = '$roomId'  WHERE `appointments`.`Id` = '$id'";
                }

                $result = $conn->query($sql);
            }
            else if ($param['action'] == "batch" && !empty($param['changed'])) {
                foreach($param['changed'] as $update) {
                    $id = isset($update['Id']) ? $update['Id'] : null;
                    $subject = isset($update['Subject']) ? $update['Subject'] : null; 
                    $startTime = isset($update['StartTime']) ? $update['StartTime'] : null; 
                    $endTime = isset($update['EndTime']) ? $update['EndTime'] : null; 
                    $location = isset($update['Location']) ? $update['Location'] : null;
                    $description = isset($update['Description']) ? $update['Description'] : null;
                    $isAllDay = isset($update['IsAllDay']) ? $update['IsAllDay'] : false;
                    $recurrenceId = isset($update['RecurrenceID']) && $update['RecurrenceID'] > 0 ? $update['RecurrenceID'] : null;
                    $recurrenceRule = isset($update['RecurrenceRule']) ? $update['RecurrenceRule'] : null;
                    $recurrenceException = isset($update['RecurrenceException']) && !empty($update['RecurrenceException']) ? $update['RecurrenceException'] : null;
                    $roomId = isset($update['RoomID']) && !empty($update['RoomID']) ? $update['RoomID'] : null;
    
                    $startTime = clone new DateTime($startTime);
                    $timezone = new DateTimeZone('Asia/Calcutta');
                    $startTime->setTimezone($timezone);
                    $startTime = $startTime->format('Y-m-d H:i:s');
                    $endTime = clone new DateTime($endTime);
                    $timezone = new DateTimeZone('Asia/Calcutta');
                    $endTime->setTimezone($timezone);
                    $endTime = $endTime->format('Y-m-d H:i:s');
    
                    if($recurrenceRule == null){
                        $sql = "UPDATE `appointments` SET `Subject` = '$subject', `StartTime` = '$startTime', `EndTime` = '$endTime', `Location` = '$location', `Description` = '$description', `IsAllDay` = '$isAllDay', `RoomID` = '$roomId' WHERE `appointments`.`Id` = $id";
                    }
                    else {
                        if($recurrenceId == null) {
                            if($recurrenceException == null) {
                                $sql = "UPDATE `appointments` SET `Subject` = '$subject', `StartTime` = '$startTime', `EndTime` = '$endTime', `Location` = '$location', `Description` = '$description', `IsAllDay` = '$isAllDay', `RecurrenceRule` = '$recurrenceRule', `RoomID` = '$roomId'  WHERE `appointments`.`Id` = '$id'";
                            } else {
                                $sql = "UPDATE `appointments` SET `Subject` = '$subject', `StartTime` = '$startTime', `EndTime` = '$endTime', `Location` = '$location', `Description` = '$description', `IsAllDay` = '$isAllDay', `RecurrenceRule` = '$recurrenceRule', `RecurrenceException` = '$recurrenceException', `RoomID` = '$roomId'  WHERE `appointments`.`Id` = '$id'";
                            }
                        } else {
                            $sql = "UPDATE `appointments` SET `Subject` = '$subject', `StartTime` = '$startTime', `EndTime` = '$endTime', `Location` = '$location', `Description` = '$description', `IsAllDay` = '$isAllDay', `RecurrenceID` = '$recurrenceId', `RecurrenceRule` = '$recurrenceRule', `RecurrenceException` = '$recurrenceException', `RoomID` = '$roomId' WHERE `appointments`.`Id` = '$id'";
                        }
                    }

                    $result = $conn->query($sql);
                }
            }
        }

        if ($param['action'] == "remove" || ($param['action'] == "batch" && !empty($param['deleted']))) {
            if ($param['action'] == "remove") {
                $id = $param['key'];
                $sql = "DELETE FROM `appointments` WHERE `Id`='$id'";   
                $result = $conn->query($sql);
            }
            else if ($param['action'] == "batch" && !empty($param['deleted'])) {
                foreach($param['deleted'] as $delete) {                
                    if($delete['Id'] != null)
                    {
                        $id = $delete['Id'];
                        $sql = "DELETE FROM `appointments` WHERE `Id`='$id'";
                        $result = $conn->query($sql);
                    }             
                }
            }
        }
    }

    $json = array();

    if (isset($param["StartDate"]) && isset($param["EndDate"])) {
        $sql = "SELECT * FROM `appointments`";
        $appointmentList = $conn->query($sql);
        $json = $appointmentList->fetch_all(MYSQLI_ASSOC);
    }
    echo json_encode($json, JSON_NUMERIC_CHECK);
?>