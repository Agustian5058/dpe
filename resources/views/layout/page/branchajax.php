<?php
include "config.php";

use App\Models\BranchModel;

$branch_id  = $_POST["branch_id "];
$branchModel = new BranchModel();
$branchdata = $branchModel->find($branch_id);
$response = "Update Branch Data. Username must be unique.";
$response .= "<div class='my-4'></div>";
$response .= "<input type='hidden' name='branch_id' value='" . $branchdata["branch_id"] . "'>";
$response .= "<input type='hidden' name='branch_status' value='" . $branchdata["branch_status"] . "'>";
$response .= "<div class='form-group'>";
$response .= "<input type='text' class='form-control form-control-user' name='branch_username' ";
$response .= "placeholder='Enter Username / Branch Name ...' value = '" . $branchdata["branch_username"] . "'>";
$response .= "</div>";
$response .= "<div class='form-group'>";
$response .= "<input type='password' class='form-control form-control-user' name='branch_password' ";
$response .= "placeholder='Enter Password ...' value = '" . $branchdata["branch_password"] . "'>";
$response .= "</div>";
$response .= "<div class='form-group'>";
$response .= "<input type='text' class='form-control form-control-user' name='branch_address' ";
$response .= "placeholder='Enter Branch Address ...' value = '" . $branchdata["branch_address"] . "'>";
$response .= "</div>";
$response .= "<div class='form-group'>";
$response .= "<input type='number' class='form-control form-control-user' name='branch_phone' ";
$response .= "placeholder='Enter Branch Phone Number ...' value = '" . $branchdata["branch_phone"] . "'>";
$response .= "</div>";
echo $response;
exit;
