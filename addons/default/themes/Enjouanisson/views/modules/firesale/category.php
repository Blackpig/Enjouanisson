	<h1>{{ category.title }}</h1>
	<p>{{ category.description }}</p>
	{{ if category.children > 0 }}
	<h2>In This Section</h2>
		{{ categories }}
		{{ if {helper:looper identifier="idx" true_every="2" } == 1 }}
			<div class="row">
		{{ endif }}
			<section class="large-6 columns product_category">
				<a href="" class="product_link"><img src="{{ images.0.path }}" alt="{{ title }}" class="left" /></a>
				<h4>{{ title }}</h4>
				<p>{{ description }}</p>
				<a href="">&nbsp;</a>
			</section>
		{{ if { helper:looper identifier="idx" step="1" true_every="2" } == 1 }}
			</div>
	
		{{ endif }}
		{{ /categories }}
	{{ else }}
		{{ products }}
		 	<section class="large-12 columns product_category">
				<a href="" class="product_link"><img src="{{ images.0.path }}" alt="{{ title }}" class="left" /></a>
				<h4>{{ title }}</h4>
				<p>{{ description }}</p>
				<a href="">&nbsp;</a>
			</section>
		{{ /products }}
	{{ endif }}

