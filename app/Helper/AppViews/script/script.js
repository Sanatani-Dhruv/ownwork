let stackTraceBlock = document.getElementsByClassName('stackTraceBlock');

for (let block of stackTraceBlock) {
	block.addEventListener('click', (event) => {
		let classList = event.target.classList;
		if (classList.contains('collapseSvgBlock')) {
			let contents = block.getElementsByClassName('file_content')[0];
			contents.classList.toggle('hidden')
		}
	})
}
