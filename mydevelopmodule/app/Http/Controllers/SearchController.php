<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Bulkly\User;
use Bulkly\Plan;
use Bulkly\SocialPostGroups;
use Bulkly\SocialAccounts;
use Bulkly\BufferPosting;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use DB;
use App\Http\Controllers\Input;

class SearchController extends Controller
{

   public function getSearchData(Request $request){
      
      $search = $request->get('search');

  
      $posts = DB::table('buffer_postings')
              ->join('social_post_groups', 'buffer_postings.group_id', '=','social_post_groups.id')
              ->join('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
              ->select('buffer_postings.*', 'social_post_groups.*', 'social_accounts.avatar')->where('social_post_groups.name', 'LIKE','%'.$search.'%')->paginate(12);

    
       $groups = SocialPostGroups::distinct()->get(['type']);
       
       //print_r($posts);
      return view('pages.historybyname')->withBposts($posts)->withGroups($groups)->withSquery($search);

   }

   public function getSearchDataByGroup(Request $request){

        $searchst = $request->get('document_type'); 

        /*$posts = DB::table('buffer_postings')->join('social_post_groups', function($join)
                {   
                  
                    $join->on('buffer_postings.group_id', '=', 'social_post_groups.id');
                         

                })->where('social_post_groups.type', '=', $searchst)->paginate(12);*/

      $posts = DB::table('buffer_postings')
              ->join('social_post_groups', 'buffer_postings.group_id', '=','social_post_groups.id')
              ->join('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
              ->select('buffer_postings.*', 'social_post_groups.*', 'social_accounts.avatar')->where('social_post_groups.type', '=', $searchst)->paginate(12);

    
       $groups = SocialPostGroups::distinct()->get(['type']);

       return view('pages.historybygroup')->withBposts($posts)->withGroups($groups)->withSquery($searchst);

    
   } 

   public function getSearchDataByDate(Request $request){
      
    $search = $request->get('datesearch');
    $groups = SocialPostGroups::distinct()->get(['type']);
    $posts = BufferPosting::whereDate('created_at', '=', $search) 
                  ->orderBy('id','desc')
                  ->paginate(12);

     return view('pages.historybydate')->withBposts($posts)->withGroups($groups)->withSquery($search);


   }
    
}