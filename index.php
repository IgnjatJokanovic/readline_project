<?php
    $gridInput = readline("Enter room size: \n");
    $gridSize = str_split($gridInput);
    $xCoordinateEnd = 0;
    $yCoordinateEnd = 0;
    $robots = [];
    $output = [];
    if(count($gridSize) > 2){
        echo "Bad input for room size\n";
    }else{
        if(is_numeric($gridSize[0]) && is_numeric($gridSize[1])){

            $xCoordinateEnd =  $gridSize[0];
            $yCoordinateEnd =  $gridSize[1];

            echo "Input robot starting position and commands, input stop to stop \n";
            do{

                if(count($robots) == 0){
                    $input = readline("Input starting coordinates for robot 1:");
                    if($input != "stop"){
                        $robots[] = [
                            "position" => $input,
                            "command" => ""
                        ];
                    }
                    
                }else{
                    $robotsCount = count($robots);
                    $lastRobot = $robots[$robotsCount - 1];
                    if($lastRobot["command"] != ""){
                        $tmpRobotsCount = $robotsCount + 1;
                        $input = readline("Input starting coordinates for robot $tmpRobotsCount:");
                        if($input != "stop"){
                            $robots[] = [
                                "position" => $input,
                                "command" => ""
                            ];
                        }
                        
                    }else{
                        $input = readline("Input commands for robot $robotsCount:");
                        if($input != "stop"){
                            $robots[$robotsCount - 1]["command"] = $input;
                        }
                       

                        
                    }
                }
                

            }while($input != "stop");

            foreach($robots as $robot){
                $positionArray = str_split($robot["position"]);
                $commandArray = str_split($robot["command"]);
                $degree = returnDegree($positionArray[2]);
                $xAxis = $positionArray[0];
                $yAxis = $positionArray[1];

                foreach($commandArray as $command){
                    // var_dump($degree, $yAxis, $xAxis);
                    if($command == "F"){
                        if($degree == 90){
                            $xAxis = $xAxis + 1 > $xCoordinateEnd ?  $xCoordinateEnd : $xAxis + 1;
                        }else if($degree == 270){
                            $xAxis = $xAxis - 1 < 0 ?  0 : $xAxis - 1;
                        }else if($degree == 0){
                            $yAxis = $yAxis + 1 > $yCoordinateEnd ?  $yCoordinateEnd : $yAxis + 1;
                        }else{
                            $yAxis = $yAxis - 1 < 0 ?  0 : $yAxis - 1;
                        }
                    }else{
                        #var_dump(calculateDegree($command, $degree), $degree);
                        $degree = calculateDegree($command, $degree);
                    }
                    // var_dump($degree, $xAxis, $yAxis);

                }

                echo $xAxis." ".$yAxis." ".returnDegree($degree, true)."\n";


            }
            
        }else{
            echo "Bad input for room size\n";
        }
    }

    function returnDegree($char, $reverse = false)
    {
        if($reverse){
            switch ($char) {
                case 0:
                    return "N";
                case 90:
                    return "W";
                case 180:
                    return "S";
                default:
                    return "E";
            }
        }else{
            switch ($char) {
                case "N":
                    return 0;
                case "W":
                    return 90;
                case "S":
                    return 180;
                default:
                    return 270;
            }
        }
        
    }


    function calculateDegree($char, $degree){
        if($char == "L"){
            return $degree + 90 > 270 ? 0 : $degree + 90;
        }else{
            return $degree - 90 < 0 ? 270 : $degree - 90;
        }
    }

