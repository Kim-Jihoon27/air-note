<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jirrum Laravel Starter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">
                Jirrum Laravel Starter
            </h1>
            
            <div class="prose prose-lg">
                <p class="text-gray-700 text-center mb-8">
                    A modern Laravel starter pack powered by System Intelligence
                </p>

                <div class="grid md:grid-cols-2 gap-6 mt-8">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h2 class="text-xl font-semibold text-blue-800 mb-2">Features</h2>
                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                            <li>Laravel 11+ ready</li>
                            <li>Tailwind CSS integration</li>
                            <li>Vite build tool</li>
                            <li>Modern PHP practices</li>
                        </ul>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg">
                        <h2 class="text-xl font-semibold text-green-800 mb-2">Getting Started</h2>
                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                            <li>Configure your .env file</li>
                            <li>Run migrations</li>
                            <li>Start development server</li>
                            <li>Build your amazing app!</li>
                        </ul>
                    </div>
                </div>

                <div class="text-center mt-8 pt-8 border-t border-gray-200">
                    <p class="text-gray-500">
                        Built with ❤️ using Laravel & Tailwind CSS
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
