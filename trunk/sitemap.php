<?php
    include('db/credentials.php');
    include('db/connect.php');

    echo '<pre>';
    get_sitemap();
    echo '</pre>';

    function get_sitemap() {
        global $connection;

        $baseUrl = 'https://www.marosvolgyigergely.hu';
        $urls = [
            'https://www.marosvolgyigergely.hu',
            'https://www.marosvolgyigergely.hu/fooldal',
            'https://www.marosvolgyigergely.hu/versek',
            'https://www.marosvolgyigergely.hu/vers/osszes',
            'https://www.marosvolgyigergely.hu/novellak',
            'https://www.marosvolgyigergely.hu/novella/osszes',
            'https://www.marosvolgyigergely.hu/rolam'
        ];

        $query =
            "SELECT `Uri`, (CASE WHEN `TypeId`=2 THEN 'novella' ELSE 'vers' END) AS WritingType"
            ." FROM `irasok`"
            ." WHERE `IsVisible`=1"
            ." ORDER BY 2 DESC, `DateFinished`";

        $result = mysqli_query($connection, $query);
        $subUrls = [];
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $subUrls[] = $baseUrl.'/'.$row['WritingType'].'/'.$row['Uri'];
        }

        $urls = array_merge($urls, $subUrls);
        sort($urls);

        $file = fopen("sitemap.txt", "w");
        
        foreach ($urls as $key => $value) {
            echo $value.PHP_EOL;
            fwrite($file, $value.PHP_EOL);
        }

        fclose($file);
    }

    include('db/disconnect.php');
?>