<html>

<style>
    .gif-center{
        text-align: center;
    }
</style>


<body>
    <div class="gif-center">
        <h1>I will be a</h1>
        <img src="https://media4.giphy.com/media/3knKct3fGqxhK/giphy.gif" alt="" srcset="" width="500px" height="300px">

    </div>
    <strong>Database Connected: </strong>
<?php
    try {
        \DB::connection()->getPDO();
        echo \DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
        echo 'None';
    }
?>
    
</body>








</html>