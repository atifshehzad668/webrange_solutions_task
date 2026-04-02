<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTTP Request — Custom Headers Demo</title>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0d0d1a;
            color: #e2e2f0;
            min-height: 100vh;
            padding: 2rem 1rem 4rem;
        }

        .container { max-width: 820px; margin: 0 auto; }

        header { margin-bottom: 2rem; }

        header h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(90deg, #34d399, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.3rem;
        }

        header p { color: #64748b; font-size: 0.9rem; }

        .controls {
            display: flex;
            gap: 0.8rem;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .controls form {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: #1a1a2e;
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 10px;
            padding: 0.6rem 1rem;
        }

        .controls label { color: #94a3b8; font-size: 0.85rem; }

        .controls select {
            background: #252545;
            color: #e2e2f0;
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 6px;
            padding: 0.3rem 0.6rem;
            font-size: 0.88rem;
            cursor: pointer;
        }

        .controls button {
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.45rem 1.2rem;
            font-weight: 600;
            font-size: 0.88rem;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .controls button:hover { opacity: 0.85; }

        .status-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.9rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .chip-green { background: rgba(52,211,153,0.12); border: 1px solid rgba(52,211,153,0.35); color: #34d399; }
        .chip-red   { background: rgba(248,113,113,0.12); border: 1px solid rgba(248,113,113,0.35); color: #f87171; }
        .chip-blue  { background: rgba(96,165,250,0.12);  border: 1px solid rgba(96,165,250,0.35);  color: #60a5fa; }
        .chip-gray  { background: rgba(148,163,184,0.1);  border: 1px solid rgba(148,163,184,0.25); color: #94a3b8; }

        .panel {
            background: #13132b;
            border: 1px solid rgba(99,102,241,0.2);
            border-radius: 14px;
            margin-bottom: 1.2rem;
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.2rem;
            background: rgba(99,102,241,0.08);
            border-bottom: 1px solid rgba(99,102,241,0.2);
        }

        .panel-title {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #818cf8;
        }

        .panel-body { padding: 1.2rem; }

        table { width: 100%; border-collapse: collapse; font-size: 0.88rem; }

        td { padding: 0.5rem 0.7rem; border-bottom: 1px solid rgba(255,255,255,0.05); vertical-align: top; }
        td:first-child { color: #94a3b8; white-space: nowrap; width: 200px; font-weight: 500; }
        td:last-child { font-family: 'JetBrains Mono', monospace; color: #c7d2fe; word-break: break-all; }

        .code-block {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            background: #0a0a1a;
            border: 1px solid rgba(99,102,241,0.15);
            border-radius: 8px;
            padding: 1.2rem;
            overflow-x: auto;
            line-height: 1.7;
            color: #a5f3fc;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
        .dot-green { background: #34d399; box-shadow: 0 0 6px #34d399; }
        .dot-red   { background: #f87171; box-shadow: 0 0 6px #f87171; }
    </style>
</head>
<body>
<div class="container">

    <header>
        <h1>⚡ HTTP Request — Custom Headers</h1>
        <p>Fetching from <strong>{{ $result['url'] }}</strong> using Laravel HTTP Client</p>
    </header>

    <div class="controls">
        <form method="GET" action="/http-request">
            <label for="retries">Max Retries:</label>
            <select name="retries" id="retries">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $retries == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <button type="submit">Send Request ✓</button>
        </form>

        <form method="GET" action="/http-request">
            <input type="hidden" name="fail" value="1">
            <label for="retries_fail">Retries (Fail Demo):</label>
            <select name="retries" id="retries_fail">
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $retries == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <button type="submit" style="background: linear-gradient(135deg,#dc2626,#b45309);">Force Fail ✗</button>
        </form>
    </div>

    <div class="status-bar">
        <span class="chip {{ $result['success'] ? 'chip-green' : 'chip-red' }}">
            <span class="dot {{ $result['success'] ? 'dot-green' : 'dot-red' }}"></span>
            {{ $result['success'] ? 'Success' : 'Failed' }}
        </span>
        <span class="chip chip-blue">HTTP {{ $result['status'] ?? 'N/A' }}</span>
        <span class="chip chip-gray">{{ $result['attempts'] }} attempt(s) used</span>
        <span class="chip chip-gray">Retry limit: {{ $retries }}</span>
    </div>

    <div class="panel">
        <div class="panel-header"><span class="panel-title">Custom Headers Sent</span></div>
        <div class="panel-body">
            <table>
                @foreach ($result['headers'] as $key => $value)
                    <tr><td>{{ $key }}</td><td>{{ $value }}</td></tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><span class="panel-title">Request Info</span></div>
        <div class="panel-body">
            <table>
                <tr><td>URL</td><td>{{ $result['url'] }}</td></tr>
                <tr><td>HTTP Status</td><td>{{ $result['status'] ?? 'N/A' }}</td></tr>
                <tr><td>Attempts Used</td><td>{{ $result['attempts'] }} / {{ $retries }}</td></tr>
                <tr><td>Result</td><td>{{ $result['success'] ? 'OK' : 'Error — ' . ($result['error'] ?? 'Unknown') }}</td></tr>
            </table>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><span class="panel-title">API Response</span></div>
        <div class="panel-body">
            @if ($result['success'])
                <div class="code-block">{{ json_encode($result['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</div>
            @else
                <div class="code-block" style="color:#f87171;">{{ $result['error'] ?? 'No response received.' }}</div>
            @endif
        </div>
    </div>

</div>
</body>
</html>
