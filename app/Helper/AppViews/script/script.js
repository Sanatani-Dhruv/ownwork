let stackTraceBlock = document.getElementsByClassName('stackTraceBlock');

function isDescendant(parent, child) {
     var node = child.parentNode;
     while (node != null) {
         if (node == parent) {
             return true;
         }
         node = node.parentNode;
     }
     return false;
}


for (let block of stackTraceBlock) {
	block.addEventListener('click', (event) => {
		let classList = event.target.classList;
		let fileNameBlock = block.getElementsByClassName('fileNameBlock')[0];
		let contents = block.getElementsByClassName('file_content')[0];
        console.log(event.target)
		if (isDescendant(fileNameBlock, event.target) || event.target === fileNameBlock) {
		// if (event.target.classList.contains('fileNameBlock')) {
			contents.classList.toggle('hidden')
		}
	})
}
