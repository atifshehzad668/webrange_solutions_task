<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotes — Scraped from quotes.toscrape.com</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0f0f1a;
            color: #e2e2f0;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #1a1a3e 0%, #12122b 100%);
            border-bottom: 1px solid rgba(139, 92, 246, 0.3);
            padding: 2rem 1rem;
            text-align: center;
        }

        header h1 {
            font-family: 'Lora', serif;
            font-size: 2.4rem;
            background: linear-gradient(90deg, #a78bfa, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.4rem;
        }

        header p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .badge {
            display: inline-block;
            margin-top: 0.8rem;
            background: rgba(139, 92, 246, 0.15);
            border: 1px solid rgba(139, 92, 246, 0.4);
            color: #a78bfa;
            border-radius: 50px;
            padding: 0.3rem 1rem;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .controls {
            max-width: 900px;
            margin: 2rem auto 0;
            padding: 0 1rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .controls form {
            display: flex;
            gap: 0.6rem;
            align-items: center;
            background: #1e1e38;
            border: 1px solid rgba(139, 92, 246, 0.25);
            border-radius: 10px;
            padding: 0.6rem 1rem;
        }

        .controls label {
            color: #94a3b8;
            font-size: 0.88rem;
            font-weight: 500;
        }

        .controls select {
            background: #2d2d50;
            color: #e2e2f0;
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 6px;
            padding: 0.35rem 0.7rem;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .controls button {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: #fff;
            border: none;
            border-radius: 7px;
            padding: 0.4rem 1.1rem;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .controls button:hover { opacity: 0.85; }

        .search-box {
            flex: 1;
            min-width: 200px;
            background: #1e1e38;
            border: 1px solid rgba(139, 92, 246, 0.25);
            border-radius: 10px;
            padding: 0.6rem 1rem;
            display: flex;
            gap: 0.6rem;
            align-items: center;
        }

        .search-box input {
            background: transparent;
            border: none;
            outline: none;
            color: #e2e2f0;
            font-size: 0.9rem;
            width: 100%;
        }

        .search-box input::placeholder { color: #555577; }

        main {
            max-width: 900px;
            margin: 2rem auto 4rem;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 1.4rem;
        }

        .quote-card {
            background: linear-gradient(145deg, #1a1a38, #15152e);
            border: 1px solid rgba(139, 92, 246, 0.18);
            border-radius: 16px;
            padding: 1.8rem;
            transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
        }

        .quote-card::before {
            content: '\201C';
            position: absolute;
            top: -10px;
            left: 16px;
            font-size: 6rem;
            color: rgba(139, 92, 246, 0.1);
            font-family: 'Lora', serif;
            line-height: 1;
            pointer-events: none;
        }

        .quote-card:hover {
            transform: translateY(-3px);
            border-color: rgba(139, 92, 246, 0.45);
            box-shadow: 0 8px 30px rgba(124, 58, 237, 0.15);
        }

        .quote-text {
            font-family: 'Lora', serif;
            font-style: italic;
            font-size: 1.05rem;
            line-height: 1.7;
            color: #d4d4f0;
            margin-bottom: 1.2rem;
        }

        .quote-author {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .author-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .author-name {
            font-size: 0.88rem;
            font-weight: 600;
            color: #a78bfa;
        }

        .empty {
            grid-column: 1 / -1;
            text-align: center;
            color: #555577;
            padding: 4rem;
            font-size: 1rem;
        }

        footer {
            text-align: center;
            color: #333355;
            font-size: 0.8rem;
            padding-bottom: 2rem;
        }
    </style>
</head>
<body>

<header>
    <h1>Quotes Explorer</h1>
    <p>Scraped from <strong>quotes.toscrape.com</strong> using PHP cURL + DOMDocument</p>
    <div class="badge">{{ $total }} quotes &nbsp;·&nbsp; {{ $pages }} page(s)</div>
</header>

<div class="controls">
    <form method="GET" action="/quotes">
        <label for="pages">Pages:</label>
        <select name="pages" id="pages">
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}" {{ $pages == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        <button type="submit">Scrape</button>
    </form>

    <div class="search-box">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#555577" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.868-3.833zm-5.242 1.156a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
        </svg>
        <input type="text" id="searchInput" placeholder="Filter quotes by author or text…" oninput="filterQuotes()">
    </div>
</div>

<main id="quotesGrid">
    @forelse ($quotes as $item)
        <div class="quote-card" data-text="{{ strtolower($item['quote']) }}" data-author="{{ strtolower($item['author']) }}">
            <p class="quote-text">{{ $item['quote'] }}</p>
            <div class="quote-author">
                <div class="author-dot">{{ strtoupper(substr($item['author'], 0, 1)) }}</div>
                <span class="author-name">— {{ $item['author'] }}</span>
            </div>
        </div>
    @empty
        <div class="empty">No quotes found. The source site may be unreachable.</div>
    @endforelse
</main>

<footer>Scraped live &nbsp;·&nbsp; Task 3 - Laravel Web Scraping</footer>

<script>
    function filterQuotes() {
        const term = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('.quote-card').forEach(card => {
            const match = card.dataset.text.includes(term) || card.dataset.author.includes(term);
            card.style.display = match ? '' : 'none';
        });
    }
</script>

</body>
</html>
