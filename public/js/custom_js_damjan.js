// getElementById
function $id(id) {
	return document.getElementById(id);
}


// call initialization file
if (window.File && window.FileList && window.FileReader) {
	Init("fileselect", "filedrag");
	Init("fileselect_intro", "filedrag_intro");
}

// initialize
function Init(fileselect, filedrag) {

	var fileselect = $id(fileselect),
		filedrag = $id(filedrag);


	// file select
	fileselect.addEventListener("change", FileSelectHandler, false);

	// is XHR2 available?
	var xhr = new XMLHttpRequest();
	if (xhr.upload) {
	
		// file drop
		filedrag.addEventListener("dragover", FileDragHover, false);
		filedrag.addEventListener("dragleave", FileDragHover, false);
		filedrag.addEventListener("drop", FileSelectHandler, false);
		filedrag.style.display = "block";
		
		// remove submit button
		//submitbutton.style.display = "none";
	}

}

// file drag hover
function FileDragHover(e) {
	e.stopPropagation();
	e.preventDefault();
	e.target.className = (e.type == "dragover" ? "hover" : "");
}

// file selection
function FileSelectHandler(e) {

    elementThatFiredEvent = event.target.id;
	// cancel event and hover styling
	FileDragHover(e);

	// fetch FileList object
	var files = e.target.files || e.dataTransfer.files;

	// process all File objects
	for (var i = 0, f; f = files[i]; i++) {
		ParseFile(f, elementThatFiredEvent);
	}

}

function ParseFile(file, elementThatFiredEvent) {

	Output(
        file.name, elementThatFiredEvent
		// "<p>File information: <strong>" + file.name +
		// "</strong> type: <strong>" + file.type +
		// "</strong> size: <strong>" + file.size +
		// "</strong> bytes</p>"
	);
	
}

// output information
function Output(msg, elementThatFiredEvent) {
    if (elementThatFiredEvent == "fileselect" || elementThatFiredEvent == "filedrag"){
        var m = $id("filename");
        m.setAttribute("placeholder", msg);
    }
    else{
        var m = $id("filename_intro");
        m.setAttribute("placeholder", msg);
    }
}
