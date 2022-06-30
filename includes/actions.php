<?php include 'config.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
}

// login

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {

        $query = "SELECT * FROM users WHERE username=:username";
        $statement = $conn->prepare($query);
        $data = [':username' => $username];

        $statement->execute($data);
        $result = $statement->fetch();

        if ($result && password_verify($password, $result['password'])) {

            $_SESSION['id'] = $result['id'];
            $_SESSION['account_category'] = $result['account_category'];
            header("Location: ../admin/dashboard.php");
        } else {

            $_SESSION['login-failed'] = "Incorrect Username or Password.";
            header("Location: ../login.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// add calamity type

if (isset($_POST['add_calamity_type'])) {

    $calamity_type = $_POST['calamity_type'];

    try {
        $query = "INSERT INTO calamity_types (calamity_type) VALUES (:calamity_type)";
        $statement = $conn->prepare($query);
        $data = [':calamity_type' => $calamity_type];

        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['add-calamity-type-success'] = "Calamity Type Added Successfully!";
            header("Location: ../admin/calamity-type.php");
        } else {
            $_SESSION['add-calamity-type-failed'] = "Something Went Wrong! Failed To Add Calamity Type.";
            header("Location: ../admin/calamity-type.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// add barangay

if (isset($_POST['add_barangay'])) {

    $barangay = $_POST['barangay'];

    try {
        $query = "INSERT INTO barangays (barangay) VALUES (:barangay)";
        $statement = $conn->prepare($query);
        $data = [':barangay' => $barangay];

        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['add-barangay-success'] = "Barangay Added Successfully!";
            header("Location: ../admin/barangay.php");
        } else {
            $_SESSION['add-barangay-failed'] = "Something Went Wrong! Failed To Add Barangay.";
            header("Location: ../admin/barangay.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// add evacuation center

if (isset($_POST['add_evacuation_center'])) {

    $center_name = $_POST['center_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];

    try {
        $query = "INSERT INTO evacuation_centers (center_name, address, contact_number) VALUES (:center_name, :address, :contact_number)";
        $statement = $conn->prepare($query);
        $data = [
            ':center_name' => $center_name,
            ':address' => $address,
            ':contact_number' => $contact_number
        ];

        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['add-evacuation-center-success'] = "Evacuation Center Added Successfully!";
            header("Location: ../admin/evacuation-center.php");
        } else {
            $_SESSION['add-evacuation-center-failed'] = "Something Went Wrong! Failed To Add 
            Evacuation Center.";
            header("Location: ../admin/evacuation-center.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// add evacuee

if (isset($_POST['add_evacuee'])) {

    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $contact_number = $_POST['contact_number'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $barangay = $_POST['barangay'];
    $address = $_POST['address'];
    $family_head = $_POST['family_head'];
    $calamity_type = $_POST['calamity_type'];
    $evacuation_center = $_POST['evacuation_center'];

    if (empty($_POST['gender']) or empty($_POST['barangay']) or empty($_POST['calamity_type']) or empty($_POST['evacuation_center'])) {

        $_SESSION['evacuee-details-required'] = "All Fields Are Required.";
        header("Location: ../admin/add-evacuees.php");
    } else {

        try {
            $query = "INSERT INTO evacuees (last_name, first_name, middle_name, contact_number, age, gender, barangay_id, address, family_head, calamity_type_id, evacuation_center_id) VALUES (:last_name, :first_name, :middle_name, :contact_number, :age, :gender, :barangay, :address, :family_head, :calamity_type, :evacuation_center)";
            $statement = $conn->prepare($query);
            $data = [
                ':last_name' => $last_name,
                ':first_name' => $first_name,
                ':middle_name' => $middle_name,
                ':contact_number' => $contact_number,
                ':age' => $age,
                ':gender' => $gender,
                ':barangay' => $barangay,
                ':address' => $address,
                ':family_head' => $family_head,
                ':calamity_type' => $calamity_type,
                ':evacuation_center' => $evacuation_center
            ];

            $result = $statement->execute($data);

            if ($result) {
                $_SESSION['add-evacuee-success'] = "Evacuee Added Successfully!";
                header("Location: ../admin/manage-evacuees.php");
            } else {
                $_SESSION['add-evacuee-failed'] = "Something Went Wrong! Failed To Add 
                Evacuee.";
                header("Location: ../admin/evacuees.php");
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}

// add user

if (isset($_POST['add_user'])) {

    $full_name = $_POST['full_name'];
    $designation = $_POST['designation'];
    $contact_number = $_POST['contact_number'];
    $account_category = $_POST['account_category'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $status = 1;

    if (empty($_POST['account_category'])) {

        $_SESSION['user-details-required'] = "All Fields Are Required.";
        header("Location: ../admin/add-user.php");
    } else {

        try {
            $query = "INSERT INTO users (full_name, designation, contact_number, account_category, username, password, status) VALUES (:full_name, :designation, :contact_number, :account_category, :username, :password, :status)";
            $statement = $conn->prepare($query);
            $data = [
                ':full_name' => $full_name,
                ':designation' => $designation,
                ':contact_number' => $contact_number,
                ':account_category' => $account_category,
                ':username' => $username,
                ':password' => $password,
                ':status' => $status
            ];

            $result = $statement->execute($data);

            if ($result) {
                $_SESSION['add-user-success'] = "User Added Successfully!";
                header("Location: ../admin/manage-user.php");
            } else {
                $_SESSION['add-user-failed'] = "Something Went Wrong! Failed To Add 
                User.";
                header("Location: ../admin/add-user.php");
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}

// edit calamity type

if (isset($_POST['edit_calamity_type'])) {

    $calamity_id = $_POST['id'];
    $calamity_type = $_POST['calamity_type'];

    try {
        $query = "UPDATE calamity_types SET calamity_type=:calamity_type WHERE id =:clmty_id LIMIT 1";
        $statement = $conn->prepare($query);
        $data = [
            ':calamity_type' => $calamity_type,
            ':clmty_id' => $calamity_id
        ];

        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['edit-calamity-type-success'] = "Calamity Type Updated Successfully!";
            header("Location: ../admin/calamity-type.php");
        } else {
            $_SESSION['edit-calamity-type-failed'] = "Something Went Wrong! Failed To Update Calamity Type.";
            header("Location: ../admin/calamity-type.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// edit barangay

if (isset($_POST['edit_barangay'])) {

    $barangay_id = $_POST['id'];
    $barangay = $_POST['barangay'];

    try {
        $query = "UPDATE barangays SET barangay=:barangay WHERE id =:brgy_id LIMIT 1";
        $statement = $conn->prepare($query);
        $data = [
            ':barangay' => $barangay,
            ':brgy_id' => $barangay_id
        ];

        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['edit-barangay-success'] = "Barangay Updated Successfully!";
            header("Location: ../admin/barangay.php");
        } else {
            $_SESSION['edit-barangay-failed'] = "Something Went Wrong! Failed To Update Barangay.";
            header("Location: ../admin/barangay.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// edit evacuation center

if (isset($_POST['edit_evacuation_center'])) {

    $evacuation_center_id = $_POST['id'];
    $center_name = $_POST['center_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];

    try {
        $query = "UPDATE evacuation_centers SET center_name=:center_name, address=:address, contact_number=:contact_number WHERE id =:evcton_cntr_id LIMIT 1";
        $statement = $conn->prepare($query);
        $data = [
            ':center_name' => $center_name,
            ':address' => $address,
            ':contact_number' => $contact_number,
            ':evcton_cntr_id' => $evacuation_center_id
        ];

        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['edit-evacuation-center-success'] = "Evacuation Center Updated Successfully!";
            header("Location: ../admin/evacuation-center.php");
        } else {
            $_SESSION['edit-evacuation-center-failed'] = "Something Went Wrong! Failed To Update Evacuation Center.";
            header("Location: ../admin/evacuation-center.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// edit evacuee

if (isset($_POST['edit_evacuee'])) {

    $evacuee_id = $_POST['id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $contact_number = $_POST['contact_number'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $barangay = $_POST['barangay'];
    $address = $_POST['address'];
    $family_head = $_POST['family_head'];
    $calamity_type = $_POST['calamity_type'];
    $evacuation_center = $_POST['evacuation_center'];

    try {
        $query = "UPDATE evacuees SET last_name=:last_name, first_name=:first_name, middle_name=:middle_name, contact_number=:contact_number, age=:age, gender=:gender, barangay_id=:barangay, address=:address, family_head=:family_head, calamity_type_id=:calamity_type, evacuation_center_id=:evacuation_center WHERE id =:evc_id LIMIT 1";
        $statement = $conn->prepare($query);
        $data = [
            ':last_name' => $last_name,
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':contact_number' => $contact_number,
            ':age' => $age,
            ':gender' => $gender,
            ':barangay' => $barangay,
            ':address' => $address,
            ':family_head' => $family_head,
            ':calamity_type' => $calamity_type,
            ':evacuation_center' => $evacuation_center,
            ':evc_id' => $evacuee_id
        ];

        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['edit-evacuee-success'] = "Evacuee Updated Successfully!";
            header("Location: ../admin/edit-evacuees.php?edit_id=$evacuee_id");
        } else {
            $_SESSION['edit-evacuee-failed'] = "Something Went Wrong! Failed To Update Evacuee.";
            header("Location: ../admin/edit-evacuees.php?edit_id=$evacuee_id");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// edit lgu info

if (isset($_POST['edit_lgu_info'])) {

    $lgu_info_id = $_POST['id'];
    $user_id = $_POST['user_id'];
    $city = $_POST['city'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $website_name = $_POST['website_name'];
    $facebook_page = $_POST['facebook_page'];
    $password = $_POST['password'];

    try {

        $query = "SELECT * FROM users WHERE id=:usr_id";
        $statement = $conn->prepare($query);
        $data = [':usr_id' => $user_id];

        $statement->execute($data);
        $result = $statement->fetch();

        if ($result && password_verify($password, $result['password'])) {

            $query = "UPDATE lgu_settings SET city=:city, contact_number=:contact_number, email_address=:email_address, website_name=:website_name, facebook_page=:facebook_page WHERE id =:lgu_info_id LIMIT 1";
            $statement = $conn->prepare($query);
            $data = [
                ':city' => $city,
                ':contact_number' => $contact_number,
                ':email_address' => $email_address,
                ':website_name' => $website_name,
                ':facebook_page' => $facebook_page,
                ':lgu_info_id' => $lgu_info_id
            ];

            $result = $statement->execute($data);

            if ($result) {
                $_SESSION['edit-lgu-info-success'] = "LGU Info Updated Successfully!";
                header("Location: ../admin/lgu.php");
            } else {
                $_SESSION['edit-lgu-info-failed'] = "Something Went Wrong! Failed To Update LGU Info.";
                header("Location: ../admin/lgu.php");
            }
        } else {
            $_SESSION['incorrect-password'] = "Incorrect Password";
            header("Location: ../admin/lgu.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// edit user

if (isset($_POST['edit_user'])) {

    $user_id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $designation = $_POST['designation'];
    $contact_number = $_POST['contact_number'];
    $account_category = $_POST['account_category'];
    $status = $_POST['status'];

    try {
        $query = "UPDATE users SET full_name=:full_name, designation=:designation, contact_number=:contact_number, account_category=:account_category, status=:status WHERE id =:usr_id LIMIT 1";
        $statement = $conn->prepare($query);
        $data = [
            ':full_name' => $full_name,
            ':designation' => $designation,
            ':contact_number' => $contact_number,
            ':account_category' => $account_category,
            ':status' => $status,
            ':usr_id' => $user_id
        ];

        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['edit-user-success'] = "User Updated Successfully!";
            header("Location: ../admin/edit-user.php?edit_id=$user_id");
        } else {
            $_SESSION['edit-user-failed'] = "Something Went Wrong! Failed To Update User.";
            header("Location: ../admin/edit-user.php?edit_id=$user_id");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// delete calamity type

if (isset($_POST['delete_calamity_type'])) {

    $calamity_id = $_POST['id'];

    try {

        $query = "DELETE FROM calamity_types WHERE id=:clmty_id";
        $statement = $conn->prepare($query);
        $data = [':clmty_id' => $calamity_id];
        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['delete-calamity-type-success'] = "Calamity Type Deleted Successfully!";
            header("Location: ../admin/calamity-type.php");
        } else {
            $_SESSION['delete-calamity-type-failed'] = "Something Went Wrong! Failed To Delete Calamity Type.";
            header("Location: ../admin/calamity-type.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// delete barangay

if (isset($_POST['delete_barangay'])) {

    $barangay_id = $_POST['id'];

    try {

        $query = "DELETE FROM barangays WHERE id=:brgy_id";
        $statement = $conn->prepare($query);
        $data = [':brgy_id' => $barangay_id];
        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['delete-barangay-success'] = "Barangay Deleted Successfully!";
            header("Location: ../admin/barangay.php");
        } else {
            $_SESSION['delete-barangay-failed'] = "Something Went Wrong! Failed To Delete Barangay.";
            header("Location: ../admin/barangay.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// delete evacuation center

if (isset($_POST['delete_evacuation_center'])) {

    $evacuation_center_id = $_POST['id'];

    try {

        $query = "DELETE FROM evacuation_centers WHERE id=:evcton_cntr_id";
        $statement = $conn->prepare($query);
        $data = [':evcton_cntr_id' => $evacuation_center_id];
        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['delete-evacuation-center-success'] = "Evacuation Center Deleted Successfully!";
            header("Location: ../admin/evacuation-center.php");
        } else {
            $_SESSION['delete-evacuation-center-failed'] = "Something Went Wrong! Failed To Delete Evacuation Center.";
            header("Location: ../admin/evacuation-center.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// delete evacuee

if (isset($_POST['delete_evacuee'])) {

    $evacuee_id = $_POST['id'];

    try {

        $query = "DELETE FROM evacuees WHERE id=:evc_id";
        $statement = $conn->prepare($query);
        $data = [':evc_id' => $evacuee_id];
        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['delete-evacuee-success'] = "Evacuee Deleted Successfully!";
            header("Location: ../admin/manage-evacuees.php");
        } else {
            $_SESSION['delete-evacuee-failed'] = "Something Went Wrong! Failed To Delete Evacuee.";
            header("Location: ../admin/manage-evacuees.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// delete user

if (isset($_POST['delete_user'])) {

    $user_id = $_POST['id'];

    try {

        $query = "DELETE FROM users WHERE id=:usr_id";
        $statement = $conn->prepare($query);
        $data = [':usr_id' => $user_id];
        $result = $statement->execute($data);

        if ($result) {
            $_SESSION['delete-user-success'] = "User Deleted Successfully!";
            header("Location: ../admin/manage-user.php");
        } else {
            $_SESSION['delete-user-failed'] = "Something Went Wrong! Failed To Delete User.";
            header("Location: ../admin/manage-user.php");
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}
