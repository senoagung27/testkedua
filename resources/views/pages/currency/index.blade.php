<!DOCTYPE html>
<html>
<head>
    <title>Dollar Scraper</title>
</head>
<body>
    <h1>Dollar Scraper</h1>

    @if (Redis::get('scrape-job-status'))
        <p>{{ Redis::get('scrape-job-status') }}</p>
        {{ Redis::del('scrape-job-status') }}
    @endif

    @if (Redis::get('clear-data-job-status'))
        <p>{{ Redis::get('clear-data-job-status') }}</p>
        {{ Redis::del('clear-data-job-status') }}
    @endif

    <form method="POST" action="{{ route('dollar-scraper.run-scrape-job') }}">
        @csrf
        <button type="submit">Scrape Data</button>
    </form>

    <form method="POST" action="{{ route('dollar-scraper.clear-data') }}">
        @csrf
        <button type="submit">Clear Data</button>
    </form>
</body>
</html>
