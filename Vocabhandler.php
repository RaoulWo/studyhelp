<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vocabhandler</title>
</head>
<body>
    Test
    <?php
        try
        {
        $fileName = 'vocab.csv';
        
        if ( !file_exists($fileName) ) {
            throw new Exception('File not found.');
            echo "File not found";
        }
        
        $fp = fopen($fileName, "rb");
        if ( !$fp ) {
            throw new Exception('File open failed.');
            echo 'File open failed.';
        }  
        $str = stream_get_contents($fp);
        fclose($fp);
        
        // send success JSON
        
        } catch ( Exception $e ) {
            echo $e->getMessage();
        }
        echo "Test";
    ?>
</body>
</html>


