<?php include 'db_connect.php' ?>
<?php
$ppamount = 0;
$pamount = 0;
$tf = 0;

if (isset($_GET['rid'])) {
    // Fetch registration details
    $qry = $conn->query("SELECT r.*, p.plan, p.amount AS pamount, 
        pp.package, pp.amount AS ppamount, 
        CONCAT(m.lastname, ', ', m.firstname, ' ', m.middlename) AS name, 
        m.member_id AS mid_no 
        FROM registration_info r 
        INNER JOIN members m ON m.id = r.member_id 
        INNER JOIN plans p ON p.id = r.plan_id 
        INNER JOIN packages pp ON pp.id = r.package_id 
        WHERE r.id = " . $_GET['rid']);

    if ($qry && $qry->num_rows > 0) {
        $result = $qry->fetch_array();
        foreach ($result as $k => $v) {
            $$k = $v;
        }
    } else {
        die("Error: Query failed or no data found. " . $conn->error);
    }

    // Debugging output
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
$tf = 0; // Default trainer fee

if (!empty($trainer_id)) {
    $trainer = $conn->query("SELECT rate FROM trainers WHERE id = $trainer_id");

    if ($trainer && $trainer->num_rows > 0) {
        $trainer_arr = $trainer->fetch_assoc();
        $tf = isset($trainer_arr['rate']) ? $trainer_arr['rate'] : 0;
    }
}



?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>Remarks</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$pcount=0;
					$paid = $conn->query("SELECT * FROM payment where registration_id = id ");
					while($row= $paid->fetch_assoc()):
						$pcount++;
					?>
					<tr>
						<td><?php echo date("M d,Y",strtotime($row['date_created'])) ?></td>
						<td class="text-right"><?php echo number_format($row['amount']) ?></td>
						<td><?php echo $row['remarks'] ?></td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<large><b>New Payment</b></large>
			<form id="manage_payment">
				<input type="hidden" name="registration_id" value="<?php echo $id ?>">
				<div class="form-group">
					<p>Plan Membership Fee: </i> <b class="float-right"><?php echo ($pcount<=0)? number_format($pamount,2).' (One-time amount only)': 'Paid Already' ?></b></p>
					<p>Package Amount: <b class="float-right"><?php echo number_format(isset($ppamount) ? $ppamount : 0, 2); ?></b></p>
					<p>Trainer Fee: </i> <b class="float-right"><?php echo number_format($tf) ?></b></p>
				</div>
				<hr>
				<div class="form-group">
				<p>Amount Payable: <b class="float-right">
    <?php 
        echo number_format(($pcount <= 0) ? ($ppamount + $tf + $pamount) : ($ppamount + $tf), 2); 
    ?>
</b></p>
				</div>
				<div class="form-group">
					<label for="" class="control-label"> Amount</label>
					<input type="text" class="form-control" name="amount">
				</div>
				<div class="form-group">
					<label for="" class="control-label"> Remarks</label>
					<textarea class="form-control" name="remarks"></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-primary">Save Payment</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-md-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
<style>
	p{
		margin:unset;
	}
	td,th{
		padding: 5px
	}
	#uni_modal .modal-footer{
		display: none;
	}
	#uni_modal .modal-footer.display {
		display: block;
	}
</style>
<script>
	$('#manage_payment').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_payment',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast('Payment Successfully saved','success')
					end_load()
					uni_modal('Payment','payment.php?rid=<?php echo $id ?>','large')
				}
			}
		})
	})
</script>