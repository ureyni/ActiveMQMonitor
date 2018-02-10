<?php
        include 'config.php';
        include 'functions.php';
        if (isset($_GET['counter'])) {
                $i = $_GET['counter'];
                $jsonData = '{
                    "cols": [
                        {"id": "", "label": "Enqueued", "pattern": "", "type": "string"},
                        {"id": "", "label": "c", "pattern": "", "type": "number"}
                    ],
                    "rows": [
                        {"c": [{"v": "Enqueued", "f": null}, {"v":'.(1000 - $i).', "f": null}]},
                        {"c": [{"v": "Dequeued", "f": null}, {"v": '.$i.', "f": null}]}
                    ]

                }   ';
                 print json_encode(array(array("TEST"=> json_decode($jsonData, true))));
                //print $jsonData;
        }
        if (isset($_GET['getdata'])) {
            
            $jsonArray = array();
            $qlist = getJMSQueuelist();
            foreach ($qlist as $queueName) {
                $queueInfo = getJMSQueueinfo($queueName);
                 $jsonData = '{
                    "cols": [
                        {"id": "", "label": "Enqueued - '.$queueInfo[0].'", "pattern": "", "type": "string"},
                        {"id": "", "label": "Dequeued - '.$queueInfo[1].'", "pattern": "", "type": "number"}
                    ],
                    "rows": [
                        {"c": [{"v": "Enqueued - '.$queueInfo[0].'", "f": null}, {"v":'.$queueInfo[0].', "f": null}]},
                        {"c": [{"v": "Dequeued - '.$queueInfo[1].'", "f": null}, {"v": '.$queueInfo[1].', "f": null}]}
                    ]

                }';
                $jsonArray[] = array($queueName=> json_decode($jsonData, true));
            }
            print json_encode($jsonArray);
        }
        
?>