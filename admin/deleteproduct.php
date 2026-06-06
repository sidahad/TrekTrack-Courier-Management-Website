<?php 
include 'conn.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Prepare the SQL delete statement
    $sql = "DELETE FROM products WHERE pid = ?";

    // Initialize the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $product_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If deletion is successful, redirect to the product page
            header("Location: products.php?message=Product+Deleted+Successfully");
            exit();
        } else {
            // If there was an error executing the statement
            echo "Error deleting product: " . mysqli_error($conn);
        }
    } else {
        // If there was an error preparing the statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request. No product ID provided.";
}

// Close the database connection
mysqli_close($conn);
?>