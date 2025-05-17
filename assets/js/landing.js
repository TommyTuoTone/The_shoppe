document.addEventListener('DOMContentLoaded', () => {
    const debounceTime = 150;
    const decreaseInterval = 5000;
    const decreaseAmount = 1;
    const minImages = 16;
    let numImages = 16;

    const imageSources = [
        'assets/images/bag.png',
        'assets/images/eggs.png',
        'assets/images/bread.png',
        'assets/images/chicken.png',
        'assets/images/milk.png',
        'assets/images/fruit.png',
    ];

    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    const logo = document.querySelector('.logo');
    logo.addEventListener('click', debounce(() => {
        numImages += 3;
        createRainImages();
    }, debounceTime));

    function createRainImages() {
        // Remove excess images, but keep existing ones
        const existingImages = document.querySelectorAll('.image');
        if (existingImages.length > numImages) {
            const excessImages = Array.from(existingImages).slice(numImages);
            excessImages.forEach(img => img.remove());
        }

        // Add new images if needed
        const fragment = document.createDocumentFragment();
        for (let i = existingImages.length; i < numImages; i++) {
            const img = document.createElement('img');
            img.src = imageSources[i % imageSources.length];
            img.classList.add('image');
            img.style.left = `${Math.random() * window.innerWidth}px`;
            const spinChance = Math.random();
            const spinDuration = 2 + Math.random() * 5;
            const spinDirection = Math.random() > 0.5 ? 'normal' : 'reverse';
            if (spinChance > 0.5) {
                img.style.animation = `fall linear infinite ${3 + Math.random() * 5}s, spin ${spinDuration}s linear infinite ${spinDirection}`;
            } else {
                img.style.animation = `fall linear infinite ${3 + Math.random() * 5}s`;
            }
            img.style.animationDelay = `${Math.random() * 2}s`;
            fragment.appendChild(img);
        }
        document.body.appendChild(fragment);
    }

    setInterval(() => {
        if (numImages > minImages) {
            numImages -= decreaseAmount;
            createRainImages(); // Update images after decreasing
        }
    }, decreaseInterval);

    createRainImages();

    const logoImage = document.getElementById("logo-image");
    const niceImage = document.getElementById("nice-image");

    function showNiceImageTemporarily() {
        niceImage.style.display = "block";
        setTimeout(() => {
            niceImage.style.display = "none";
        }, 1500);
    }

    if (logoImage) {
        logoImage.addEventListener("click", showNiceImageTemporarily);
    }

    if (niceImage) {
        niceImage.style.display = "none"; // Initially hide the nice image
    }
});
