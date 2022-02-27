<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset ($_POST['save-excel-data']))
    $fileName = $_FILES['import-files']['name'];
    $allowedExt = ['xls', 'csv', 'xlsx'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    if(in_array($fileExt, $allowedExt)){
        $inputFile = $_FILES['import-files']['name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFile);
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach($data as $row)

    } else {
        $_SESSION['message'] = 'Invalid File';
        header('location: /');
        exit(0);
    }
?>