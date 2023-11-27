@php
    $position = 'right';  // or 'left' depending on your logic
@endphp
<div class="{{ $position ?? '' }} message">
    <p>{{ $message }}</p>
    <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Profile picture">
</div>
