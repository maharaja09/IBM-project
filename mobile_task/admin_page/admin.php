<?php

class admin
{
    private $db;

    public function __construct()
    {
        // Connect to the database (replace with your database credentials)
        $this->db = new mysqli('localhost', 'root', '', 'mydb');
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function isEmailAllowed($email)
    {
        // Check if the email format is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        // Extract domain from the email address
        list(, $domain) = explode('@', $email);

        // Check if the domain is allowed (modify as needed)
        $allowed_domains = array("gmail.com", "yahoo.com", "outlook.com");
        return in_array($domain, $allowed_domains);
    }

    public function registeradmin($name, $username, $admin_address, $email, $admin_phno, $password)
    {
        // Check for duplicate email
        $check_query = "SELECT email FROM admin_info WHERE email = ?";
        $check_stmt = $this->db->prepare($check_query);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
    
        $check_result = $check_stmt->get_result();
    
        if ($check_result->num_rows > 0) {
            // Email already exists, return false
            return false;
        } else {
            // Insert admin data into the database
            $insert_query = "INSERT INTO admin_info (name, user_name, admin_address, email, admin_phno, password, created_on, created_by) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, ?)";
            $insert_stmt = $this->db->prepare($insert_query);
            $insert_stmt->bind_param("sssssss", $name, $username, $admin_address, $email, $admin_phno, $password, $username);
    
            if ($insert_stmt->execute()) {
                // Registration successful
                return true;
            } else {
                // Registration failed
                return false;
            }
        }
    }
    
    

    public function __destruct()
    {
        // Close the database connection
        $this->db->close();
    }
}
