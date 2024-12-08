# Project Setup and Running Instructions

## Pre-requisites
Before running the project, make sure you have the following:

- **PHP**: Version 8.2
- **Gitbash**: To run commands
- **Composer**: To run composer commands

## Steps to Run the Project

1. **Download the Project**
   - Download the ZIP file from GitHub.
   - Unzip the file.

2. **Install Dependencies**
   - Navigate to the root directory of the project.
   - Run the following command to install the necessary dependencies:
     ```bash
     composer install
     ```

3. **Generate Grouping Output File**
   - Navigate to the `public` folder in the project directory.
   - Run the following command to generate the grouping output file:
     ```bash
     php parser.php --file products_comma_separated.csv --unique-combinations plist.csv
     ```

4. **Run Tests**
   - Go to the root folder of the project.
   - Run the following command to execute tests:
     ```bash
     vendor/bin/phpunit --configuration phpunit.xml
     ```

---

Feel free to reach out if you encounter any issues or have further questions!
