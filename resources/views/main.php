<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1.0"/>
		<title><?=htmlspecialchars(getenv("APP_NAME") . " App")?></title>
		<?php if(file_exists(approot() . "/public/build/output.css")): ?>
			<style>
				<?php include(approot() . "/public/build/output.css"); ?>
			</style>
		<?php endif; ?>
	</head>
	<body style="" class="flex flex-col items-center justify-center pt-10 md:pt-15 bg-cyan-500/100 h-[75dvh]">
		<h1 class="font-normal underline text-7xl md:text-[12dvw]">OwnWork!</h1>
		<p class="mt-3 font-medium font-mono text-sm md:text-[2.4dvw]">Minimal PHP Framework for an MVC Project</p>
		<p class="mt-8 hover:underline text-sm md:text-[1.2dvw]" style="">
			<a href="https://github.com/Sanatani-Dhruv/ownwork" target="__blank">
				<button class="transition border-3 font-semibold border border-black/100 p-3 pl-6 pr-6 cursor-pointer hover:rounded hover:bg-black/100 hover:text-cyan-500/100 whitespace-nowrap">View Source</button>
			</a>
		</p>
	</body>
</html>
