<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Recommendations</title>
</head>
<body>
    <h1>Travel Recommendations</h1>

    @isset($recommendations)
            <h2>Top Recommendations</h2>
            @foreach($recommendations as $index => $recommendation)
                <p>
                    {{ $index + 1 }}. 
                    Package ID: {{ $recommendation['id'] }}, 
                    Name: {{ $recommendation['name'] }}, 
                    Score: {{ $recommendation['score'] }}
                </p>
            @endforeach
        @endisset
</body>
</html>
