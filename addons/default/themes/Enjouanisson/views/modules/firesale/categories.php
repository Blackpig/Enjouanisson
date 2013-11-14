	<h1>Products</h1>
	{{ widgets:area slug="products-intro" }}
	{{ categories }}
{{ if {utilities:looper identifier="idx" true_every="2" } == 1 }}
	<div class="row">
{{ endif }}
		<section class="large-6 columns product_category">
			<a href="" class="product_link"><img src="{{ images.0.path }}" alt="{{ title }}" class="left" /></a>
			<h4>{{ title }}</h4>
			<p>{{ description }}</p>
			<a href="">&nbsp;</a>
		</section>
{{ if { utilities:looper identifier="idx" step="1" true_every="2" } == 1 }}
		</div>
	
{{ endif }}
{{ /categories }}