<?php

class SearchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function autocomplete()
    {
        $search = User::select('UserID', 'UserProfileID')
            ->whereIn('UserProfileID', function($query)
            {
                $term = Input::get('term');

                $query->select('UserProfileID')
                    ->from((new UserProfile)->getTable())  // Creates a new model to grab the table name
                    ->where('FirstName', 'LIKE', '%'.$term.'%')
                    ->orWhere('Surname', 'LIKE', '%'.$term.'%')
                    ->orWhere('DisplayName', 'LIKE', '%'.$term.'%');
            })
            ->orderBy('UserID')
            ->take(5)
            ->with('userProfile') // Start with lower case to to indicate that it is an added item and no table column.
            ->get();

        $results = array();
        foreach ($search as $row)
        {
            $results[] = ['id' => $row->UserID, 'label' => $row->userProfile->DisplayName, 'actor'=> $row->userProfile->DisplayName];
        }

        return Response::json($results);
    }

    public function searchUser(){
        $term = Input::get('inputName');

        $search = UserProfile::where('DisplayName', '=', $term)->firstOrFail();

        return Redirect::to('/profile/'.$search->ProfileUrlPart);
        //return Response::json($results);
    }
}
