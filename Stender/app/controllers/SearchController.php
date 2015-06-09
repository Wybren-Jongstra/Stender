<?php

class SearchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function autocomplete(){
        $term = Input::get('term');

        $search = UserProfile::where('FirstName', 'LIKE', '%'.$term.'%')
            ->orWhere('Surname', 'LIKE', '%'.$term.'%')
            ->orWhere('DisplayName', 'LIKE', '%'.$term.'%')
            ->take(5)
            ->get();

        $results = array();
        foreach ($search as $query)
        {
            $search2 = User::where('UserProfileId', '=', $query->UserProfileID)->get();
            foreach ($search2 as $finish)
            {
                $results[] = [ 'id' => $finish->UserID, 'label' => $query->DisplayName, 'actor'=> $query->DisplayName];
            }
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
