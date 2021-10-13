<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Models\Issue;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Mail\MailForm;
use Illuminate\Support\Facades\Mail;
use App\Mail\issueSubmittedMail;
use App\Mail\issueEditCustomer;
use App\Mail\issueEditAdmin;


class IssueController extends Controller
{
   //List of issues
   public function issuesList()
   {
      if(!Auth::check())//check if the user is logged in
      {
         return redirect('/login');
      }
      else//if user is logged in get his role
      {
         $loggedUser = Auth::user();
         $userId = $loggedUser->id;
         $role = User::getRole($userId);
      }

      if($role =='admin')//if the user is an admin return all the issues in the DB
      {
         $issues = DB::table('issues')
         ->select('issues.*','users.name')
         ->join('users','users.id','=','issues.user_id')
         ->get();
   
      }
      else// if the user is a customer return only the issues he created
      {
         $issues = DB::table('issues')
         ->select('issues.*','users.name')
         ->join('users','users.id','=','issues.user_id')
         ->where('users.id','=',$userId)
         ->get();
      }

      return view('list',['issues'=>$issues , 'role'=>$role]);
   }

   //Issue Edited
   public function editIssue($id, Request $req)
   {
      $issue = Issue::find($id);//find the issue that needs to be edited
      $issue->title = $req->title;
      $issue->description = $req->description;
      $issue->status = $req->status;

      $loggedUser = Auth::user();
      $userId = $loggedUser->id;
      $role = User::getRole($userId);//get role of the user

      //if the user is a customer an email will be sent to all admins them inform them that an issue has been changed to closed 
      if ($issue->isDirty('status') && $role == 'customer')
      {
         $allAdmins = User::getAllAdmin();//get all the admins in the DB

         foreach($allAdmins as $admin)
         {
            Mail::to($admin->email)->send(new issueEditCustomer($loggedUser->name, $issue->title));//email sent
         }
      }

      //if the user is  an admin an email will be sent to the customer to inform him that the issue has modified 
      if ($issue->isDirty('status') && $role == 'admin')
      {
         //find the email of the customer
         $customer = User::where('id','=',$issue->user_id)->first();

         Mail::to($customer->email)->send(new issueEditAdmin($customer->name,$loggedUser->name, $issue->title, $issue->status));//email sent
      }

      $issue->save();

      return redirect('/list');

   }

   //Issue Submitted
   public function addIssue(Request $req)
   {

      $loggedUser = Auth::user();
      $issue = new Issue;
      $issue->title = $req->title;
      $issue->description = $req->description;
      $issue->user_id = $loggedUser->id;
    
      $issue->save();

      //if the user a customer an email will be sent to him to inform him that the issue has been created
      Mail::to($loggedUser->email)->send(new issueSubmittedMail($loggedUser->name, $issue->title));

      return redirect('/list');
   }

   //Issue Deleted
   public function deleteIssue($id)
   {
      $issue = Issue::find($id);
      $issue->delete();

      return redirect('/list');
   }

}
