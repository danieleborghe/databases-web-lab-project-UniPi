# Clique: A Dynamic Social Blogging Platform

Clique is a full-stack web application that provides a dynamic and interactive social blogging experience. Users can create and manage multiple blogs, publish various types of content (posts and articles), follow other blogs, and interact with the community through votes and comments. The platform is designed to be a central hub for creators to share their passions and for readers to discover engaging content.

This project was developed for the "Databases and Web Lab" course at the **University of Pisa (UniPi)**.

[![Read the Report (Italian)](https://img.shields.io/badge/Read_the_Full-Report-blue?style=for-the-badge&logo=adobeacrobatreader)](RELAZIONE%20PROGETTO%20TESCARI%20&%20BORGHESI.pdf)

---

## 📝 Table of Contents

- [Project Goal: Building a Content-Centric Social Network](#-project-goal-building-a-content-centric-social-network)
- [Core Features](#-core-features)
- [Technical Stack & Architecture](#-technical-stack--architecture)
- [Database Schema Highlights](#-database-schema-highlights)
- [Installation & Setup](#-installation--setup)
- [Authors](#-authors)

---

## 🎯 Project Goal: Building a Content-Centric Social Network

The primary objective of this project was to design, develop, and deploy a complete, database-driven web application. We aimed to create a robust platform that mimics the core functionalities of modern social media and blogging sites, focusing on:

-   **User and Content Management**: Securely managing user data, blogs, posts, and articles.
-   **Social Interaction**: Implementing features like following, voting, and commenting to foster community engagement.
-   **Dynamic User Experience**: Using asynchronous JavaScript (AJAX) to provide a smooth and responsive interface without constant page reloads.
-   **Scalable Database Design**: Creating a well-structured relational database schema to ensure data integrity and efficient querying.

---

## ✨ Core Features

Clique offers a rich set of features for both content creators and consumers:

-   **User Authentication**: Secure user registration and login system with session management.
-   **Profile Management**: Users can create and edit their personal profiles, including profile pictures and bios.
-   **Multi-Blog Creation**: A single user can create and manage multiple, distinct blogs, each with its own title, theme (cover image), and collaborators.
-   **Rich Content Creation**:
    -   **Posts**: Support for various post formats, including Text, Image, Video, Audio, Link, and Lists.
    -   **Articles**: A dedicated system for writing long-form, structured articles using a WYSIWYG editor (**Summernote**), complete with titles, subtitles, and tagging (**Tagify**).
-   **Social Feed**: A personalized feed on the homepage that aggregates the latest posts from all the blogs a user follows.
-   **Follow System**: Users can follow their favorite blogs to stay updated on new content.
-   **Interactive Content**:
    -   **Voting**: Upvote/downvote system for both posts and articles.
    -   **Commenting**: Threaded comment sections for posts and articles.
-   **Powerful Search**: A global search functionality that allows users to find profiles, blogs, posts, and articles based on keywords and tags.
-   **Dynamic UI**: Most interactions (voting, commenting, following, creating posts) are handled asynchronously via **AJAX**, providing a seamless user experience.

---

## 💻 Technical Stack & Architecture

Clique is built on a classic, robust web stack, designed for performance and scalability.

-   **Backend**: **PHP**
    -   A procedural approach is used to handle server-side logic, database interactions, and session management.
    -   The code is modularized into `includes`, `actions`, and `ajax` handlers for better organization.
-   **Database**: **MySQL**
    -   A relational database that stores all user data, content, and relationships.
    -   The schema is designed to enforce data integrity through primary keys, foreign keys, and constraints.
-   **Frontend**:
    -   **HTML5** & **CSS3**: For structuring and styling the user interface.
    -   **Bootstrap 5**: A responsive CSS framework for a consistent and mobile-first design.
    -   **JavaScript** & **jQuery**: For client-side scripting, form validation, and DOM manipulation.
    -   **AJAX**: Extensively used to communicate with the PHP backend without page reloads, powering all the interactive features.
-   **Server**: The application is designed to be deployed on a **LAMP** (Linux, Apache, MySQL, PHP) or similar stack (WAMP/MAMP).

---

## 🗄️ Database Schema Highlights

The MySQL database is the backbone of the application. The schema is normalized to reduce redundancy and ensure consistency. Key tables include:

-   `UTENTE`: Stores user information, credentials (hashed passwords), and profile details.
-   `BLOG`: Manages all blogs, linking them to their owner (`UTENTE`) and collaborators.
-   `POST`: A central table for all short-form content, with a `tipo` (type) field to differentiate between text, image, video, etc.
-   `ARTICOLO`: Stores long-form articles, including their rich HTML content.
-   `COMMENTO_P` & `COMMENTO_A`: Tables for comments on posts and articles, respectively.
-   `FOLLOW`: Maps users to the blogs they follow, enabling the personalized feed.
-   `VOTO_P` & `VOTO_A`: Tracks user votes on posts and articles.
-   `TAG` & `TAGGATO`: Manages the tagging system for articles.

The full database schema can be found in the `progettobasididati_v2b.sql` file.

---

## 🚀 Installation & Setup

To run this project locally, you will need a local web server environment like XAMPP, WAMP, or MAMP.

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/danieleborghe/databases-web-lab-project-UniPi.git](https://github.com/danieleborghe/databases-web-lab-project-UniPi.git)
    ```

2.  **Set up the Database:**
    -   Start your Apache and MySQL services.
    -   Create a new database in `phpMyAdmin` (or your preferred MySQL client).
    -   Import the `progettobasididati_v2b.sql` file into your newly created database. This will create all the necessary tables and relationships.

3.  **Configure the Application:**
    -   Move the cloned project files into your server's web root directory (e.g., `htdocs` in XAMPP).
    -   Open the `includes/db-connection.php` file.
    -   Update the database credentials (`$servername`, `$username`, `$password`, `$dbname`) to match your local setup.

4.  **Run the Application:**
    -   Open your web browser and navigate to the project directory on your local server (e.g., `http://localhost/databases-web-lab-project-UniPi/homepage.php`).

---

## 👥 Authors

- **Daniele Borghesi**
- **Arianna Tescari**
