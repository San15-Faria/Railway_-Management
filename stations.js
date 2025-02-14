const images = [
    { src: 'Madgaon_Railway_station_Entrance.jpg', label: 'Margao' },
        { src: 'Master.jpg', label: 'Mumbai' },
{ src: 'new-delhi-railway-station-night-shot-colourful-outer-building-national-capital-india-171642578.webp', label: 'New-Delhi' },
{ src: 'kanyakumari-railway-station-kanyakumari-railway-station-e6z60df1kk.avif', label: 'Kanyakumari' },
        { src: 'indian-railways-manipur1.avif', label: 'Manipur' }
];

let currentIndex = 0;

const imageElement = document.getElementById('image');
const labelElement = document.getElementById('label');
const nextButton = document.getElementById('nextButton');

nextButton.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % images.length; // Cycle through images
    updateImage();
});

function updateImage() {
    imageElement.src = images[currentIndex].src;
    labelElement.textContent = images[currentIndex].label;
}
