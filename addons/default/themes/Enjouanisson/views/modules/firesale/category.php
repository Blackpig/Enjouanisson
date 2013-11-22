	<h1>{{ category.title }}</h1>
	<p>{{ category.description }}</p>
	{{ if category.children > 0 }}
	<h2>In This Section</h2>
		{{ categories }}
		{{ if {helper:looper identifier="idx" true_every="2" } == 0 }}
			<div class="row">
		{{ endif }}
			<section class="large-6 columns product_category">
				<a href="{{ firesale:url route="category" id=id }}" class="product_link"><img src="{{ images.0.path }}" alt="{{ title }}" class="left" /></a>
				<h3><a href="{{ firesale:url route="category" id=id }}">{{ title }}</a></h3>
				<p>{{ description }}</p>
				<a href="{{ firesale:url route="category" id=id }}">&nbsp;</a>
			</section>
		{{ if { helper:looper identifier="idx" step="1" true_every="2" } == 0 }}
			</div>
	
		{{ endif }}
		{{ /categories }}
	{{ else }}
		{{ products }}
		<div class="row">
		 	<section class="large-12 columns product_category">
				<a href="{{ firesale:url route="product" id=id }}" class="product_link"><img src="{{ images.0.path }}" alt="{{ title }}" class="left" /></a>
				<h3>{{ title }}</h3>
				<p>{{ description }}</p>
				<a href="">&nbsp;</a>
			</section>
		</div>
		{{ /products }}
	{{ endif }}