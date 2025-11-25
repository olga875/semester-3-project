<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Personal Preferences: Cycle customization</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/preferences.css') }}">
</head>
<body class="preferences-page">

    @if (session('status'))
      <div id="msg" style="background:#6b4a7c;color:#fff;padding:10px 16px;text-align:center;border-radius:8px;margin:10px auto;max-width:600px;">
        {{ session('status') }}
      </div>
      <script>setTimeout(()=>document.getElementById('msg')?.remove(),2000)</script>
    @endif

    <header class="top-bar">
        <h1 class="page-title">Personal Preferences: Cycle customization</h1>
        <div style="display:flex; gap:10px;">
            <a href="{{ url('/') }}" class="btn btn-ghost">Back to Dashboard</a>
        </div>
    </header>

    <main class="grid">
        <section class="panel panel-left">
            <h2 class="panel-title">Custom</h2>

            <form method="POST" action="{{ route('preferences.customize.save') }}" class="custom-form">
                @csrf
                <div class="field">
                    <label for="sit_minutes">Sitting</label>
                    <div class="input-with-unit">
                        <input id="sit_minutes" name="sit_minutes" type="number" min="1" max="300"
                               value="{{ old('sit_minutes', $existing['sit_minutes']) }}" required />
                        <span class="unit">min</span>
                    </div>
                </div>

                <div class="field">
                    <label for="stand_minutes">Standing</label>
                    <div class="input-with-unit">
                        <input id="stand_minutes" name="stand_minutes" type="number" min="1" max="300"
                               value="{{ old('stand_minutes', $existing['stand_minutes']) }}" required />
                        <span class="unit">min</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary wide">Save Custom</button>
            </form>

            <div class="apply-row" style="display:flex;justify-content:space-between;gap:12px;margin-top:20px;">
                <a href="{{ url('/') }}" class="btn btn-ghost" style="flex:1;text-align:center;">Back to Dashboard</a>
                <button onclick="window.location.href='{{ url('/') }}'" class="btn btn-primary" style="flex:1;">Apply</button>
            </div>
        </section>

        <section class="panel panel-right">
            <div class="preset">
                <div class="preset-info">
                    <h3>High Focus Mode</h3>
                    <p>Sitting = 50 mins<br>Standing = 10 mins</p>
                </div>
                <form method="POST" action="{{ route('preferences.customize.preset', 'focus') }}">
                    @csrf
                    <button class="btn btn-secondary">Select</button>
                </form>
            </div>

            <div class="preset">
                <div class="preset-info">
                    <h3>Balanced mode</h3>
                    <p>Sitting = 40 mins<br>Standing = 20 mins</p>
                </div>
                <form method="POST" action="{{ route('preferences.customize.preset', 'balanced') }}">
                    @csrf
                    <button class="btn btn-secondary">Select</button>
                </form>
            </div>

            <div class="preset">
                <div class="preset-info">
                    <h3>Active Mode</h3>
                    <p>Sitting = 30 mins<br>Standing = 30 mins</p>
                </div>
                <form method="POST" action="{{ route('preferences.customize.preset', 'active') }}">
                    @csrf
                    <button class="btn btn-secondary">Select</button>
                </form>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/preferences.js') }}"></script>
</body>
</html>