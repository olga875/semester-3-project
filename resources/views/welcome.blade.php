<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>WeeDesk</title>
  <style>
    body{font-family:Arial; max-width:480px; margin:40px auto; padding:10px}
    input,button{padding:8px;margin:4px}
  </style>
</head>
<body>
  <h2>WeeDesk</h2>
  <form method="POST" action="{{ route('desk.update') }}">
    @csrf
    <label>Height (mm):
      <input type="number" name="height" value="{{ $height ?? 750 }}" min="500" max="1300">
    </label>
    <button type="submit">Send</button>
  </form>

  <form method="POST" action="{{route('desk.save')}}">
    @csrf
    <label>Sitting Height (mm):
      <input type="number" name="sitting_height" value="{{ $sitting_height ?? 720 }}" min="500" max="1300">
    </label>

    <label>Standing Height (mm):
      <input type="number" name="standing_height" value="{{ $standing_height ?? 1000 }}" min="500" max="1300">
    </label>
    <button type="submit">Save</button>
  </form>

  @isset($apiResponse)
    <h3>Response</h3>
    <pre>{{ $apiResponse }}</pre>
  @endisset
</body>
</html>