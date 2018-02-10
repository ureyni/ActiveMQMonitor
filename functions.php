<?php

/*
 * Get Queue List from ActiveMQ via JMS 
 */

function getJMSQueuelist() {
    global $QUEUE_LIST, $QUEUE_USER, $QUEUE_PASSWORD;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $QUEUE_LIST);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
    curl_setopt($ch, CURLOPT_USERPWD, "$QUEUE_USER:$QUEUE_PASSWORD");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //  curl_setopt($ch, CURLOPT_TCP_KEEPALIVE, 0);
    $response = curl_exec($ch);
    if ($response === false) {
        echo "Error Number:" . curl_errno($ch) . "<br>";
        echo "Error String:" . curl_error($ch);
        return false;
    }
    curl_close($ch);
    /* for testttt
    $response = file_get_contents('queueList.txt');
     * 
     */
    $object = json_decode($response);
    $queueArray = array();
    foreach ($object->value->Queues as $object) {
        if ((preg_match_all('/(.*)destinationName=(.*),destinationType=Queue(.*)/', $object->objectName, $match, PREG_SET_ORDER))) {
            $queueArray[] = $match[0][2];
        }
    }

    return $queueArray;
}

/*
 * Get Queue info from ActiveMQ via JMS 
 */

function getJMSQueueinfo($queueName = "") {
    global $QUEUE_INFO, $QUEUE_USER, $QUEUE_PASSWORD;
   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $QUEUE_INFO . $queueName);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
    curl_setopt($ch, CURLOPT_USERPWD, "$QUEUE_USER:$QUEUE_PASSWORD");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //  curl_setopt($ch, CURLOPT_TCP_KEEPALIVE, 0);
    $response = curl_exec($ch);
    if ($response === false) {
        echo "Error Number:" . curl_errno($ch) . "<br>";
        echo "Error String:" . curl_error($ch);
        return false;
    }
    curl_close($ch);
   // $response = file_get_contents('queue.txt');
    $object = json_decode($response);
    return array(isset($object->value->QueueSize)==false?1:$object->value->QueueSize,isset($object->value->DequeueCount)==false?1:$object->value->DequeueCount);
    //$val = rand(0, 1000);
    //return array($val,(1000-$val));
}

?>