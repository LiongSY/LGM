<?php
  
namespace App\Http\Controllers;
  
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
  
class BotManController extends Controller
{

    public function handle()
    {
        $botman = app('botman');
        $botman->fallback(function($bot) {

            $message = $bot->getMessage();
            $commandsMessage = "Sorry,<br>Please select the option below:<br><br>1. Booking Assistance.<br>2. Destination Information.<br>3. Feedback and Reviews.<br>4. Chat with agent.";
            $bot->reply($commandsMessage);

        });

  
        $botman->hears('{message}', function($bot,$message) {
  
            if ($message == 1 ) {
                 $this->booking($bot);
            }elseif ($message == 2) {
                $this->destination($bot);            
            }elseif ($message == 3) {
                $this->feedback($bot);
            }elseif ($message == 4) {
                $this->chatAgent($bot);
            }else{
                $this->repeat()
            }

            if(preg_match('/\b(hello*|hi*)\b/i', $message) === 1) {

                $bot->reply('Hello ~<br>Please select the option below:<br><br>1. Booking Assistance.<br>2. Destination Information.<br>3. Feedback and Reviews.<br>4. Chat with agent.');

            }
       
        });
  
        $botman->listen();
    }
  

    public function booking($bot)
    {
        $bot->ask('Sure, which package you want to book? ', function(Answer $answer) {
  
            $tourCode = $answer->getText();
  
            $this->say('Nice to meet you '.$tourCode);
        });
    }
}