<!DOCTYPE html>
<html>
<head>
    <title>LLM Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>LLM Example</h1>
    <button id="llmButton" type="button">Get LLM Response</button>
    <pre id="output"></pre>

    <script>
        document.getElementById('llmButton').addEventListener('click', async function() {
            try {
                const response = await fetch('http://127.0.0.1:8000/llm', {
                    method: 'GET'
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }

                const data = await response.json();
                document.getElementById('output').textContent = JSON.stringify(data, null, 2);
            } catch (error) {
                document.getElementById('output').textContent = 'Error: ' + error.message;
            }
        });
    </script>
</body>
</html>
