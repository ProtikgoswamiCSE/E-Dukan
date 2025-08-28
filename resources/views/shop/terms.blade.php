<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Terms of Service – E-Dukan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body { background:#0f172a; color:#e5e7eb; }
		.policy-wrap { max-width: 1100px; }
		.card { background:#0b1220; border:1px solid #1f2937; border-radius:16px; }
		.card h5 { color:#fff; }
		.hr-soft { border-color:#1f2937; opacity:.7; }
		.badge-soft { background:#0b1220; border:1px solid #1f2937; color:#e5e7eb; }
	</style>
</head>
<body>
	<div class="container policy-wrap py-5">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="m-0" style="color:#fff;">Terms of Service</h1>
			<span class="badge badge-soft">Last updated: {{ now()->toDateString() }}</span>
		</div>
		<hr class="hr-soft mb-4">
		<div class="card p-4 mb-4">
			<h5 class="mb-3">Use of our Service</h5>
			<p class="mb-0">By using our site, you agree to comply with these terms and all applicable laws and regulations.</p>
		</div>
		<div class="card p-4 mb-4">
			<h5 class="mb-3">Orders and Payments</h5>
			<p class="mb-0">All orders are subject to acceptance and availability. Prices are listed in local currency unless stated otherwise.</p>
		</div>
		<div class="card p-4 mb-4">
			<h5 class="mb-3">Returns</h5>
			<p class="mb-0">Returns are accepted under our Returns Policy. Items must be unused and in original packaging.</p>
		</div>
		<div class="card p-4 mb-4">
			<h5 class="mb-3">Liability</h5>
			<p class="mb-0">We are not liable for indirect or incidental damages arising from the use of our services.</p>
		</div>
		<div class="card p-4">
			<h5 class="mb-3">Contact</h5>
			<p class="mb-0">For questions, email <a href="mailto:support@edukan.com">support@edukan.com</a>.</p>
		</div>
		<a href="{{ route('shop.index') }}" class="btn btn-primary mt-4">Back to Home</a>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


