<?php
    $gridInput = readline("Enter room size: \n");
    $gridSize = str_split($gridInput);
    $xCoordinate = [];
    $yCoordinate = [];
    $degree = 0;
    $robots = [];
    if(count($gridSize) > 2){
        echo "Bad input for room size\n";
    }else{
        if(is_numeric($gridSize[0]) && is_numeric($gridSize[1])){

            $xCoordinate = range(0, $gridSize[0] -1);
            $yCoordinate = range(0, $gridSize[1] -1);
            $matrix = array_fill(1, $gridSize[0] -1, range(1, 5));
            echo "Input robot starting position and commands, input stop to stop \n";
            do{
                if(count($robots) == 0){
                    $input = readline("Input starting coordinates for robot 1:");
                    $robots[] = ["position" => $input];
                }else{
                    $robotsCount = count($robots);
                    $lastRobot = $robots[$robotsCount - 1];
                  
                    if(array_key_exists("command", $lastRobot)){
                        $robotsCount += 1;
                        $input = readline("Input starting coordinates for robot $robotsCount:");
                    }else{
                        $input = readline("Input commands for robot $robotsCount:");
                        
                    }
                }
                

            }while($input != "stop");
            
        }else{
            echo "Bad input for room size\n";
        }
    }

