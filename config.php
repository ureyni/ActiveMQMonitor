<?php
/*
 * queue parameters
 */
        // queue administrator username 
        $QUEUE_USER = "admin";
        // queue password of administrator user  
        $QUEUE_PASSWORD = "admin";
        //queue host and port 
        $QUEUE_HOST = "http://10.145.176.11:8161";
        // url for get queue list from queue
        $QUEUE_LIST = $QUEUE_HOST."/api/jolokia/read/org.apache.activemq:type=Broker,brokerName=localhost";
        // get url for number of consumer/producer 
        $QUEUE_INFO = $QUEUE_HOST."/api/jolokia/read/org.apache.activemq:type=Broker,brokerName=localhost,destinationType=Queue,destinationName=";
           
?>
