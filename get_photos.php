<?php
if (!empty($_GET['location'])) {
   
    $googlemaps_url = 'https://' .
        'maps.googleapis.com/' .
        'maps/api/geocode/json' .
        '?address=' . urlencode($_GET['location']);
    $maps_json = file_get_contents($googlemaps_url);
    $maps_array = json_decode($maps_json, true);

    $lat = $maps_array['results'][0]['geometry']['location']['lat'];
    $lng = $maps_array['results'][0]['geometry']['location']['lng'];

    $instaphotos_url = 'https://' .
        'api.instagram.com/v1/media/search' .
        '?lat=' . $lat .
        '&lng=' . $lng .
        '&client_id=f96e219513ad95f122ec2986cfbe4d4d'; 

    $photos_json = file_get_contents($instaphotos_url);
    $photos_array = json_decode($photos_json, true);

}
?>
<!DOCTYPE html>
    <html lang="en">
    <link rel="stylesheet" href="style.css">
    <head>
        <meta charset="utf-8"/>
        <title>GetPhotos</title>
      
    </head>
    <body>
        <form action="" method="get" class="form">
            <h1>Get Photos</h1>
            <input type="text" name="location"/>
            <input type="submit">
        </form>
        <br/>
        <div id="results" data-url="<?php if (!empty($url)) echo $url ?>">
            <?php
            if (!empty($array)) {
                foreach ($array['data'] as $key => $item) {
                    echo '<img id="' . $item['id'] . '" src="' . $item['images']['low_resolution']['url'] . '" alt=""/><br/>';
                }
            }
            ?>
        </div>
    </body>
</html>