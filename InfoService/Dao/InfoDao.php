<?php

namespace src\OrderService;


class InfoDao
{
    public function addErrorReport($message, $type)
    {
        $report = new ErrorReport();
        $report->message = $message;
        $report->type = $type;

        $report->save();

        return $report;
    }
}
