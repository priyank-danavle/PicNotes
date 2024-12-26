# PicNotes

PicNotes is a dynamic web application that allows users to view images, add comments to each image, and download the images. This project demonstrates the integration of front-end and back-end technologies to create a seamless and interactive user experience.

## Features

- **View Images**: Display images fetched from a database.
- **Add Comments**: Users can write and save comments for each image.
- **Download Images**: Download the displayed image with a single click.

## Technologies Used

- **Front-end**:
  - HTML5
  - CSS3
  - JavaScript (ES6)

- **Back-end**:
  - PHP
  - MySQL

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/priyank-danavle/picnotes.git
    ```

2. Set up the database:
   - Create a MySQL database named `images`.
   - Run the following SQL commands to create the `images` table:
     ```sql
     CREATE TABLE images (
         id INT AUTO_INCREMENT PRIMARY KEY,
         image_url VARCHAR(255) NOT NULL,
         comment TEXT
     );
     ```

3. Insert sample data into the `images` table:
    ```sql
    INSERT INTO images (image_url) VALUES
    ('path/to/image1.jpg'),
    ('path/to/image2.jpg'),
    ('path/to/image3.jpg');
    ```

4. Configure your web server to serve the project files.

5. Update the database connection settings in `fetch_images.php` and `save_comment.php`:
    ```php
    $conn = mysqli_connect('localhost', 'your_username', 'your_password', 'images');
    ```

## Usage

1. Open the `index.html` file in your web browser.
2. View the displayed image and add a comment in the text area.
3. Click "Next Image" to navigate through the images.
4. Click "Download Image" to download the currently displayed image.

## Project Structure

- `index.html`: The main HTML file that sets up the structure of the web application.
- `style.css`: The CSS file for styling the web application.
- `script.js`: The JavaScript file for handling user interactions and dynamic content loading.
- `fetch_images.php`: The PHP script to fetch image URLs from the database.
- `save_comment.php`: The PHP script to save comments to the database.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgements

- Inspired by various online tutorials and documentation.
- Thanks to the open-source community for providing valuable resources.

