<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="{{ asset('images/LGM.png') }}">
    <title>LGM Tour & Travel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- JavaScript -->
  <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- End JavaScript -->

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
  <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />

  <!-- End CSS -->

</head>

<body style="background-color:#1F4E7A">
<div class="chat">

    <div class="top">
        @if(auth()->user()->role == 'customer')
        <img src="{{ asset('images/804949.png') }}" style="width:50px" alt="Avatar">
        @else
        @php
                $sender = \App\Models\User::where('userID', $user->userID)->first();

                @endphp
            @if($sender->gender == 'Male')
            <img src="{{ asset('images/804951.png') }}" style="width:50px" alt="Avatar">
            @else
            <img src="{{ asset('images/403023.png') }}" style="width:50px" alt="Avatar">
            @endif
        @endif
        <div>
            @if(auth()->user()->role == 'customer')
            <p>Live Agent</p>
            @else
            <p>{{$user->name}}</p>
            @endif

        </div>
    </div>
    <!-- End Header -->

    <!-- Display Messages -->
    <div class="messages">
    @php
    $conversation = \App\Models\Conversation::where('userID', $user->userID)->first();
    $conversationID = 0;

    if ($conversation === null || $conversation->userID === null) {
        $conversationID = 0;
    } else {
        $conversationID = $conversation->userID;
        $messages = \App\Models\Message::where('userID', $conversation->userID)->get();
    }
    @endphp
        @if (!$conversation)
            @if(auth()->user()->role == 'customer')
            @include('receive', ['message' => 'Hi, How can I help you'])
            @else
            @include('broadcast', ['message' => 'Hi, How can I help you'])
            @endif
        @else
            @foreach ($messages as $message)
                @if ($message->userID == auth()->user()->userID)
                  @if ($message->sender == auth()->user()->userID)
                    @include('broadcast', ['message' => $message->message, 'position' => 'right'])
                  @else
                      @include('receive', ['message' => $message->message, 'position' => 'left'])

                  @endif
                @else
                @if ($message->sender == 'staff')
                    @include('broadcast', ['message' => $message->message, 'position' => 'right'])
                  @else
                      @include('receive', ['message' => $message->message, 'position' => 'left'])

                  @endif
                @endif
            @endforeach
        @endif
    </div>
    <!-- End Display Messages -->

    <!-- Footer -->
    <div class="bottom">
        <form id="chat-form">
        @csrf

            <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off" style="float:left">
            <button type="submit" class="btn btn-secondary"style="float:right; margin:0px"></btton>
        </form>
    </div>
    <!-- End Footer -->
</div>
<div class="container">
@if(auth()->user()->role != 'customer')

<a href="{{route('dashboard')}}" style="float:right"class="btn btn-light border text-black-50 shadow-none">Back</a> 

@endif
</div>

</body>

<script>
  const pusher  = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
  const channel = pusher.subscribe('public');

  channel.bind('chat', function (data) {
    console.log("Received data:", data);
    $.post("/receive", {
        _token: '{{csrf_token()}}',
        message: data.message,
    }).done(function (res) {
      $(".messages > .message").last().after(res);
        $(document).scrollTop($(document).height());
    }).fail(function (error) {
        console.error("Error in receiving message:", error);
    });
});


  //Broadcast messages
  $("#chat-form").submit(function (event) {
    event.preventDefault();

    $.ajax({
        url: "/broadcast",
        method: 'POST',
        headers: {
            'X-Socket-Id': pusher.connection.socket_id
        },
        data: {
            _token: '{{csrf_token()}}',
            message: $("#message").val(),
            conversationID: '{{$conversationID}}',

        }
    }).done(function (res) {
      $(".messages > .message").last().append(res);
        $("#message").val('');
        $(document).scrollTop($(document).height());
    }).fail(function (error) {
        console.error("Error in broadcasting message:", error);
    });
});
</script>
</html>