<body>
	<input type="date" id="date">
	<button class="btn btn-primary" onclick="loadTable()">Load Table</button>
	<section class="content-area">
	  <div class="table-area">
			<table class="table responsive-table">
			  <thead>
			    <tr>
			      <th scope="col">Time</th>
			      <th scope="col">Door Status</th>
			      <th scope="col">Air Temp</th>
			      <th scope="col">Humidity</th>
			      <th scope="col">Water Temp</th>
			      <th scope="col">Voltage</th>
			      <th scope="col">Fan Speed</th>
			      <th scope="col">Fan Status</th>
			      <th scope="col">Heater Status</th>
			    </tr>
			  </thead>
			  <tbody id="tablebody">
		  		<script>
		  			document.getElementById('date').valueAsDate = new Date();
		  			function loadTable()
		  			{
			  			$("#tablebody").load("php_scripts/create_table.php?date="+document.getElementById('date').value);
		  			}
		  		</script>
			  </tbody>
			</table>
		</div>
	</section>
</body>