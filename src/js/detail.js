function openFile()
{
	 var input = document.getElementById('upload_image');

	var reader = new FileReader();
	reader.onload = function(){
	  var dataURL = reader.result;
	  var output = document.getElementById('display_image');
	  output.src = dataURL;
	};
	reader.readAsDataURL(input.files[0]);
}
	
	
