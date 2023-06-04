<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CoMovies</title>
		@vite
	</head>
	<body class="bg-[#0a5070]">
		@inertia
	</body>
</html>

<style>
    html, body {
        height: 100%
    }
</style>
