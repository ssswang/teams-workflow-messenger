<?php

namespace TeamsWorkflowMessenger;

class PayloadFactory
{
    function makeTextTablePayload($columnWidth, $data){
        $rows = [];
        foreach($data as $item){
            $rows [] = $this->makeTableTextRow($item);
        }
        $card = [

            '$schema' => "http://adaptivecards.io/schemas/adaptive-card.json",
            "type" => "AdaptiveCard",
            "version" => "1.4",
            "body" => [
                [
                    "type" => "Table",
                    "gridStyle" => "accent",
                    "firstRowAsHeaders" => true,
                    "showGridLines" => true,
                    "columns" => $this->makeTableColumnsWidth($columnWidth),
                    "rows" => $rows
                ]
            ]
        ];
        return $this->makeAdaptiveMessageCard($card);
    }

    function makeTextPayload($text)
    {
        $card = [
            '$schema' => "http://adaptivecards.io/schemas/adaptive-card.json",
            "type" => "AdaptiveCard",
            "version" => "1.2",
            "body" =>
                [
                    $this->makeTextBlock($text),
                ]
        ];
        return $this->makeAdaptiveMessageCard($card);
    }

    function makeMultilineTextPayload($textArray)
    {
        $lines = [];
        foreach($textArray as $text){
            $lines [] = $this->makeTextBlock($text);
        }
        $card = [
            '$schema' => "http://adaptivecards.io/schemas/adaptive-card.json",
            "type" => "AdaptiveCard",
            "version" => "1.2",
            "body" => $lines
        ];
        return $this->makeAdaptiveMessageCard($card);
    }

    function makeAdaptiveMessageCard($cardArray){
        return [
            "type" => "message",
            "attachments" => [
                [
                    "contentType" => "application/vnd.microsoft.card.adaptive",
                    "contentUrl" => null,
                    "content" => $cardArray
                ]
            ]
        ];
    }

    private function makeTextBlock($text){
        return [
            "type" => "TextBlock",
            "wrap" => true,
            "text" => $text
        ];
    }

    private function makeTableColumnsWidth($array){
        $result = [];
        foreach($array as $item){
            $result [] = ["width" => $item];
        }
        return $result;
    }

    private function makeTableTextCell($text){
        return [
            "type" => "TableCell",
            "items" => [
                [
                    "type" => "TextBlock",
                    "text" => $text,
                    "wrap" => true,
                ]
            ]
        ];
    }

    private function makeTableTextRow($array){
        $cells = [];
        foreach($array as $item){
            $cells [] = $this->makeTableTextCell($item);
        }
        return [
            "type" => "TableRow",
            "cells" => $cells,
        ];
    }

}