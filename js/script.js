function prevImages(){
    let inputFile = document.getElementById('image');
    let [file] = inputFile.files;
    if(file){
        document.getElementById('prevImage').src = URL.createObjectURL(file);
    }
}