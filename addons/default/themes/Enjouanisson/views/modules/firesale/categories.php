	<h1>Products</h1>
	{{ widgets:area slug="products-intro" }}
	{{ categories }}
{{ if {utilities:looper identifier="idx" true_every="2" } == 1 }}
	<div class="row">
{{ endif }}
		<section class="large-6 columns product_category">
			<a href="{{ firesale:url route="category" id=id }}" class="product_link"><img src="{{ images.0.path }}" alt="{{ title }}" class="left" /></a>
			<h3><a href="{{ firesale:url route="category" id=id }}">{{ title }}</a></h3>
			<p>{{ description }}</p>
			<a href="{{ firesale:url route="category" id=id }}">&nbsp;</a>
		</section>
{{ if { utilities:looper identifier="idx" step="1" true_every="2" } == 1 }}
		</div>
	
{{ endif }}
{{ /categories }}