<?php
$pageTitle = 'Gallery | Aurelia Model Academy';

require 'includes/header.php';
require 'includes/menu.php';


$galleryFolder = 'assets/images/gallery/';

$galleryImages = array_merge(
    glob($galleryFolder . '*.jpg'),
    glob($galleryFolder . '*.jpeg'),
    glob($galleryFolder . '*.png'),
    glob($galleryFolder . '*.webp')
);
?>

<main class="content-page">

    <header class="page-header">

        <p class="eyebrow">
            Aurelia in motion
        </p>

        <h1>
            Gallery
        </h1>

        <p class="page-introduction">
            Meet Amoré Pietersen, the woman behind Aurelia Model Academy.
            With 14 years of modelling experience, her journey, passion
            and presence form the foundation of everything Aurelia represents.
        </p>

    </header>


    <?php if (!empty($galleryImages)): ?>

        <section
            class="gallery-grid"
            aria-label="Aurelia Model Academy gallery"
        >

            <?php foreach ($galleryImages as $image): ?>

                <?php
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                $imageDescription = str_replace(
                    ['-', '_'],
                    ' ',
                    $imageName
                );
                ?>

                <figure class="gallery-item">

                    <img
                        src="<?= htmlspecialchars($image) ?>"
                        alt="<?= htmlspecialchars(ucwords($imageDescription)) ?>"
                        loading="lazy"
                    >

                </figure>

            <?php endforeach; ?>

        </section>

    <?php else: ?>

        <section class="empty-gallery">

            <p>
                Gallery photographs will be added soon.
            </p>

        </section>

    <?php endif; ?>

</main>

<?php require 'includes/footer.php'; ?>