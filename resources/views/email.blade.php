<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style='margin: 0 auto; padding: 0;'>
	<table style='margin: 0 auto; padding: 20px; background:#EFF6F2; width: 729px; height: auto; font-size: 15px;   
	height: auto;' >
	<tr>
		<td>
			<p style='text-align: center;font-size:20px; '> TRADEWME Customer Message </p>
		</td>
	</tr>
	<tr>
		<td>
			<table style='margin: 0 auto;  padding: 10px; background: #fff; width: 100%; height: auto;'>
				<tr>
					<td>
						<table style='margin: 0 auto; padding: 10px; background: #fff; width: 100%;'>
							<tr>
								<td><img src='http://tradewme.jhenuktv.net/img/project%20logo.png'></td>
								<td style='text-align: right; color: #000; font-size: 20px;
								'></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				</tr>
				<tr>
					<td>
						<p> Hi i am {{ ucfirst($name)  }} </p>
						<p> Subject: <span style="color: #000; font-weight: bold;"> {{ $subject }} </span> </p> 
						<p> Email: <span style="color: #000; font-weight: bold;"> {{ $email }} </span> </p> 
						<p> {{ $customer_message }} </p>
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>
</body>
</html>