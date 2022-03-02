function fileValidation() {
    var fileInput = 
        document.getElementById('file');
      
    var filePath = fileInput.value;
  
    // Allowing file type
    //var allowedExtensions = /(\.csv|\.xls|\.xlsx)$/i;
    var allowedExtensions = /(\.csv|\.xls|\.xlsx)$/i;
    
    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        fileInput.value = '';
        return false;
    } 
}

function deleteJob(id)
{
     if(confirm('Are you sure you want to delete Job ID ' + id + '?'))
     {
        window.location.href='globals.php?deleteJob='+id;
     }
}

function deleteSMS(id)
{
     if(confirm('Are you sure you want to delete SMS ID ' + id + '?'))
     {
        window.location.href='globals.php?deleteSMS='+id;
     }
}