<?php

class SearchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function autocomplete(){
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('USER_PROFILE')
            ->where('FirstName', 'LIKE', '%'.$term.'%')
            ->orWhere('Surname', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->UserID, 'value' => $query->FirstName.' '.$query->Surname ];
        }
        return Response::json($results);
    }

    public function searchUser(){
        $term = Input::get('userName');

        $results = array();

        $queries = DB::table('USER_PROFILE')
            ->where('FirstName', 'LIKE', '%'.$term.'%')
            ->orWhere('Surname', 'LIKE', '%'.$term.'%')
            ->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->UserID, 'value' => $query->FirstName.' '.$query->Surname ];
        }
        return Response::json($results);
    }
}
