<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
	<link rel="stylesheet" href="public/css/calendar.css">
	<style>
		table {
			max-width: 50%;
			width: 50%;
			display: table;
			margin: 0 0 10px 0;
			border-collapse: collapse;
			border-radius: 5px;
			border-style: hidden;
			box-shadow: 0 0 0 1px #ccc;
			overflow: hidden;
		}

		tr {
			display: table-row;
			vertical-align: inherit;
			border-color: inherit;
		}

		td {
			border: 1px solid #ccc;
			text-align: center;
			width: calc(100% / 7);
			height: 50px;
			padding: 0;
			vertical-align: middle;
		}

		table thead tr:first-of-type {
			background-color: #db4b32;
		}

		table thead tr:first-of-type a {
			border: 1px solid #db4b32;
			color: #fff;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="calendar">
		<div class="front">
			<div class="current-date">
				<h1><?php echo date('D'); ?> <?php echo date('d'); ?><?php echo date('S'); ?></h1>
				<h1>
					<a href="<?php echo "/calendar?month=" . date('m', strtotime($previous_month)) . "&year=" . date('Y', strtotime($previous_month)) . ""; ?>">
						<i class="fas fa-angle-left"></i>
					</a>
					<?php echo date('F', strtotime("01-{$month}-{$year}")); ?> <?php echo date('Y', strtotime("01-{$month}-{$year}")); ?>
					<a href="<?php echo "/calendar?month=" . date('m', strtotime($next_month)) . "&year=" . date('Y', strtotime($next_month)) . ""; ?>">
						<i class="fas fa-angle-right"></i>
					</a>
				</h1>
			</div>
			<div class="current-month">
				<ul class="week-days">
					<li>MON</li>
					<li>TUE</li>
					<li>WED</li>
					<li>THU</li>
					<li>FRI</li>
					<li>SAT</li>
					<li>SUN</li>
				</ul>
				<div class="weeks">
					<?php if (!empty($getMonth)): ?>
						<?php for ($y = 0; $y < 6; $y++): ?>
							<div class="listWeek">
								<?php for ($x = 0; $x < 7; $x++):
									$k = 7 * $y + $x;
									?>
									<?php if ($k < $emptyCells || $k >= $emptyCells + count($getMonth['DayInfo'])): ?>
									<span class="last-month">
										00
									</span>
								<?php else:
									$date = "0" . ($k - $emptyCells + 1);
									$timestap = strtotime(($k - $emptyCells + 1) . "-{$month}-{$year}");
									?>
									<span class="<?php if ($timestap == strtotime(date('d-m-Y'))) echo "active"; ?>">
										<?php echo substr($date, -2, 2); ?>
										<div class="info">
											<?php $data = $getMonth['DayInfo'][$k - $emptyCells]; ?>
											<div class="top">
												<span class="tl"><?php echo $data['calen_month']; ?></span>
												<span class="tr"><?php echo $data['calen_year']; ?></span>
												<span class="ct"><?php echo $data['calen_day']; ?></span>
											</div>
										</div>
									</span>
								<?php endif; ?>
								<?php endfor; ?>
							</div>
						<?php endfor; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
