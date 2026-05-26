<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image to Text Program</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Image to Text Program</h1>

        <input type="file" id="imageInput" accept="image/*" class="mb-4">

        <button id="extractButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Extract Text
        </button>

        <textarea id="outputTextarea" class="w-full h-40 mt-4 p-2 bg-white border border-gray-300 rounded"></textarea>

        <button id="copyButton" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
            Copy to Clipboard
        </button>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js'></script>

    <script>
        const imageInput = document.getElementById('imageInput');
        const extractButton = document.getElementById('extractButton');
        const outputTextarea = document.getElementById('outputTextarea');
        const copyButton = document.getElementById('copyButton');

        extractButton.addEventListener('click', () => {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                    const img = new Image();
                    img.src = reader.result;
                    img.onload = () => {
                        Tesseract.recognize(img)
                            .then(({ data: { text } }) => {
                                outputTextarea.value = text;
                            })
                            .catch((error) => {
                                console.error('Error:', error);
                            });
                    };
                };
                reader.readAsDataURL(file);
            }
        });

        copyButton.addEventListener('click', () => {
            outputTextarea.select();
            document.execCommand('copy');
            alert('Text copied to clipboard!');
        });
    </script>
</body>

</html>