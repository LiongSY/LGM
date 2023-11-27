<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chat Laravel Pusher | Edlin App</title>
  <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- JavaScript -->
  <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- End JavaScript -->

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">

  <!-- End CSS -->

</head>

<body>
<div class="chat">
    <!-- Header -->
    <div class="top">
        <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
        <div>
            <p>Live Chat</p>
        </div>
    </div>
    <!-- End Header -->

    <!-- Display Messages -->
    <div class="messages">
        @if ($messages->isEmpty())
        
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
                      @include('broadcast', ['message' => $message->message, 'position' => 'left'])

                  @endif
                @else
                    @include('receive', ['message' => $message->message, 'position' => 'left'])
                @endif
            @endforeach
        @endif
    </div>
    <!-- End Display Messages -->

    <!-- Footer -->
    <div class="bottom">
        <form id="chat-form">
        @csrf

            <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
            <button type="submit"></button>
        </form>
    </div>
    <!-- End Footer -->
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