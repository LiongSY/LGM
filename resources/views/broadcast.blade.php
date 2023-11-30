@php
    $position = 'right';  // or 
@endphp
<div class="{{ $position ?? '' }} message">
    <p>{{ $message }}</p>

</div>
