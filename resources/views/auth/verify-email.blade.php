<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 max-w-md w-full text-center">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Email Verification</h2>
        <p class="mb-2 text-gray-600 dark:text-gray-300 font-semibold">
            Hi, your verification link has been sent to your email.<br>
        </p>
        <p class="mb-6 text-gray-600 dark:text-gray-300">
            If you didn't receive the email, please check your spam folder or click the button below to resend the verification link.
        </p>
        @if (session('message'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('message') }}
            </div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded transition duration-150">
                Resend Verification Link
            </button>
        </form>
    </div>
</body>