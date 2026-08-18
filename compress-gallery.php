<?php

set_time_limit(300);


$sourceFolder = __DIR__ . '/assets/images/gallery/';
$outputFolder = $sourceFolder . 'compressed/';

$maximumWidth = 1200;
$jpegQuality = 75;


if (!extension_loaded('gd')) {
    exit('The PHP GD extension is not enabled.');
}


if (!is_dir($sourceFolder)) {
    exit('The gallery folder could not be found.');
}


if (!is_dir($outputFolder)) {
    mkdir($outputFolder, 0755, true);
}


$imageFiles = array_merge(
    glob($sourceFolder . '*.jpg'),
    glob($sourceFolder . '*.jpeg'),
    glob($sourceFolder . '*.png'),
    glob($sourceFolder . '*.webp')
);


if (empty($imageFiles)) {
    exit('No gallery images were found.');
}


$processedImages = 0;
$failedImages = [];


foreach ($imageFiles as $imagePath) {

    $imageInformation = getimagesize($imagePath);

    if ($imageInformation === false) {
        $failedImages[] = basename($imagePath);
        continue;
    }


    $originalWidth = $imageInformation[0];
    $originalHeight = $imageInformation[1];
    $imageType = $imageInformation[2];


    switch ($imageType) {

        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($imagePath);
            break;

        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($imagePath);
            break;

        case IMAGETYPE_WEBP:
            $sourceImage = imagecreatefromwebp($imagePath);
            break;

        default:
            $failedImages[] = basename($imagePath);
            continue 2;
    }


    if ($sourceImage === false) {
        $failedImages[] = basename($imagePath);
        continue;
    }


    if ($originalWidth > $maximumWidth) {

        $newWidth = $maximumWidth;

        $newHeight = (int) round(
            $originalHeight * ($newWidth / $originalWidth)
        );

    } else {

        $newWidth = $originalWidth;
        $newHeight = $originalHeight;
    }


    $compressedImage = imagecreatetruecolor(
        $newWidth,
        $newHeight
    );


    $whiteBackground = imagecolorallocate(
        $compressedImage,
        255,
        255,
        255
    );

    imagefill(
        $compressedImage,
        0,
        0,
        $whiteBackground
    );


    imagecopyresampled(
        $compressedImage,
        $sourceImage,
        0,
        0,
        0,
        0,
        $newWidth,
        $newHeight,
        $originalWidth,
        $originalHeight
    );


    $originalFilename = pathinfo(
        $imagePath,
        PATHINFO_FILENAME
    );

    $outputPath =
        $outputFolder .
        $originalFilename .
        '.jpg';


    $savedSuccessfully = imagejpeg(
        $compressedImage,
        $outputPath,
        $jpegQuality
    );


    imagedestroy($sourceImage);
    imagedestroy($compressedImage);


    if ($savedSuccessfully) {
        $processedImages++;
    } else {
        $failedImages[] = basename($imagePath);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Gallery Compression</title>

    <style>
        body {
            margin: 0;
            padding: 4rem 1.5rem;

            background: #111111;
            color: #ffffff;

            font-family: Arial, Helvetica, sans-serif;
        }

        main {
            max-width: 700px;
            margin: 0 auto;
        }

        h1 {
            font-size: 3rem;
            font-weight: 300;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .success {
            color: #8ee29b;
        }

        .error {
            color: #ff8f8f;
        }
    </style>
</head>

<body>

    <main>

        <h1>
            Compression complete
        </h1>

        <p class="success">
            <?= $processedImages ?>
            photographs were compressed successfully.
        </p>


        <?php if (!empty($failedImages)): ?>

            <p class="error">
                These images could not be compressed:
            </p>

            <ul>

                <?php foreach ($failedImages as $failedImage): ?>

                    <li>
                        <?= htmlspecialchars($failedImage) ?>
                    </li>

                <?php endforeach; ?>

            </ul>

        <?php endif; ?>


        <p>
            The compressed photographs are inside:
            <strong>assets/images/gallery/compressed</strong>
        </p>

    </main>

</body>
</html>