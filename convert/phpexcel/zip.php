<?php
$time = time();
unlink('../../../attachment/datapump/datapump*');
function merge($directories,$type){
    global $time;
/**
 * 7design.studio
 * Merge multiple CSV files into one master CSV file 
 * Remove header line from individual file
 */
$directory = $directories; // CSV Files Directory Path
// Open and Write Master CSV File
$masterCSVFile = fopen('merge_datapump_'.$type.'_'.$time.'.csv', "w+");
// Process each CSV file inside root directory
$i=0;
foreach(glob($directory) as $file) {
    $i++;
    $data = []; // Empty Data
    // Allow only CSV files
    if (strpos($file, '.csv') !== false) {
        // Open and Read individual CSV file
        if (($handle = fopen($file, 'r')) !== false) {
            // Collect CSV each row records
            while (($dataValue = fgetcsv($handle, 10000)) !== false) {
                $data[] = $dataValue;
            }
        }
        fclose($handle); // Close individual CSV file 
        if($i>1){
            unset($data[0]); // Remove first row of CSV, commonly tends to CSV header
        }
       
        // Check whether record present or not
        if(count($data) > 0) {
            foreach ($data as $value) {
                try {
                   // Insert record into master CSV file
                   fputcsv($masterCSVFile, $value, ", ", "'");
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            echo "[$file] file contains no record to process.";
        }
    } else {
        echo "[$file] is not a CSV file.";
    }
}
// Close master CSV file 
fclose($masterCSVFile);
rename('merge_datapump_'.$type.'_'.$time.'.csv', '../../../attachment/datapump/'.date("Y-m-d").'/merge_datapump_'.$type.'_'.$time.'.csv');
}
merge('../../../attachment/datapump/'.date("Y-m-d").'/template/*','template');
merge('../../../attachment/datapump/'.date("Y-m-d").'/backup/*','backup');

?>

<?php
 // Get real path for our folder
// $rootPath = realpath('../../../attachment/datapump');
$rootPath = realpath('../../../attachment/datapump/'.date("Y-m-d")."/");
// Initialize archive object
$zip = new ZipArchive();
$zip->open('datapump_'.$time.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);
foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}
// Zip archive will be created only after closing object
$zip->close();
rename('datapump_'.$time.'.zip', '../../../attachment/datapump/datapump_'.$time.'.zip');
echo 'Generate new zip for datapump already <a href="../../../attachment/datapump/datapump_'.$time.'.zip">Download here !</a>';
  ?>