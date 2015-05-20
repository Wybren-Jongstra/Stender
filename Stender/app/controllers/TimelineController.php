<?php

class TimelineController extends BaseController {

    public function getTimeline()
    {
        return View::make('timeline');
    }
}

?>