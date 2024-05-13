<?php

namespace src\InfoService\controllers\impl;


use src\OrderService\controllers\InfoController;

class InfoServiceControllerImpl extends InfoController
{
    protected $infoDao;

    public function __construct(InfoDao $infoDao)
    {
        $this->infoDao = $infoDao;
    }

    public function addErrorReport(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'type' => 'required',
        ]);

        try {
            $report = $this->infoDao->addErrorReport(
                $request->message,
                $request->type
            );

            return response()->json(['message' => 'Error report added successfully', 'report_id' => $report->id]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
