<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Support Information – E-Dukan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body { background:#0f172a; color:#e5e7eb; }
		.wrap { max-width: 1000px; }
		.card { background:#0b1220; border:1px solid #1f2937; border-radius:16px; }
		.card h5 { color:#fff; }
		.hr-soft { border-color:#1f2937; opacity:.7; }
		a { color:#93c5fd; }
		a:hover { color:#bfdbfe; }
	</style>
</head>
<body>
	<div class="container wrap py-5">
		<h1 class="mb-2" style="color:#fff;">Support Information</h1>
		<p class="text-muted">How we can help you</p>
		<hr class="hr-soft">
		<div class="card p-4 mb-4">
			<h5 class="mb-3">Contact Us</h5>
			<p class="mb-1">Phone: <a href="tel:+18001234567">+1 800 123 4567</a></p>
			<p class="mb-0">Email: <a href="mailto:support@edukan.com">support@edukan.com</a></p>
		</div>
		<div class="card p-4 mb-4">
			<h5 class="mb-3">Shipping Info</h5>
			<ul class="mb-0">
				<li>Free shipping for eligible orders.</li>
				<li>Orders are processed within 1–2 business days.</li>
				<li>Delivery time varies by location (typically 2–7 business days).</li>
			</ul>
		</div>
		<div class="card p-4">
			<h5 class="mb-3">FAQ</h5>
			<ul class="mb-0">
				<li>How do I track my order? You’ll receive tracking via email when your order ships.</li>
				<li>Can I change my address? Contact us immediately if your order hasn’t shipped.</li>
				<li>Do you offer COD? Yes, Cash on Delivery is available on eligible orders.</li>
			</ul>
		</div>
		<a href="{{ route('shop.index') }}" class="btn btn-primary mt-4">Back to Home</a>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


