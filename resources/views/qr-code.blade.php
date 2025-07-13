<!DOCTYPE html>
<html>

<head>
    <title>QR Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="p-8">
    <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-4">Mon QR Code</h1>
        <div class="bg-white p-4 rounded-lg shadow">
            {!! $qrCode !!}
        </div>
        <p class="mt-4 text-gray-600">Scannez ce QR code pour accéder au site</p>
    </div>
</body>

</html>
