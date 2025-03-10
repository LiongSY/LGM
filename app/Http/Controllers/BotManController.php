<?php
  
namespace App\Http\Controllers;
  
use App\Conversations\BookingConversation;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Conversations\Conversation;
use MenuConversation;
class BotManController extends Controller
{

    public function handle()
    {
        $botman = resolve('botman');
        $botman->fallback(function($bot) {

            $message = $bot->getMessage();
            $commandsMessage = "Sorry,<br>Please select the option below:<br><br>1. Booking Assistance.<br>2. Chat with agent.";
            $bot->reply($commandsMessage);

        });

  
        $botman->hears('{message}', function($bot,$message) {

            if ($message == 1 ) {
                if(auth()->check() && auth()->user()->role == 'customer'){
                    $bot->startConversation(new BookingConversation());
                }else{
                    return $bot->reply('Please make sure that you are logged in');
                }

            }
            elseif ($message == 2) {
                if(auth()->check() && auth()->user()->role == 'customer'){
                    $userID = auth()->user()->userID;
                    $url = route('chat.show', ['userID' => $userID]);

                    return $bot->reply("<a href='$url' class='btn btn-primary' style='text-decoration: none;'target='_blank'>CHAT WITH AGENT</a>");
                }else{
                    return $bot->reply('Please make sure that you are logged in');
                }
            }elseif (preg_match('/\b(hello*|hi*)\b/i', $message) === 1) {
                $bot->reply('Hello ~<br>Please select the option below:<br><br>1. Booking Assistance.<br>2.Chat with agent.');
            }elseif(strtoupper($message) !== 'EXIT'){
                return $bot->reply('Sorry I don\'t understand '.$message.'.<br>Please choose 1 or 2.');
            }
            

        
       
        });

        $botman->hears('exit', function($bot) {
                $bot->reply('Please select the option below:<br><br>1. Booking Assistance.<br>2. Chat with agent.');
        })->stopsConversation(); 

      
        
  
        $botman->listen();
    }
  
}