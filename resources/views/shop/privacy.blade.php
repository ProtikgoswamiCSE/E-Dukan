<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Privacy Policy – E-Dukan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body { background:#0f172a; color:#e5e7eb; }
		.policy-wrap { max-width: 1100px; }
		.card { background:#0b1220; border:1px solid #1f2937; border-radius:16px; }
		.card h5 { color:#fff; }
		.policy-sidebar { position: sticky; top: 24px; }
		.policy-link { color:#9ca3af; text-decoration:none; display:block; padding:8px 0; }
		.policy-link:hover { color:#fff; }
		.hr-soft { border-color:#1f2937; opacity:.7; }
		a { color:#93c5fd; }
		a:hover { color:#bfdbfe; }
		.badge-soft { background:#0b1220; border:1px solid #1f2937; color:#e5e7eb; }
	</style>
</head>
<body>
	<div class="container policy-wrap py-5">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="m-0" style="color:#fff;">Privacy Policy</h1>
			<span class="badge badge-soft">Last updated: {{ now()->toDateString() }}</span>
		</div>
		<hr class="hr-soft mb-4">
		<div class="row g-4">
			<div class="col-lg-3">
				<div class="card p-3 policy-sidebar">
					<strong class="mb-2">On this page</strong>
					<a class="policy-link" href="#info">Information We Collect</a>
					<a class="policy-link" href="#use">How We Use Information</a>
					<a class="policy-link" href="#share">Sharing & Third Parties</a>
					<a class="policy-link" href="#security">Data Security & Retention</a>
					<a class="policy-link" href="#rights">Your Rights</a>
					<a class="policy-link" href="#contact">Contact</a>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="card p-4 mb-4" id="info">
					<h5 class="mb-3">Information We Collect</h5>
					<ul class="mb-0">
						<li>Account data (name, email, phone, address).</li>
						<li>Order and payment details (handled by secure payment partners).</li>
						<li>Usage data (device, browser, pages visited) to improve our service.</li>
					</ul>
				</div>
				<div class="card p-4 mb-4" id="use">
					<h5 class="mb-3">How We Use Information</h5>
					<ul class="mb-0">
						<li>Process and deliver your orders, including customer support.</li>
						<li>Improve site performance, features, and user experience.</li>
						<li>Communicate order updates, security alerts, and service changes.</li>
					</ul>
				</div>
				<div class="card p-4 mb-4" id="share">
					<h5 class="mb-3">Sharing & Third Parties</h5>
					<p class="mb-2">We never sell your personal data. We may share minimal information with:</p>
					<ul class="mb-0">
						<li>Delivery partners to ship your orders.</li>
						<li>Payment providers to process transactions securely.</li>
						<li>Analytics/anti‑fraud providers to keep our platform safe.</li>
					</ul>
				</div>
				<div class="card p-4 mb-4" id="security">
					<h5 class="mb-3">Data Security & Retention</h5>
					<p class="mb-0">We apply industry‑standard security. Data is retained only as long as needed for legal, accounting, or operational purposes.</p>
				</div>
				<div class="card p-4 mb-4" id="rights">
					<h5 class="mb-3">Your Rights</h5>
					<ul class="mb-0">
						<li>Access, correct, or delete your information.</li>
						<li>Opt‑out of non‑essential communications.</li>
						<li>Contact us to exercise any rights available in your region.</li>
					</ul>
				</div>
				<div class="card p-4" id="contact">
					<h5 class="mb-3">Contact</h5>
					<p class="mb-1">Email: <a href="mailto:support@edukan.com">support@edukan.com</a></p>
					<p class="mb-0">Phone: <a href="tel:+18001234567">+1 800 123 4567</a></p>
				</div>
				<a href="{{ route('shop.index') }}" class="btn btn-primary mt-4">Back to Home</a>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


