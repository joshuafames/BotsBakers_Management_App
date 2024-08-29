# Business Management App
A system to facilitate management of clients, employees and money in a business (Bots Bakers)

This is a comprehensive business management application built using the LAMP stack (Linux, Apache, MySQL, PHP). The app provides various features essential for managing business operations, including client management, order processing, and financial analytics.

## Key Features

- **Invoice Generation**: Create professional invoices in PDF format. The app utilizes PhpSpreadsheet to generate Excel files, which are then converted into PDFs using a Python script. 
  - **Upcoming Feature**: The ability to send these invoices directly to clients via email.
  
- **Financial Statements**: (Upcoming Feature) Leverage the existing Excel-to-PDF functionality to generate detailed financial statements.

- **Dashboard**: Get an overview of your business operations with analytics graphs showing key performance indicators.

- **Client Management**: Manage your clients with ease, including adding, updating, and viewing client details.

- **Point of Sale**: A dedicated ordering dashboard for processing sales transactions.

## Installation and Setup

### Prerequisites

- **Python**: Ensure Python is installed on your machine.
- **LAMP Server**: A local LAMP server such as XAMPP is required to run the application.
- **MySQL Database**: Import the provided database dump located in the backend folder.

### Running the Application

1. Start your LAMP server (e.g., using XAMPP).
2. Ensure the MySQL database is set up with the provided dump file.
3. Open your web browser and navigate to `http://localhost/dashboard/`.
4. Log in using the following credentials:
   - **Username**: `admin`
   - **Password**: `admin101`

## Future Enhancements

- **Email Integration**: Automatically send generated invoices to clients via email.
- **Financial Statements**: Generate comprehensive financial statements in PDF format.
- **Employee Management**: Manage employee timesheets, leave-days, payslip generation.

## Screenshots of key features

