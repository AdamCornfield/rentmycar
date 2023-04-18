<?php
include('../functions/conn.php');
include('../functions/is_logged_in.php');
include('../functions/init.php'); 

if (!is_logged_in()) {
    header('Location: /');
}

$stmt = $conn->prepare("SELECT * FROM vehicle_details WHERE user_id = ?");
$stmt->bind_param("s", $user_id);

$user_id = $_SESSION['user_id'];

$stmt->execute();

$result = $stmt->get_result();

?>

<?php
    while($row = mysqli_fetch_assoc($result)) { ?>
        <tr id="<?php echo $row['vehicle_id'] ?>">
            <td><input type="text" name="vehicle_id" class="table-input rentals-input" value="<?php echo $row['vehicle_id'] ?>" readonly="readonly"></td>
            <td><input type="text" name="vehicle_make" class="table-input rentals-input" value="<?php echo $row['vehicle_make'] ?>"></td>
            <td><input type="text" name="vehicle_model" class="table-input rentals-input" value="<?php echo $row['vehicle_model'] ?>"></td>
            <td><input type="text" name="vehicle_bodytype" class="table-input rentals-input" value="<?php echo $row['vehicle_bodytype'] ?>"></td>
            <td><input type="text" name="fuel_type" class="table-input rentals-input" value="<?php echo $row['fuel_type'] ?>"></td>
            <td><input type="number" name="mileage" class="table-input rentals-input" value="<?php echo $row['mileage'] ?>"></td>
            <td><input type="text" name="location" class="table-input rentals-input" value="<?php echo $row['location'] ?>"></td>
            <td><input type="number" name="year" class="table-input rentals-input" value="<?php echo $row['year'] ?>"></td>
            <td><input type="number" name="num_doors" class="table-input rentals-input" value="<?php echo $row['num_doors'] ?>"></td>
            <td><input type="text" name="image_url" class="table-input rentals-input" value="<?php echo $row['image_url'] ?>"></td>
            <td><button class="car-delete btn btn-danger w-full">Delete</button></td>
        </tr>
    <?php }
?>
<tr class="bg-success">
    <td><input type="text" name="vehicle_id" class="table-input rentals-add " value="Add New Vehicle →" readonly="readonly"></td>
    <td class="tooltip"><input type="text" name="vehicle_make" class="table-input rentals-add"><span class="tooltiptext text-danger"></span></td>
    <td class="tooltip"><input type="text" name="vehicle_model" class="table-input rentals-add"><span class="tooltiptext text-danger"></span></td>
    <td class="tooltip"><input type="text" name="vehicle_bodytype" class="table-input rentals-add"><span class="tooltiptext text-danger"></span></td>
    <td class="tooltip"><input type="text" name="fuel_type" class="table-input rentals-add"><span class="tooltiptext text-danger"></span></td>
    <td class="tooltip"><input type="number" name="mileage" class="table-input rentals-add"><span class="tooltiptext text-danger"></span></td>
    <td class="tooltip"><input type="text" name="location" class="table-input rentals-add"><span class="tooltiptext text-danger"></span></td>
    <td class="tooltip"><input type="number" name="year" class="table-input rentals-add"><span class="tooltiptext text-danger"></span></td>
    <td class="tooltip"><input type="number" name="num_doors" class="table-input rentals-add"><span class="tooltiptext text-danger"></span></td>
    <td class="tooltip"><button class="btn btn-dark w-full" id="rentals-add-img">Upload Image</button></td>
    <td class="tooltip"><button class="car-add btn btn-success w-full">Add</button></td>
</tr>