<button
    class="menu-button"
    id="openMenu"
    type="button"
    aria-label="Open navigation menu"
    aria-expanded="false"
>
    <span></span>
    <span></span>
</button>

<aside
    class="menu-overlay"
    id="menuOverlay"
    aria-hidden="true"
>
    <button
        class="close-button"
        id="closeMenu"
        type="button"
        aria-label="Close navigation menu"
    >
        <span></span>
        <span></span>
    </button>

    <nav class="menu-nav" aria-label="Main navigation">

        <a href="index.php">Home</a>

        <a href="about.php">About</a>

        <div class="menu-group">
            <div class="menu-group-heading">

                <a href="courses.php">Courses</a>

                <button
                    class="submenu-button"
                    type="button"
                    aria-label="Show course options"
                    aria-expanded="false"
                >
                    ⌄
                </button>

            </div>

            <div class="submenu">
                <a href="courses.php#training">Training</a>
                <a href="courses.php#pricing">Pricing</a>
            </div>
        </div>

        <a href="gallery.php">Gallery</a>

        <a href="join.php">Join</a>

        <a href="contact.php">Contact</a>

    </nav>

    <div class="menu-socials">

        <a href="#" aria-label="Aurelia Model Academy on Instagram">
            Instagram
        </a>

        <a href="#" aria-label="Aurelia Model Academy on Facebook">
            Facebook
        </a>

    </div>
</aside>