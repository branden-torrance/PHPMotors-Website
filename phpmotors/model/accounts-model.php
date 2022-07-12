<?php
// Accounts Model for PHP Motors


// This function will handle site registrations
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{

    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next 4 lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(":clientFirstname", $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(":clientLastname", $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(":clientEmail", $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(":clientPassword", $clientPassword, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Check for existing Email address
function checkExistingEmail($clientEmail)
{
    $db = phpmotorsConnect();
    $sql = "SELECT clientEmail FROM clients WHERE clientEmail = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":email", $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
}

// Get client data based on an Email address
function getClient($clientEmail)
{
    $db = phpmotorsConnect();
    $sql = "SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":clientEmail", $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}


// This function will handle updating account information
function updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "UPDATE clients 
        SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail
        WHERE clientId = :clientId";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next 10 lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(":clientFirstname", $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(":clientLastname", $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(":clientEmail", $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(":clientId", $clientId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// Get client data based on an client ID
function getClientInfo($clientId)
{
    $db = phpmotorsConnect();
    $sql = "SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":clientId", $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}


// This function will handle updating the client password
function updatePassword($clientPassword, $clientId)
{
    // Create a connnection object using the phpmotors connection function
    $db = phpmotorsConnect();

    //The SQL statement
    $sql = "UPDATE clients 
        SET clientPassword = :clientPassword
        WHERE clientId = :clientId";

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next 10 lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(":clientPassword", $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(":clientId", $clientId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // Return the indication of success (rows changed)
    return $rowsChanged;
}