<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload file" name="submit">
</form>

<table style="width:100%; text-align: center">
    <tr>
        <th>CustomerId</th>
        <th>Number of calls within the same continent</th>
        <th>Total Duration of calls within the same continent</th>
        <th>Total number of all calls</th>
        <th>The total duration of all calls</th>
    </tr>
	<?php if (!empty($results)) {
		foreach ($results as $result) {
			?>
            <tr>
                <td><?=$result['customer_id']?></td>
                <td><?=$result['total_calls_within_continent']?></td>
                <td><?=$result['total_calls_dur_within_continent']?></td>
                <td><?=$result['total_calls']?></td>
                <td><?=$result['total_calls_dur']?></td>
            </tr>
			<?php
		}
	}
	?>

</table>