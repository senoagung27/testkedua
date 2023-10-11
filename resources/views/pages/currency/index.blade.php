<!DOCTYPE html>
<html>
<head>
    <title>Kurs Scraper</title>
</head>
<body>
    <button onclick="scrapeAndSave()">Scrape and Save</button>

    <script>
        function scrapeAndSave() {
            fetch('/scrape-and-save')
                .then(response => response.text())
                .then(message => alert(message));
        }
    </script>
</body>
</html>