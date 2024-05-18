const image = document.getElementById('image');
const commentTextarea = document.getElementById('comment');
const nextButton = document.getElementById('next-button');
const downloadButton = document.getElementById('download-button');

let imageIndex = 0;
let images = []; // Array to store image URLs from your database
let comments = []; // Array to store comments (imageIndex -> comment)

// Fetch image data from your database asynchronously
fetch('fetch_images.php')
    .then(response => response.json())
    .then(data => {
        images = data.images; // Assuming your endpoint returns an array of image URLs in "images" property
        displayImage(imageIndex);
    })
    .catch(error => console.error(error));

function displayImage(index) {
    if (index < 0 || index >= images.length) {
        return; // Handle index out-of-bounds cases
    }
    
    image.src = images[index];
    commentTextarea.value = comments[index] || ''; // Pre-fill comment if available
}

function saveComment(image_url, comment) {
    fetch('save_comment.php', {
        method: 'POST',
        body: JSON.stringify({ image_url, comment })
    })
    .then(response => response.text())
    .then(data => {
        console.log("Comment saved:", data); // Log success message
    })
    .catch(error => console.error(error));
}


nextButton.addEventListener('click', () => {
    imageIndex++;
    displayImage(imageIndex);
});

downloadButton.addEventListener('click', () => {
    const filename = `image-${imageIndex + 1}.jpeg`; // Add appropriate extension based on image type
    const link = document.createElement('a');
    link.href = image.src;
    link.setAttribute('download', filename);
    link.click();
});


// commentTextarea.addEventListener('input', () => {
//     comments[imageIndex] = commentTextarea.value.trim();
// });
commentTextarea.addEventListener('blur', () => {
    // const comment = commentTextarea.value.trim();
    comments[imageIndex] = commentTextarea.value.trim();

    if (comments[imageIndex]) {
        saveComment(images[imageIndex], comments[imageIndex]);
    }
});

