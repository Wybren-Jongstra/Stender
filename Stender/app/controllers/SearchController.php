<?php

class SearchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function autocomplete()
    {
        $term = Input::get('term');

        $search = UserProfile::where('FirstName', 'LIKE', '%'.$term.'%')
            ->orWhere('Surname', 'LIKE', '%'.$term.'%')
            ->orWhere('DisplayName', 'LIKE', '%'.$term.'%')
            ->orderBy('UserProfileID')
            ->select('UserProfileID', 'DisplayName')
            ->take(5)
            ->with('user') // Start with lower case to to indicate that it is an added item and no table column.
            ->get();

        $results = array();
        foreach ($search as $row)
        {
            $results[] = ['id' => $row->UserProfileID, 'label' => $row->DisplayName, 'photo'=> $row->PhotoUrl];
        }

        return Response::json($results);
    }

    /**
     * Search for an user
     * @return requested profile view
     */
    public function searchUser(){
        $term = Input::get('inputName');

        $search = UserProfile::where('DisplayName', '=', $term)->firstOrFail();

        return Redirect::to('/profile/'.$search['ProfileUrlPart']);
    }
}
