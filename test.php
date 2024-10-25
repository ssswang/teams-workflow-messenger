<?php
require __DIR__ . '/vendor/autoload.php';

$webhookUrl = '';

$flow = new \TeamsWorkflowMessenger\Messenger($webhookUrl);
$factory = new \TeamsWorkflowMessenger\PayloadFactory();
//test message
$payload = $factory->makeTextPayload("This is a test message.");
$flow->post($payload);

//test text table
$payload = $factory->makeTextTablePayload(
    [2, 1],//column width
    [
        ["Item", "Processed"],
        ["Item Name 1", 10],
        ["Item Name 2", 20]
    ]
);
$flow->post($payload);

//test multi-line
$lines = ["first line", "second line", "third line"];
$payload = $factory->makeMultilineTextPayload($lines);
$flow->post($payload);

?>