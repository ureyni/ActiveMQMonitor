<?php

$qlist = file_get_contents('queueList.txt');
$object = json_decode($qlist);
var_export($object->value->Queues[0]->objectName);
$queueArray = array();
foreach ($object->value->Queues as $object) {
    if ((preg_match_all('/(.*)destinationName=(.*),destinationType=Queue(.*)/', $object->objectName, $match, PREG_SET_ORDER))) {
        print PHP_EOL.$match[0][2];
    }
}

$queue = file_get_contents('queue.txt');
$object = json_decode($queue);
print PHP_EOL;
var_export($object->value->QueueSize);
print PHP_EOL;
var_export($object->value->DequeueCount);

?>