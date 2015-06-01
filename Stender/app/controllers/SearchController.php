<?php

class SearchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function autocomplete(){
        $term = Input::get('term');

        $search = UserProfile::where('FirstName', 'LIKE', '%'.$term.'%')->orWhere('Surname', 'LIKE', '%'.$term.'%')->take(5)->get();

        $results = array();

        // $queries = DB::table('USER_PROFILE')
        //     ->where('FirstName', 'LIKE', '%'.$term.'%')
        //     ->orWhere('Surname', 'LIKE', '%'.$term.'%')
        //     ->take(5)->get();

        foreach ($search as $query)
        {
            
            $search2 = User::where('UserProfileId', '=', $query->UserProfileID)->get();
            foreach ($search2 as $finish) {
            
            $results[] = [ 'id' => $finish->UserID, 'label' =>$query->FirstName, 'actor'=> $query->Surname];
            
            }
            
        }
        
        
        return Response::json($results);
    }

    public function searchUser(){
        $term = Input::get('userName');

        $search = UserProfile::where('FirstName', 'LIKE', '%'.$term.'%')->orWhere('Surname', 'LIKE', '%'.$term.'%')->get();
        $results = array();

        // $queries = DB::table('USER_PROFILE')
        //     ->where('FirstName', 'LIKE', '%'.$term.'%')
        //     ->orWhere('Surname', 'LIKE', '%'.$term.'%')
        //     ->->get();

        foreach ($search as $query)
        {
            $results[] = [ 'id' => $query->UserID, 'value' => $query->FirstName.' '.$query->Surname, 'url' => $query->ProfileUrlPart ];
        }
        return Response::json($results);
    }
}
