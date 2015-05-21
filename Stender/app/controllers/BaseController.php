<?php

class BaseController extends Controller {
	public static $timestamps = false;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    // HOME PAGE
    public function getIndex()
    {
        if (Auth::check())
        {
            return View::make('timeline');
        }
        else
        {
            return View::make('home');
        }
    }

}
